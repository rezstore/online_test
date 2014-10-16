<?php
class M_admin extends CI_Model
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
   
   function select_all_exam($id=""){
    if ($id != ""){
		$id=$this->escape($id);
		$sql="SELECT * FROM exam_questions WHERE exam_ID = $id LIMIT 1";
		foreach($this->db->query($sql)->result() as $r){
			$mapel=$this->escape($r->subject_code);
			$class=$this->escape($r->class_code);
			$sql="SELECT exam_questions.*,subjects.subject_name FROM exam_questions 
			 LEFT JOIN subjects ON subjects.subject_code=exam_questions.subject_code 
			 WHERE exam_questions.class_code=$class and exam_questions.subject_code=$mapel";
			return $this->db->query($sql);
			exit;
		}
	}
		$sql="SELECT * ,COUNT(exam_questions.exam_ID) as jumlah_soal,adm_users.username as subscriber
		FROM exam_questions LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		GROUP BY exam_questions.subject_code, exam_questions.class_code";
  	return $this->db->query($sql);

   }
   
   function select_class(){
	$sql="SELECT class_code,class_name FROM class_options WHERE status=1";
	$q=$this->db->query($sql);
	return $q;
   }
   
   function select_all_exam_filter($subject="",$class="",$count_ex="",$time="",$user=""){
   $sbj=$this->escape($subject);		$cls=$this->escape($class);
   $count=$this->escape($count_ex);		$tm=$this->escape($time);
   $usr=$this->escape($user);
   $time="";
    if ($subject != ""){	$subject=" exam_questions.subject_code = $sbj ";}
	if ($class !== ""){	if($subject != ""){ $class=" AND exam_questions.class_code = $cls ";}else{$class=" exam_questions.class_code = $cls ";}}
	if ($count_ex != ""){	if($subject != "" or $class != ""){$count_ex=" AND jumlah_soal = $count ";}else{$count_ex="jumlah_soal = $count ";} }
	//if ($time != ""){	$time=" AND exam_questions.subject_code = $tm";}
	if ($user != ""){ if($subject != "" or $class != "" or $count_ex != ""){$user=" AND exam_questions.user_ID = $usr ";}else{ $user="exam_questions.user_ID = $usr ";}}
	 if($subject != "" or $class != "" or $count_ex != "" or $user != ""){$where="WHERE";}else{$where="";}
	 $sql="SELECT * ,COUNT(exam_questions.exam_ID) as jumlah_soal,adm_users.username as subscriber
		FROM exam_questions LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		$where $subject  $class  $count_ex  $time  $user
		GROUP BY exam_questions.subject_code, exam_questions.class_code
		";
  	return $this->db->query($sql);   
   }
   
   function get_all_users(){
	$sql="SELECT ID,username FROM adm_users WHERE 1";
	$q=$this->db->query($sql);
	return $q;
   }
   
   function select_detail_exam($id){
	$id=$this->escape($id);
	$sql="SELECT * FROM exam_questions WHERE exam_ID = $id  LIMIT 1";
	foreach($this->db->query($sql)->result() as $r){
		$mapel=$this->escape($r->subject_code);
		$class=$this->escape($r->class_code);
		$sql="SELECT exam_questions.exam_ID ,exam_questions.subject_code ,exam_questions.class_code ,exam_questions.exam_content , 
			subjects.subject_name,
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
		 WHERE exam_questions.class_code=$class and exam_questions.subject_code=$mapel ";
		return $this->db->query($sql);
		exit;
	}
   }
   
   function select_all_exam_where($id){
	$id=$this->escape($id);
	$sql="SELECT exam_questions.exam_content ,choice_answers.*,correct_answer.answer 
			FROM exam_questions
			LEFT JOIN choice_answers ON choice_answers.exam_ID = exam_questions.exam_ID
			LEFT JOIN correct_answer ON correct_answer.exam_ID = exam_questions.exam_ID
			WHERE exam_questions.exam_ID=$id LIMIT 1";
	return $this->db->query($sql);
   }
   
   function update_exam_question($id,$question,$a,$b,$c,$d,$e,$answer){
	$id=$this->escape($id);
	$question=$this->escape($question);
	$a=$this->escape($a);
	$b=$this->escape($b);
	$c=$this->escape($c);
	$d=$this->escape($d);
	$e=$this->escape($e);
	$answer=$this->escape($answer);
	$update_question="UPDATE exam_questions SET exam_content=$question WHERE exam_ID=$id";
	$update_answer_option="UPDATE choice_answers SET a=$a,b=$b,c=$c,d=$d,e=$e WHERE exam_ID=$id";
	$update_answer="UPDATE correct_answer SET answer=$answer WHERE exam_ID=$id";
	if($this->db->query($update_question)){
		if($this->db->query($update_answer_option)){
			$this->db->query($update_answer);
		}
	}
   }
   
   function delete_exam($id){
	$id=$this->escape($id);
	$sql="DELETE FROM exam_questions WHERE exam_ID=$id ";
	$sql_delete_answer_opt="DELETE FROM choice_answers WHERE exam_ID=$id";
	$sql_answer="DELETE FROM correct_answer WHERE exam_ID=$id";
	if($this->db->query($sql)){
		if($this->db->query($sql_delete_answer_opt)){
			$this->db->query($sql_answer);
		}
	}
   }
   
   function insert_new_question($username,$mapel,$soal){
    $s=explode('-',$mapel);
    //echo var_dump($s);
    $soal=$this->escape($soal);
    $subject=$this->escape($s[0]);
    $class=$this->escape($s[1]);
    $user=$this->select_user_ID($username);
    
    $sql="INSERT INTO exam_questions (`user_ID`,`subject_code`,`class_code`,`exam_content`) 
    		VALUES ($user,$subject,$class,$soal)";
    $this->db->query($sql);
	# SELECT GET ID_EXAM
	$sql="SELECT exam_ID FROM exam_questions 
				WHERE user_ID=$user AND subject_code=$subject AND class_code=$class 
				AND exam_content=$soal ORDER BY exam_ID DESC LIMIT 1 ";
    $q=$this->db->query($sql);
	foreach($q->result() as $r){
		return $r->exam_ID;
	}
	
   }
   
   function insert_new_options_and_answer($exam_id, $a, $b, $c, $d, $e, $true){
	$id=$this->escape($exam_id);
	$a=$this->escape($a);
	$b=$this->escape($b);
	$c=$this->escape($c);
	$d=$this->escape($d);
	$e=$this->escape($e);
	$true=$this->escape($true);
	$sql="INSERT INTO `choice_answers` (`exam_ID`, `a`, `b`, `c`, `d`, `e`) 
		VALUES ($id, $a, $b, $c, $d, $e)";
	$this->db->query($sql);
	$sql="INSERT INTO correct_answer (`exam_ID`,`answer`) VALUES ($id,$true)";
	$this->db->query($sql);
   }
   
   


}
//end of file 
