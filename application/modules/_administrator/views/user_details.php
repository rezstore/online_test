<table class="table table-hover">
 <tr>
  <th>No</th>
  <th>Username</th>
  <th>Password</th>
  <th>Level</th>
  <th></th>
 </tr>
 <?php
  $n=1;
  foreach($details->result() as $row){
  $ID=$row->ID;
  $username=$row->username;
  $pass=$row->password;
  $level=$row->level;
  $status=$row->status;
  //echo var_dump($row);
 ?>
	 <tr>
	  <td><?php echo $n; ?></td>
	  <td><?php echo $username; ?></td>
	  <td><?php echo md5($pass); ?></td>
	  <td><?php echo $level; ?></td>
	  <td><?php echo anchor(get_site_url("user_detail/".$ID),"Lihat","class='btn btn-primary' "); ?></td>
	 </tr>
 <?php
 $n++;
 }
 ?>
 <tr>
	  <td colspan=5></td>
 </tr>

</table>
