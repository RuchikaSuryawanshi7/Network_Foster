<?php
class Signup
{
	private $error = "";
	public function evaluate($data)
	{
		foreach($data as $key => $value)
		{
			if(empty($value))
			{
				$this->error= $this->error . $key . " is empty!<br>";
			}
			if($key=="email")
			{

				if(!preg_match("/([\w\-]*\@[\w\-]*\.[\w\-]*)/",$value))
				{
					
					$this->error= $this->error . "Invalid Email address.<br>";
				}
				
			}
			if($key=="first_name")
			{

				if(is_numeric($value))
				{
					
					$this->error= $this->error . "First name can't be a number.<br>";
				}
				if(strstr($value," "))
				{
					
					$this->error= $this->error . "First name can't have spaces.<br>";
				}

				
			}
			if($key=="last_name")
			{

				if(is_numeric($value))
				{
					
					$this->error= $this->error . "Last name can't be a number.<br>";
				}
				if(strstr($value," "))
				{
					
					$this->error= $this->error . "Last name can't have spaces.<br>";
				}
				
			}


		}
		if($this->error == "")
		{
            $this->create_user($data);
		}
		else
		{
			return $this->error;
		}

	}
	public function create_user($data)
	{
		$email=$data['email'];
		$first_name=ucfirst($data['first_name']);
		$last_name=ucfirst($data['last_name']);
		$gender=$data['gender'];
		$age=$data['age'];
		$position=$data['position'];
		$country=$data['country'];
		//$password =hash('sha1', $data['password']);
		$password=hash('sha1', $data['password']);
		//not entered by user
		$url_address=strtolower($first_name) . ".". strtolower($last_name);
		$userid=$this->create_userid();//$data["userid"];
		$query = "insert into users (userid,email,first_name,last_name,gender,age,position,country,password,url_address) 
		values('$userid','$email','$first_name','$last_name','$gender',$age,'$position','$country','$password','$url_address')";
		
		$DB = new Database();
		$DB->save($query);

	}
	
	private function create_userid()
	{
		$length = rand(4,19);
		$number="";
		for($i=0; $i< $length; $i++)
		{
			$new_rand = rand(0,9);
			$number =$number . $new_rand;

		}
		return $number;

	}
}


?>