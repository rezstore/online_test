<?php
function get_css($filename=''){
 return base_url('assets/oltest/css/'.$filename);
}
function get_common($filename=''){
 return base_url('assets/'.$filename);
}

function get_css_jquery($filename=''){
 return base_url('assets/css/jquery_css/'.$filename);
}

function get_jquery_css($filename=''){
 return base_url('assets/css/jquery_css/'.$filename);
}

function get_js($filename=''){
 return base_url('assets/js/'.$filename);
}

function get_js_family($filename=''){
 return base_url('assets/js/jquery-family/'.$filename);
}

function get_image($filename=''){
 return base_url('assets/oltest/images/'.$filename);
}

function get_image_post($filename='',$type=''){
 if($type == "basedir"){
  return PUBPATH.'assets/uploads/oltest/'.$filename;
 }
 return base_url('assets/uploads/oltest/'.$filename);
}

function get_site_url($pagename=''){
 return site_url('_administrator/'.$pagename);
}

function get_tinymce_files($filename){
	return base_url('assets/tinymce/'.$filename);
}

#----------------------------------------------------------------------
function input($name='',$value='',$class=''){
 return form_input($name,$value,'class="form_control" '.$class);
}

function dropdown($name='',$arr=array(),$value='',$class=''){
 return form_dropdown($name,$arr,$value,'class="form_control" '.$class);
}

function textarea($name='',$value='',$class=''){
 return form_textarea($name,$value,'class='.$class);
}

function upload($name='',$value='',$class=''){
 return form_upload($name,$value,'class="form_control" '.$class);
}

function submit($name='',$value='',$class=''){
 return form_submit($name,$value,$class);
}

function button($name='',$value='',$class=''){
 return form_button($name,$value,$class);
}

?>
