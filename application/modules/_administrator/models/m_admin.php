<?php
class M_admin extends CI_Model
{
  
  function escape($str){
	return $this->db->escape($str);
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


}
//end of file 
