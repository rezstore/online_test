<table class="table">
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
  	$map=$this->m_admin->select_subjects();
	$arr_drp=array("0"=>"All");
	foreach($map->result() as $r){
	 $arr_drp[$r->subject_code]=$r->subject_name;
	}
  	echo dropdown('mapel',$arr_drp,' ',"style='max-width:100px;' "); 
  	?>
  </td>
  <td><?php 
		$class=$this->m_admin->select_class();
		$arr_kelas=array(""=>"All");
		foreach($class->result() as $r){
		 $arr_kelas[$r->class_code]=$r->class_name;
		}
		echo dropdown('kelas',$arr_kelas,' ' ,"style='max-width:50px;' "); ?></td>
  <td><?php echo input('jumlah_soal','','style="width:100px;"'); ?></td>
  <td><?php echo input('waktu',' ','style="width:100px;"'); ?></td>
  <td><?php echo input('user','','style="width:100px;"'); ?></td>
  <td><?php echo button('user','Cari','class="btn btn-warning"'); ?></td>
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
