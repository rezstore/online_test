<style>
td.text-left{text-indent:-30px;}
</style>
<?php
$target=$c->get_session('time_start');
$ex=explode('|',$target);
//echo var_dump($ex);
$year=$ex[0];
$month=$ex[1];
$day=$ex[2];
$hour=$ex[3];
$minute=$ex[4];
$second=$ex[5];

$config = array(
	'targetDate' => array(	// Target countdown date
		'year'				=> $year,
		'month'				=> $month,
		'day'				=> $day,
		'hour'				=> $hour,
		'minute'			=> $minute,
		'second'			=> $second
	)
);

	$now = time();
	$target = mktime(
		$config['targetDate']['year'],
		$config['targetDate']['month'], 
		$config['targetDate']['day'], 
		$config['targetDate']['hour'], 
		$config['targetDate']['minute'], 
		$config['targetDate']['second']
	);

	$diffSecs = $target - $now;

	$date = array();
	$date['secs'] = $diffSecs % 60;
	$date['mins'] = floor($diffSecs/60)%60;
	$date['hours'] = floor($diffSecs/60/60)%24;
	//$date['days'] = floor($diffSecs/60/60/24)%7;
	//$date['weeks']	= floor($diffSecs/60/60/24/7);
	
	foreach ($date as $i => $d) {
		$d1 = $d%10;
		$d2 = ($d-$d1) / 10;
		$date[$i] = array(
			(int)$d2,
			(int)$d1,
			(int)$d
		);
	}

?>
<script language="Javascript" type="text/javascript" src="<?php echo get_js_family('jquery.min.js');?>"></script>
<script language="Javascript" type="text/javascript" src="<?php echo get_js_plugins('jquery.lwtCountdown-1.0.js');?>"></script>
<script language="Javascript" type="text/javascript" src="<?php echo get_js_plugins('misc.js');?>"></script>
<link rel="Stylesheet" type="text/css" href="<?php echo get_css('dark.css');?>"></link>
    <div class="banner">
	      <table class="table">
	        <tr>
		      <td colspan=1>
		       <div id="countdown_dashboard" style="text-align:right">
				<div class="dash hours_dash">
					<span class="dash_title">hours</span>
					<div class="digit"><?php echo $date['hours'][0]?></div>
					<div class="digit"><?php echo $date['hours'][1]?></div>
				</div>

				<div class="dash minutes_dash">
					<span class="dash_title">minutes</span>
					<div class="digit"><?php echo $date['mins'][0]?></div>
					<div class="digit"><?php echo $date['mins'][1]?></div>
				</div>

				<div class="dash seconds_dash">
					<span class="dash_title">seconds</span>
					<div class="digit"><?php echo $date['secs'][0]?></div>
					<div class="digit"><?php echo $date['secs'][1]?></div>
				</div>

			</div>
			<!-- Countdown dashboard end -->

			<script language="javascript" type="text/javascript">
				jQuery(document).ready(function() {
					$('#countdown_dashboard').countDown({
						targetDate: {
							'day': 		<?php echo $config['targetDate']['day']?>,
							'month': 	<?php echo $config['targetDate']['month']?>,
							'year': 	<?php echo $config['targetDate']['year']?>,
							'hour': 	<?php echo $config['targetDate']['hour']?>,
							'min': 		<?php echo $config['targetDate']['minute']?>,
							'sec': 		<?php echo $config['targetDate']['second']?>
						}
					});
				});
			</script>
		       
		       
		       
		      </td>
		</tr>
	      <?php
	      echo form_open(get_site_url('check_answers'));
	      $exam=$this->m_oltest->get_questions($subject,$class,$no_page);
	       if (!isset($exam))exit;
	       $no= $no_page+1;$n=1;
	       foreach($exam->result() as $r){
	        $question=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->exam_content);
	        $a=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->a);
	        $b=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->b);
	        $c=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->c);
	        $d=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->d);
	        $e=str_replace('src="../../../assets/uploads/',"width=100px src=\"".get_image_tes().'/',$r->e);
	      ?>
		      <tr>
			      <td colspan=2>
			       <p><span><?php echo "<strong>$no</strong>"; ?></span> &nbsp; <?php echo form_hidden('id_soal[]',$r->exam_ID).$question; ?></p>
			      </td>
			</tr>
			<tr>
			      <td style="padding-left:45px;" class="text-left">
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="A"> 
			      	   <strong>A. </strong>
			      	  </span>
			      	   <?php echo $a; ?>
			      	</p>
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="B"> 
			      	   <strong>B.</strong>
			      	  </span>
			      	  <?php echo $b; ?>
			      	</p>
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="C"> 
			      	   <strong>C.</strong>
			      	  </span>
			      	  <?php echo $c; ?>
			      	
			      	</p>
			      </td>

			      <td style="padding-left:45px;" class="text-left">
			        <p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="D"> 
			      	   <strong>D.</strong>
			      	  </span>
			      	  <?php echo $d; ?>
			      	
			      	</p>
			      	<p>
			      	  <span class="">
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="E"> 
			      	   <strong>E.</strong>
			      	  </span>
			      	  <?php echo $e; ?>
			      	</p>
			      </td>
		      </tr>
		<?php
		$no++;
		$n++;
		}
		
		?>
		<tr>
		      <td colspan=2 style="text-align:right;">
		      <?php echo form_button('button','Back','class="btn btn-warning"').nbs().submit('submit','Lanjut','class="btn btn-primary"').form_close(); ?>
		      </td>
		</tr>
	      </table>
    </div>
 
</div>
</div>
<!-- -->
