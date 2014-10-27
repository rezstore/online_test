<?php
class M_contributor extends CI_Model
{
  
  function escape($str){
	return $this->db->escape($str);
  }
  
  function insert_activity($userid,$activity){
  	$user_id=$this->escape($userid);
  	$activity=$this->escape($activity);
  	$sql="INSERT INTO adm_activities (`date`,`user_ID`,`activity`) VALUES (NOW(),$user_id,$activity)";
  	$this->db->query($sql);
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
   
   function select_detail_exam($id,$username,$mapel='',$class='',$page=0){
   	$username=$this->escape($username);
	$id=$this->escape($id);
	if($mapel == "" or $class == ""){
		$mapel='';$class=''; //unset values
		$sql="SELECT * FROM exam_questions WHERE exam_ID = $id  LIMIT 1";
		foreach($this->db->query($sql)->result() as $r){
			$mapel=$r->subject_code;
			$class=$r->class_code;
		}
	}else{
		
	}
		$mapel=$this->escape($mapel);
		$class=$this->escape($class);
		$sql="SELECT exam_questions.exam_ID ,
					exam_questions.subject_code ,
					exam_questions.class_code ,
					exam_questions.exam_content , 
			choice_answers.a,
			choice_answers.b,
			choice_answers.c,
			choice_answers.d,
			choice_answers.e,
				correct_answer.answer ,
				adm_users.username as subscriber
		FROM exam_questions 
		LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		LEFT JOIN choice_answers ON choice_answers.exam_ID = exam_questions.exam_ID
		LEFT JOIN correct_answer ON correct_answer.exam_ID = exam_questions.exam_ID
		 	WHERE exam_questions.class_code=$class 
		 		and exam_questions.subject_code=$mapel 
		 		and adm_users.username = $username LIMIT $page,10";
		return $this->db->query($sql);
		exit;
   }
   
   function select_class(){
	$sql="SELECT class_code,class_name FROM class_options WHERE status=1";
	$q=$this->db->query($sql);
	return $q;
   }
   
   function insert_new($username,$mapel,$soal){
    $s=explode('-',$mapel);
    //echo var_dump($s);
    $soal=$this->escape($soal);
    $subject=$this->escape($s[0]);
    $class=$this->escape($s[1]);
    $user=$this->select_user_ID($username);
    
    $sql="INSERT INTO exam_questions (`user_ID`,`subject_code`,`class_code`,`exam_content`) 
    		VALUES ($user,$subject,$class,$soal)";
    $this->db->query($sql);
   }
   
   function insert_answer_options($exam_id, $a, $b, $c, $d, $e, $true){
	$id=$this->escape($exam_id);
	$a=$this->escape($a);
	$b=$this->escape($b);
	$c=$this->escape($c);
	$d=$this->escape($d);
	$e=$this->escape($e);
	$true=$this->escape($true);
	$sql="INSERT INTO `choice_answers` (`exam_ID`, `a`, `b`, `c`, `d`, `e`) 
		VALUES ($id, $a, $b, $c, $d, $e)";
	$sql_answer="INSERT INTO correct_answer (`exam_ID`,`answer`) VALUES ($id,$true)";
	if($this->db->query($sql)){
		$this->db->query($sql_answer);
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
   
   function update_exam_question($user_ID,$id,$question,$a,$b,$c,$d,$e,$answer){
	$user=$this->escape($user_ID);
	$id=$this->escape($id);
	$question=$this->escape($question);
	$a=$this->escape($a);
	$b=$this->escape($b);
	$c=$this->escape($c);
	$d=$this->escape($d);
	$e=$this->escape($e);
	$answer=$this->escape($answer);
	$update_question="UPDATE exam_questions SET exam_content=$question WHERE exam_ID=$id and user_ID=$user";
	$update_answer_option="UPDATE choice_answers SET a=$a,b=$b,c=$c,d=$d,e=$e WHERE exam_ID=$id";
	$update_answer="UPDATE correct_answer SET answer=$answer WHERE exam_ID=$id";
	if($this->db->query($update_question)){
		if($this->db->query($update_answer_option)){
			$this->db->query($update_answer);
		}
	}
   }
   
   function delete_exam($id,$username){
	$id=$this->escape($id);
	$mapel='';$class='';
	$sql="SELECT * FROM exam_questions WHERE exam_ID = $id  LIMIT 1";
	foreach($this->db->query($sql)->result() as $r){
		$mapel=$r->subject_code;
		$class=$r->class_code;
	}
	$sql="DELETE FROM exam_questions WHERE exam_ID=$id ";
	$sql_delete_answer_opt="DELETE FROM choice_answers WHERE exam_ID=$id";
	$sql_answer="DELETE FROM correct_answer WHERE exam_ID=$id";
	if($this->db->query($sql)){
		if($this->db->query($sql_delete_answer_opt)){
			$this->db->query($sql_answer);
		}
	}
	return $mapel.'-'.$class;
   }
   
   function select_ID_question($user_ID,$mapel,$soal){
   	$user_id=$this->escape($user_ID);
		$s=explode('-',$mapel);
		$subject=$this->escape($s[0]);
		$class=$this->escape($s[1]);
   	$soal=$this->escape($soal);
   	$sql="SELECT exam_ID FROM exam_questions WHERE user_ID=$user_id and subject_code=$subject and class_code=$class ORDER BY exam_ID DESC LIMIT 1";
   	$q=$this->db->query($sql);
   	foreach($q->result() as $r){
   		return $r->exam_ID;
   	}
   }
   
   function select_activity_where($userid,$month){
   	$userid=$this->escape($userid);
   	$month=$this->escape($month);
   	$sql="SELECT p.*,COUNT(p.ID) as total FROM (SELECT *,MONTH(date) as bulan FROM adm_activities ) p 
   			WHERE p.user_ID=$userid AND p.bulan=$month GROUP BY p.date ORDER BY p.bulan DESC";
   	$q=$this->db->query($sql);
   	return $q;
   }
   
   function get_data_activities_for_chart($userid){
   	$userid=$this->escape($userid);
   	$sql="SELECT *,COUNT(ID) as total FROM adm_activities WHERE user_ID=$userid GROUP BY date ORDER BY date ASC";
   	$q=$this->db->query($sql);
   	return $q;
   }
   
   function select_date_from_activities($id){
   	$id=$this->escape($id);
   	$sql="SELECT date FROM adm_activities WHERE ID=$id";
   	$q=$this->db->query($sql);
   	foreach($q->result() as $r){
   		return $r->date;
   	}
   }
   
   function select_activities_where($date,$userid){
   	$date=$this->escape($date);
   	$userid=$this->escape($userid);
   	$sql="SELECT * FROM adm_activities WHERE date=$date AND user_ID=$userid";
   	$q=$this->db->query($sql);
   	return $q;
   }
   
   function get_total_rec($table_name,$userid='',$mapel='',$class=''){
   	$table=$this->escape($table_name);
   	$userid=$this->escape($userid);
   	$subject=$this->escape($mapel);
	$class=$this->escape($class);
   	$sql="SELECT COUNT(*) as total FROM $table_name WHERE user_ID=$userid AND subject_code=$subject AND class_code=$class";
   	$q=$this->db->query($sql);
   	foreach($q->result() as $r){
   		return $r->total;
   	}
   }
   
   function select_password_setting($username){
   	$username=$this->escape($username);
   	$sql="SELECT password FROM adm_users WHERE username=$username";
   	$q=$this->db->query($sql);
   	return $q;
   }
   
   function update_user_pass($username,$pass){
   	$username=$this->escape($username);
   	$password=$this->escape($pass);
   	$sql="UPDATE adm_users SET password=$password WHERE username=$username";
   	$this->db->query($sql);
   }
   


}
//end of file 
