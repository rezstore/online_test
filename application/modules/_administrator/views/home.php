<table class="table">
 <tr>
  <th>No</th>
  <th>Mata Pelajaran</th>
  <th>Jumlah Soal</th>
  <th>Waktu</th>
  <th>Posted By</th>
 </tr>
 <tr>
  <td></td>
  <td><?php 
  	$map=$this->m_admin->select_exam($ctrl->get_session('user'));
  	echo dropdown('mapel',array('asd'=>"asd"),''); 
  	?></td>
  <td><?php echo input('jumlah_soal','',''); ?></td>
  <td><?php echo input('waktu','',''); ?></td>
  <td><?php echo input('user','',''); ?></td>
 </tr>
 <?php
  foreach($datas->result() as $row){
  $mapel=$row->subject_name;
  $jml_soal=$row->jumlah_soal;
  
 ?>
	 <tr>
	  <td></td>
	  <td><?php echo ""; ?></td>
	  <td><?php echo ""; ?></td>
	  <td><?php echo "60 Menit"; ?></td>
	  <td><?php echo ""; ?></td>
	 </tr>
 <?php
 }
 ?>

</table>
