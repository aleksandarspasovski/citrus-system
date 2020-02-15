<?php 
require_once('./db.php');

class Comments 
{
	
	public function insertComments($name, $email, $text)
	{
		global $db;
		$name = mysqli_real_escape_string($db, $name);
		$email = mysqli_real_escape_string($db, $email);
		$text = mysqli_real_escape_string($db, ucfirst($text));
		$query = 'insert into comments values(null, "'.$name.'", "'.$email.'", "'.$text.'", "Disapproved")';
		$row = $db->query($query);
		return $row;

	}
	public function approveComments($id)
	{
		global $db;
		$approved = 'Approved';

		$query = 'update comments set status = "'.$approved.'" where id = "'.$id.'"';
		$res = $db->query($query);
		return $res;
	}
	public function checkIfApproved($id)
	{
		global $db;
		$query = 'select status from comments where id = "'.$id.'"';
		$res = $db->query($query);
		$result = $res->fetch_assoc();
		if ($result['status'] == 'Disapproved') {
			return true;
		} else{
			return false;
		}
	}
}