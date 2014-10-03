<?php
class m_oltest extends CI_Model{

 function escape($str){
 	return $this->db->escape($str);
 }
 
 function get_class($str){
  $this->escape($str);
  $str=$this->escape($str);
  $sql="SELECT class_name FROM class_options WHERE class_code=$str LIMIT 1";
  $q=$this->db->query($sql);
  foreach($q->result() as $r){return $r->class_name;}
  return '';
 }
 
 function get_subject($str){
  $str=$this->escape($str);
  $sql="SELECT subject_name FROM subjects WHERE subject_code=$str LIMIT 1";
  $q=$this->db->query($sql);
  foreach($q->result() as $r){return $r->subject_name;}
  return '';
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
 
 function get_questions($subject,$class,$page){
 	$subject=$this->escape($subject);
 	$class=$this->escape($class);
 	$limit=$this->escape($page + 5);
 	$page=$this->escape($page);
 	$sql="SELECT exam_questions.exam_content,choice_answers.* 
 		FROM exam_questions 
 		LEFT JOIN choice_answers ON exam_questions.exam_ID = choice_answers.exam_ID
 		WHERE exam_questions.subject_code = $subject AND exam_questions.class_code=$class LIMIT $page,$limit";
 	$q=$this->db->query($sql);
 	return $q;
 }
 
 function select_exam_answer($exam_id){
	$exam_id=$this->escape($exam_id);
	$sql="SELECT answer FROM correct_answer WHERE exam_ID=$exam_id LIMIT 1";
	$q=$this->db->query($sql);
	return $q;
 }
 
 function insert_to_tmp_db($username,$sess_id,$ex_id,$anr,$status){
 	$username=$this->escape($username);
 	$sess_ID=$this->escape($sess_id);
 	$ex_id=$this->escape($ex_id);
 	$anr=$this->escape($anr);
 	$status=$this->escape($status);
 	$sql="INSERT INTO `temporary_user_answers` (`sess_ID`,`date_time`,`user`,`exam_ID`,`answer`,`status`) 
 		VALUES ($sess_ID,NOW(),$username,$ex_id,$anr,$status)";
 	$this->db->query($sql);
 }
 
 function select_where($username,$sess_id,$ex_id){
 	$username=$this->escape($username);
 	$sess_id=$this->escape($sess_id);
 	$ex_id=$this->escape($ex_id);
 	$sql="SELECT ID FROM `temporary_user_answers` WHERE user=$username AND sess_ID=$sess_id AND exam_ID=$ex_id";
 	$q=$this->db->query($sql);
 	return $q;
 }
 
 function get_sum_correct($sess_id,$username){
 	$sess_id=$this->escape($sess_id);
 	$username=$this->escape($username);
 	$sql="SELECT SUM(`status`) as jumlah FROM `temporary_user_answers` WHERE sess_ID=$sess_id AND `user`=$username";
 	$q=$this->db->query($sql);
 	foreach($q->result() as $r){
 	  return $r->jumlah;
 	}
 	return 0;
 }
 
 function insert_new_score($username,$sess_id,$score){
 	$sess_id=$this->escape($sess_id);
 	$username=$this->escape($username);
 	$score=$this->escape($score);
 	$sql="INSERT INTO `user_scores`(`ID`, `date_time`, `username`, `sess_ID`, `score`) 
 		VALUES ('',NOW(),$username,$sess_id,$score)";
 	$this->db->query($sql);
 }
 
 function get_scores($username){
 	$username=$this->escape($username);
 	$sql="SELECT * FROM user_scores WHERE username=$username";
 	$q=$this->db->query($sql);
 	return $q;
 }
 
 
 


}
?>
