    <div class="banner">
	      <table class="table">
	      <?php
	      echo form_open('check_answers');
	      $exam=$this->m_oltest->get_questions($subject,$class,$no_page);
	       if (!isset($exam))exit;
	       $n= $no_page+1;
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
			       <p><span><?php echo "<strong>$n</strong>"; ?></span> &nbsp; <?php echo $question; ?></p>
			      </td>
			</tr>
			<tr>
			      <td style="text-indent:20px;">
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="option1"> 
			      	   <strong>A. </strong>
			      	  </span>
			      	   <?php echo $a; ?>
			      	</p>
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="option1"> 
			      	   <strong>B.</strong>
			      	  </span>
			      	  <?php echo $b; ?>
			      	</p>
			      	<p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="option1"> 
			      	   <strong>C.</strong>
			      	  </span>
			      	  <?php echo $c; ?>
			      	
			      	</p>
			      </td>

			      <td>
			        <p>
			      	  <span>
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="option1"> 
			      	   <strong>D.</strong>
			      	  </span>
			      	  <?php echo $d; ?>
			      	
			      	</p>
			      	<p>
			      	  <span class="">
			      	   <input type="radio" name="answer<?php echo $n;?>" id="optionsRadios1" value="option1"> 
			      	   <strong>E.</strong>
			      	  </span>
			      	  <?php echo $e; ?>
			      	</p>
			      </td>
		      </tr>
		<?php
		$n++;
		}
		echo form_close();
		?>
		<tr>
		      <td colspan=2 style="text-align:right;">
		      <?php echo form_button('button','Back','class="btn btn-warning"').nbs().submit('submit','Lanjut','class="btn btn-primary"'); ?>
		      </td>
		</tr>
	      </table>
    </div>
 
</div>
</div>
<!-- -->
