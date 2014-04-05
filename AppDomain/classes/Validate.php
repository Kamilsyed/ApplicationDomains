<?php

class Validate
{
	private $_passed = false;
	private $_errors = array();
	private $_db = null;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array())
	{
		foreach($items as $item => $rules)
		{
			foreach($rules as $rule => $rule_value)
			{
				//FOR TESTING DO NOT UNCOMMENT	
				// echo "{$item} {$rule} must be {$rule_value}<br>";


				$value = $source[$item];
				$item = escape($item);

				//IF THE RULE IS 'required' BUT THE FIELD IS EMPTY, RETURN
				//ERROR AND EXIT THIS VALIDATION CHECK
				if($rule === 'required' && empty($value))
				{
					$this->addError("{$item} is required.");
				}
				else if(!empty($value))
				{
					//ADD INPUT RULES HERE FOR ALL OF WEBSITE
					//case 'rule' = what input rule you are enforcing
					//$rule_value = variable (example-> 30 char max, is_decimal = true)
					switch($rule)
					{
						case 'min':
							if(strlen($value) < $rule_value)
							{
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value)
							{
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value])
							{
								$this->addError("{$rule_value} must match {$item}.");
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if($check->count())
							{
								$this->addError("{$item} already exists.");
							}
						break;
						//tariq.abulaila; 
						// rule(s) added: 'password', 'user' (see array in CreateUsers.php)
						//checkPasswordStrength(), checkUsernameStrength(), and checkName()
						// inside 'checkpassword.php' . 
						case 'password':
							if (checkPasswordStrength($value) != $rule_value) {
								$this->addError("{$item} must contain at least one capital letter, one lower
								case letter, and one number.  Underscores are allowed.");
							}
						break;
						case 'user':
							if (checkUsernameStrength($value) != $rule_value) {
								$this->addError("{$item} must contain at least one capital letter, one lower
								case letter, and one number.  Underscores are allowed.");
							}
						break;
						case 'name':
							if (checkName($value) != $rule_value) {
								$this->addError("{$item} must contain 1 to 25 letters only.");
							}
						break;

					}
				}
			}
		}






		if(empty($this->_errors))
		{
			$this->_passed = true;
		}

		return $this;
	}

	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function passed()
	{
		return $this->_passed;
	}




}