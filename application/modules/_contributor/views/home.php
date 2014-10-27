<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "<?php echo get_site_url('get_graphic_activities/'.$ctrl->check_username()); ?>",
          dataType:"json",
          async: false
          }).responseText;
      var titleChart = "Aktivitas Bulanan";/*$.ajax({
          url: "Aktivitas Bulanan",
          dataType:"text",
          async: false
          }).responseText;*/
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      var options = {
          title: titleChart,
          pointSize: 10,
          width: 800, 
          height: 350,
          
        };
      chart.draw(data, options);
    }

    </script>
<table class="table">
 <tr>
  <td colspan=4> Data Aktivitas User</td>
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
  <th> Total </th>
 </tr>
 <?php 
  if (isset($activities)){
  $no=1;
    foreach($activities->result() as $row){
     $id=$row->ID;
     $date = date_create($row->date);
     $date=date_format($date,'d-M-Y');
     $activity=$row->activity;
     $total=$row->total;
     $button_lihat=anchor(get_site_url("show_detail/$id"),"Lihat",'class="btn btn-primary"').' ';
     $button_edit="";//anchor(get_site_url(""),"Edit",'class="btn"');
	echo "<tr>"
	 ."<td>".$no."</td>"
	 ."<td>".$date."</td>"
	 ."<td>".$activity."</td>"
	 ."<td>".$total."</td>"
	 ."<td>".$button_lihat.$button_edit."</td>"
	."</tr>";
	$no++;
    }	
  }
 ?>

</table>
