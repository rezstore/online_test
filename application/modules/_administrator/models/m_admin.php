<?php
class M_admin extends CI_Model
{
  
  function select_subjects()
   {
   	$sql="SELECT * 
		FROM subjects
		WHERE status = 1";
  	return $this->db->query($sql);
   }
   
   function select_all_exam(){
		$sql="SELECT * ,COUNT(exam_questions.exam_ID) as jumlah_soal,adm_users.username as subscriber
		FROM exam_questions LEFT JOIN subjects ON exam_questions.subject_code=subjects.subject_code
		LEFT JOIN adm_users ON adm_users.ID=exam_questions.user_ID
		GROUP BY exam_questions.subject_code, exam_questions.class_code";
  	return $this->db->query($sql);

   }


}
//end of file 
