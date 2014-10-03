<style>
td.text-left{text-indent:-30px;}
h2{text-align:left;}
</style>

    <div class="banner">
     <h2>MY SCORES</h2>
	      <table class="table" style="width:50%;">
	        <tr>
		      <th>NO</th>
		      <th>Tangal</th>
		      <th>Mata Pelajaran</th>
		      <th>Kelas</th>
		      <th>Nilai</th>
		</tr>
	       <?php
	        $no=1;
	        if(!isset($datas)) exit;
	        foreach($datas->result() as $r){
	         $username=$r->username;
	         $date=$r->date_time;
	         $sess_id=$r->sess_ID;
	          $arr=explode('-',$sess_id);
	         	$subject=$this->m_oltest->get_subject($arr[1]);
	         	$class=$this->m_oltest->get_class($arr[2]);
	         $score=$r->score;
	         	$style='';
	         	if($score < 60){
	         	  $style='color:red;';
	         	}
	       ?>
			<tr>
			      <td><?php echo $no; ?></td>
			      <td><?php echo $date; ?></td>
			      <td><?php echo $subject; ?></td>
			      <td><?php echo $class; ?></td>
			      <td style="<?php echo $style; ?>"><?php echo $score; ?></td>
			</tr>
		<?php
		$no++;
		}
		
		?>
		<tr>
		      <td colspan=2 style="text-align:right;">
		      <?php  ?>
		      </td>
		</tr>
	      </table>
    </div>
 
</div>
</div>
<!-- -->
