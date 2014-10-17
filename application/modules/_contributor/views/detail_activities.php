<table class="table">
 <tr>
  <td colspan=4> Data Aktivitas User <sup>Per</sup>Tanggal: <span id="tgl_" style="font-weight:bold"></span></td>
 </tr>
 
 <tr>
  <td colspan=4>
   <!-- ISI GRAFIK -->
   <div id="chart_div"></div>
  </td>
 </tr>
 
 <tr>
  <th> NO </th>
  <th> TANGGAL </th>
  <th> AKTIVITAS </th>
 </tr>
 <?php 
  if (isset($activities)){
  $no=1;
    foreach($activities->result() as $row){
     $id=$row->ID;
     $date = date_create($row->date);
     $date=date_format($date,'d-M-Y');;
     $activity=$row->activity;
     $button_lihat=anchor(get_site_url("show_detail/$id"),"Lihat",'class="btn btn-primary"').' ';
     $button_edit="";//anchor(get_site_url(""),"Edit",'class="btn"');
	echo "<tr>"
	 ."<td>".$no."</td>"
	 ."<td>".$date."</td>"
	 ."<td>".$activity."</td>"
	."</tr>";
	$no++;
    }	
  }
 ?>

</table>
<script>
 var tl=document.getElementById("tgl_");
 tl.innerHTML="<?php echo $date; ?>";
</script>
