<style>
td.text-left{text-indent:-30px;}
</style>

    <div class="banner">
	      <table class="table">
	        <tr>
		      <td colspan=2>
		       <p id="timer"><?php echo "05:00"; ?></p>
		      </td>
		</tr>
	      <?php
	      echo form_open(get_site_url('check_answers'));
	      $exam=$this->m_oltest->get_questions($subject,$class,$no_page);
	       if (!isset($exam))exit;
	       $no= $no_page+1;$n=1;
	       foreach($exam->result() as $r){
	        $question=$r->exam_content;
	        $a=$r->a;
	        $b=$r->b;
	        $c=$r->c;
	        $d=$r->d;
	        $e=$r->e;
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
