<?php
class M_login extends CI_Model
{
  
  function select_user_where($user)
   {
   	$user=$this->db->escape($user);
   	echo $sql="SELECT * FROM adm_users where username= $user AND status=1 LIMIT 1";
  	return $this->db->query($sql);
   }


}
//end of file 
