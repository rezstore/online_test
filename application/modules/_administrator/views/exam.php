<table class="table table-hover">
 <tr>
  <th>No</th>
  <th>Mata Pelajaran</th>
  <th>Kelas</th>
  <th>Jumlah Soal</th>
  <th>Waktu</th>
  <th>Posted By</th>
  <th></th>
 </tr>
 <tr>
  <td></td>
  <td><?php 
  # CHECK DEFAULT VALUES
  if(!isset($subject))$subject="";
  if(!isset($class))$class="";
  if(!isset($count_ex))$count_ex="";
  if(!isset($time))$time="";
  if(!isset($user))$user="";
  echo form_open(get_site_url("exam/filter"));
  	$map=$this->m_admin->select_subjects();
	$arr_drp=array(""=>"All");
	foreach($map->result() as $r){
	 $arr_drp[$r->subject_code]=$r->subject_name;
	}
  	echo dropdown('mapel',$arr_drp, $subject,"style='max-width:100px;' "); 
  	?>
  </td>
  <td><?php 
		$class_data=$this->m_admin->select_class();
		$arr_kelas=array(""=>"All");
		foreach($class_data->result() as $r){
		 $arr_kelas[$r->class_code]=$r->class_name;
		}
		echo dropdown('kelas',$arr_kelas,$class ,"style='max-width:60px;' "); ?></td>
  <td><?php echo input('jumlah_soal',$count_ex,'style="width:100px;"'); ?></td>
  <td><?php echo input('waktu',$time,'style="width:100px;"'); ?></td>
  <td><?php 
		$users=$this->m_admin->get_all_users();
		$arr_users=array(""=>"All");
		foreach($users->result() as $r){
			$arr_users[$r->ID]=$r->username;
		}
		echo dropdown('user',$arr_users,$user,'style="width:100px;"'); ?></td>
  <td><?php echo submit( 'submit' , 'Cari' , 'btn btn-warning' ); 
		echo form_close();
  ?></td>
 </tr>
 <?php
  $n=1;
  foreach($datas->result() as $row){
  $ID=$row->exam_ID;
  $mapel=$row->subject_name;
  $jml_soal=$row->jumlah_soal;
  $class_code=$row->class_code;
  $subscriber=$row->subscriber;
  //echo var_dump($row);
 ?>
	 <tr>
	  <td><?php echo $n; ?></td>
	  <td><?php echo $mapel; ?></td>
	  <td><?php echo $class_code; ?></td>
	  <td><?php echo $jml_soal; ?></td>
	  <td><?php echo "60 Menit"; ?></td>
	  <td><?php echo $subscriber; ?></td>
	  <td><?php echo anchor(get_site_url("exam_detail/".$ID),button("button","Lihat","class='btn btn-primary' ")); ?></td>
	 </tr>
 <?php
 $n++;
 }
 ?>
 <tr>
	  <td colsan=7></td>
 </tr>

</table>
