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
 
 function select_all_classname(){
 	$sql="SELECT * FROM class_options WHERE status= 1";
 	$q=$this->db->query($sql);
 	return $q;
 }
 
 function select_all_subject(){
 	$sql="SELECT * FROM subjects WHERE status= 1";
 	$q=$this->db->query($sql);
 	return $q;
 }
 
 function select_available_exam($subject,$class){
 	$subject=$this->escape($subject);
 	$class=$this->escape($class);
 	$sql="SELECT COUNT(`exam_ID`)as total FROM exam_questions WHERE `subject_code`=$subject AND `class_code`=$class";
 	$q=$this->db->query($sql);
 	foreach($q->result() as $r){
 	 return $r->total;
 	}
 }
 
 function select_subject_name($name){
 	$name=$this->escape($name);
 	$sql="SELECT subject_name FROM subjects WHERE subject_code = $name LIMIT 1";
 	$q=$this->db->query($sql);
 	foreach($q->result() as $r){
 	 return $r->subject_name;
 	}
 }
 
 


}
?>
