<?php

class Set
{

	private $_db, $_sessionName, $_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
	}

	public function create($fields = array())
	{
		if(!$this->_db->insert('sets', $fields))
		{
			throw new Exception("Cannot create Transaction" . print_r($fields));			
		}
	}


	//USE THIS TO RETRIEVE INFORMATION ABOUT A SET FOR NON-DISPLAY PURPOSES
	public function find($set = null)
	{
		if(is_numeric($set))
		{
			$data = $this->_db->get('set', array('id', '=', $set));

			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}

		return false;
	}

	//USE THIS ONLY TO DISPLAY A SET
	public function search($id)
	{
		if($this->find($id))
		{
			$op = array(
			);

			return $op;
		}

	return false;
	}

	//$id = set trying to reject or post
	//$comment can be null, but should not be for record purposes
	//$change should be 2 or 3; 2 = Posted || 3 = Rejected
	//This function can be used to post a rejected, or reject a posted set
	public function change($id, $comment, $change)
	{
		$user = new User();
		date_default_timezone_set('America/New_York');

		$fields = array(
			'type' => $change,
			'comment' => $comment,
			'user_changed' => $user->data()->username,
			'date_added' => date("Y-m-d H:i:s")
			);

		if(!$this->_db->update('sets', $id, $fields))
		{
			throw new Exception('There was a problem updating: ' . print_r($fields));
		}
	}

	public function get_last_id()
	{

		$con = mysqli_connect("localhost","host","test", "app_domain");

		   if (!$con)
		       {
		            die('Could not connect: ' . mysqli_error($con));
		       }

		  
		   $query = "SELECT id FROM sets ORDER BY `date_added` DESC LIMIT 1"; 
		   $result = mysqli_query($con, $query);
		   $row = mysqli_fetch_assoc($result);
		   $number = $row['id'];

		   return $number;
	}

	public function data()
	{
		return $this->_data;
	}
	public static function upload($file)
	{
		if(Input::exists())
		{
        $DB = mysqli_connect('localhost','host','test','test');
        
      
            
            $fileName = mysqli_real_escape_string($DB, $_FILES[$file]["name"]);
            $tmpName  = $_FILES[$file]['tmp_name'];       
            if(!get_magic_quotes_gpc()) 
            {
                $fileName = addslashes($fileName);
            }
            
            
            $fileSize = mysqli_real_escape_string($DB, $_FILES[$file]['size']);
            $fileData = mysqli_real_escape_string($DB, file_get_contents($_FILES[$file]["tmp_name"]));
            $fileType = mysqli_real_escape_string($DB, $_FILES[$file]["type"]);
            $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf"/*, "txt"*/);
            $temp = explode(".", $_FILES[$file]["name"]);
            //$ext = end($temp);
            $temp2 = end($temp);
            $ext = (string) $temp2;
            date_default_timezone_set('America/New_York');
            $time = date("Y-m-d H:i:s");
            
            

            echo "<br>";
            if ((($_FILES[$file]["type"] == "image/gif")
            || ($_FILES[$file]["type"] == "image/jpeg")
            || ($_FILES[$file]["type"] == "image/jpg")
            || ($_FILES[$file]["type"] == "image/pjpeg")
            //|| ($_FILES["upload"]["type"] == "text/plain")
            || ($_FILES[$file]["type"] == "image/x-png")
            || ($_FILES[$file]["type"] == "application/pdf")
            || ($_FILES[$file]["type"] == "image/png"))
            && ($_FILES[$file]["size"] < 1024000)
            && in_array($ext, $allowedExts))
            {
            

                try 
                {
                    
                    return array(
                    	'file_name'=> $fileName,
                    	'file_type'=> $fileType,
                    	'file_size'=> $fileSize,
                    	'file_data'=> $fileData,
                    	);
                } 
                catch (Exception $e) 
                {
                    die ('Connection failed: '.$e->getMessage());
                }
                
           
            }
            else
                echo "Not acceptable file.";
        
        }
	}
}