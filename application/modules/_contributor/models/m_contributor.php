<?php
class M_contributor extends CI_Model
{
  
  function escape($str){
	return $this->db->escape($str);
  }
  
  function select_user_ID($username){
  	$username=$this->escape($username);
  	$sql="SELECT ID FROM adm_users WHERE username=$username LIMIT 1";
  	$q=$this->db->query($sql);
  	foreach($q->result() as $r){
  	  return $r->ID;
  	}
  }
  
  function select_subjects()
   {
   	$sql="SELECT * 
		FROM subjects
		WHERE status = 1";
  	return $this->db->query($sql);
   }
   
   function select_all_exam($username){
    if ($username != ""){
		$username=$this->escape($username);
		$sql="SELECT * ,COUNT(exam_questions.exam_ID) as jumlah_soal,adm_users.username as subscriber
		FROM exam_questions LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		WHERE adm_users.username = $username
		GROUP BY exam_questions.subject_code, exam_questions.class_code";
	  	return $this->db->query($sql);
	}

   }
   
   function select_detail_exam($id,$username){
   	$username=$this->escape($username);
	$id=$this->escape($id);
	$sql="SELECT * FROM exam_questions WHERE exam_ID = $id  LIMIT 1";
	foreach($this->db->query($sql)->result() as $r){
		$mapel=$this->escape($r->subject_code);
		$class=$this->escape($r->class_code);
		$sql="SELECT exam_questions.exam_ID ,exam_questions.subject_code ,exam_questions.class_code ,exam_questions.exam_content , 
			choice_answers.a,
			choice_answers.b,
			choice_answers.c,
			choice_answers.d,
			choice_answers.e,
			correct_answer.answer ,adm_users.username as subscriber
		FROM exam_questions 
		LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		LEFT JOIN choice_answers ON choice_answers.exam_ID = exam_questions.exam_ID
		LEFT JOIN correct_answer ON correct_answer.exam_ID = exam_questions.exam_ID
		 WHERE exam_questions.class_code=$class and exam_questions.subject_code=$mapel and adm_users.username = $username";
		return $this->db->query($sql);
		exit;
	}
   }
   
   function select_class(){
	$sql="SELECT class_code,class_name FROM class_options WHERE status=1";
	$q=$this->db->query($sql);
	return $q;
   }
   
   function insert_new($username,$mapel,$soal, $a, $b, $c, $d, $e, $true){
    $s=explode('-',$mapel);
    //echo var_dump($s);
    $soal=$this->escape($soal);
    $subject=$this->escape($s[0]);
    $class=$this->escape($s[1]);
    $user=$this->select_user_ID($username);
    $a=$this->escape($a);
    $b=$this->escape($b);
    $c=$this->escape($c);
    $d=$this->escape($d);
    $e=$this->escape($e);
    $true=$this->escape($true);
    $sql="INSERT INTO exam_questions (`user_ID`,`subject_code`,`class_code`,`exam_content`) 
    		VALUES ($user,$subject,$class,$soal)";
    	$this->db->query($sql);
   }


}
//end of file 