<?php
class M_admin extends CI_Model
{
  
  function select_exam($user_ID)
   {
   	$user=$this->db->escape($user_ID);
   	$sql="SELECT * 
		FROM exam_questions 
		GROUP BY user_ID, subject_code, class_code";
  	return $this->db->query($sql);
   }


}
//end of file 
