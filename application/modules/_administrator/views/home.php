<table class="table">
 <tr>
  <th> GRAFIK </th>
 </tr>
 <tr>
<<<<<<< HEAD
  <td class="span1"></td>
=======
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
>>>>>>> 5454ab83a85a81ca558d65a07c4e3bc755428fd4
 </tr>

</table>
