<?php
$class=$this->m_oltest->select_all_classname();
$subject=$this->m_oltest->select_all_subject();
$arr_class=array();
$arr_subject=array();

foreach($class->result() as $r){
 $arr_class[$r->class_code]=ucwords($r->class_name);
}

foreach($subject->result() as $q){
 $arr_subject[$q->subject_code]=$q->subject_name;
}

?>

	<!-- start banner -->
    <div class="banner">
	  <?php echo form_open('home/check_request_exam'); ?>
	      <table style="width:50%" class="table">
		      <tr>
			      <td>Mata Pelajaran </td>
			      <td><?php echo dropdown('subject',$arr_subject,'','class="text ui-widget-content ui-corner-all"'); ?></td>
		      </tr>
		      <tr>
			      <td>Kelas </td>
			      <td><?php echo dropdown('class',$arr_class,'','class="text ui-widget-content ui-corner-all" ').br(2); ?></td>
		      </tr>
		      <tr>
		      <td colspan=3 style="text-align:right;">
		      	<?php
		      	 echo '<button type="button" class="btn btn-danger">Batal</button> '.submit('submit','start','class="btn btn-primary"');
		      	?></td>
		      </tr>
	      </table>
	  <?php echo form_close(); ?>
    </div>
 
</div>
</div>
<!-- -->
