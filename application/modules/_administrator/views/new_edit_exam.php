<?php
if (isset($datas)){
	 foreach($datas->result() as $r){
		$question=$r->exam_content;
		$jawab_a=$r->a;
		$jawab_b=$r->b;
		$jawab_c=$r->c;
		$jawab_d=$r->d;
		$jawab_e=$r->e;
		$jawaban=$r->answer;
		$action="";
	 }
 }else{
	$question="";
	$jawab_a="";
	$jawab_b="";
	$jawab_c="";
	$jawab_d="";
	$jawab_e="";
	$jawaban="";
	$action=get_site_url("insert_todb");
 }

?>
<table class="table table-hover">
<?php echo form_open($action); ?>
 <tr>
  <td>Pertanyaan</td>	<td>:</td>	
  	<td colspan=4>
  	 <?php echo textarea('soal',$question,'editor'); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban</td>	<td>:</td>
  	<td>A</td>
  	<td>
  	 <?php echo textarea('jawab_a',$jawab_a,'editor_answers '); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban</td>	<td>:</td>
 	<td>B</td>
  	<td>
  	 <?php echo textarea('jawab_b',$jawab_b,'editor_answers'); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban</td>	<td>:</td>
 	<td>C</td>
  	<td>
  	 <?php echo textarea('jawab_c',$jawab_c,'editor_answers'); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban</td>	<td>:</td>
 	<td>D</td>
  	<td>
  	 <?php echo textarea('jawab_d',$jawab_d,'editor_answers'); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban</td>	<td>:</td>
 	<td>E</td>
  	<td>
  	 <?php echo textarea('jawab_e',$jawab_e,'editor_answers'); ?>
  	</td>
 </tr>
 <tr>
  <td>Jawaban Benar</td>	<td>:</td>
 	<td></td>
  	<td>
  	 <?php echo dropdown('answer',array(''=>'--Pilih Jawaban--','a'=>'A','b'=>'B','c'=>'C','d'=>'D','e'=>'E'),$jawaban); ?>
  	</td>
 </tr>
 <tr>
	  <td colsan=9>
	  <?php
	  echo submit('submit','Insert',"class='btn btn-primary'");
	  ?>
	  </td>
 </tr>
<?php echo form_close(); ?>
</table>
<script src="<?php echo get_tinymce_files('tinymce/tinymce.min.js');?>"></script>
<script>
tinymce.init({
    selector: ".editor",theme: "modern",width: 680,height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"<?php echo get_tinymce_files('filemanager'); ?>/",
   filemanager_title:"File Manager" ,
   external_plugins: { "filemanager" : "<?php echo get_tinymce_files('filemanager/plugin.min.js'); ?>"}
 });
 
 //FOR ANSWERS
 
tinymce.init({
    selector: ".editor_answers",theme: "modern",width: 680,height: 150,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media ",
   image_advtab: true ,
   
   external_filemanager_path:"<?php echo get_tinymce_files('filemanager'); ?>/",
   filemanager_title:"File Manager" ,
   external_plugins: { "filemanager" : "<?php echo get_tinymce_files('filemanager/plugin.min.js'); ?>"}
 });
</script>
