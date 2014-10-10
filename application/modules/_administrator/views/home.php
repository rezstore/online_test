<table class="table">
 <tr>
  <th>No</th>
  <th>Mata Pelajaran</th>
  <th>Jumlah Soal</th>
  <th>Waktu</th>
  <th>Posted By</th>
  <th></th>
 </tr>
 <tr>
  <td></td>
  <td><?php 
  	$map=$this->m_admin->select_subjects();
	$arr_drp=array();
	foreach($map->result() as $r){
	 $arr_drp[$r->subject_code]=$r->subject_name;
	}
  	echo dropdown('mapel',$arr_drp,''); 
  	?>
  </td>
  <td><?php echo input('jumlah_soal','','style="width:100px;"'); ?></td>
  <td><?php echo input('waktu',' ','style="width:100px;"'); ?></td>
  <td><?php echo input('user','',''); ?></td>
  <td><?php echo button('user','Cari','class="btn btn-warning" '); ?></td>
 </tr>
 <?php
  $n=1;
  foreach($datas->result() as $row){
  $mapel=$row->subject_name;
  $jml_soal=$row->jumlah_soal;
  $subscriber=$row->subscriber;
  $active="";
  if($n%2 == 1){
    $active="active";
  }
 ?>
	 <tr class="<?php echo $active; ?>">
	  <td><?php echo $n; ?></td>
	  <td><?php echo $mapel; ?></td>
	  <td><?php echo $jml_soal; ?></td>
	  <td><?php echo "60 Menit"; ?></td>
	  <td><?php echo $subscriber; ?></td>
	  <td><?php echo button("button","Lihat","class='btn btn-primary'"); ?></td>
	 </tr>
 <?php
 $n++;
 }
 ?>

</table>
