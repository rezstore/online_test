<?php
class m_oltest extends CI_Model{

 function escape($str){
 	return $this->db->escape($str);
 }

 function insert_user_tes($user,$email){
 	$user=$this->escape($user);
 	$email=$this->escape($email);
 	$sql="INSERT INTO user_accounts (`username`,`email`) VALUES ($user,$email)";
 	$this->db->query($sql);
 }
 


}
?>
