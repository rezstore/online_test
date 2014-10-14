<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?php if (isset($title)){echo $title;}else{echo "title";} ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- google fonts -->

<!-- end google fonts -->
<link href="<?php echo get_css('style2.css');?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo get_css('bootstrap.css');?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo get_css_jquery('jquery-ui.css');?>" rel="stylesheet" type="text/css" media="all" />
<!--nav-->
<script src="<?php echo get_js_family('jquery.min.js');?>"></script>
<script src="<?php echo get_js_family('jquery-ui.js');?>"></script>

<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
</script>
</head>
<body>
<?php
$contact_active="";
$blog_active="";
$about_active="";
$home_active="";

if ($active == "contact"){
 $contact_active=" class='active'";
}elseif ($active == "blog"){
 $blog_active=" class='active'";
}elseif ($active == "about"){
 $about_active=" class='active'";
}else{
 $home_active=" class='active'";
}
?>
<div class="body">
<div class="wrap">
<div class="wrapper">
	<!-- start header-->
	<div class="header">
		<div class="logo">
			<a href="<?php echo get_site_url('index');?>"><img src="<?php echo get_image('logo.png');?>" alt=""></a>
		</div>
		<div class="cssmenu">
			<ul>
			  	<li<?php echo $home_active; ?>><a href="<?php echo get_site_url('');?>">Home</a></li>
				<li<?php echo $blog_active; ?>><a href="<?php echo get_site_url('blog');?>">Blog</a></li>
				<li<?php echo $about_active; ?> ><a href="<?php echo get_site_url('about');?>">About</a></li>
				<li<?php echo $contact_active; ?> ><a href="<?php echo get_site_url('contact');?>">Contact</a></li>
				<li><a href="<?php echo get_site_url('logout');?>" style="color:red;">out</a></li>
				<div class="clear"></div>
			 </ul>
		</div>
		<div class="clear"></div>
		<div class="top-nav">
		<nav class="clearfix">
				<ul>
					<li><a href="<?php echo get_site_url('test');?>">Home</a></li>
					<li><a href="<?php echo get_site_url('portofolio');?>">Portfolio</a></li>
					<li><a href="<?php echo get_site_url('blog');?>">Blog</a></li>
					<li ><a href="<?php echo get_site_url('about');?>">About</a></li>
					<li ><a href="<?php echo get_site_url('contact');?>">Contact</a></li>
					
				</ul>
				<a href="#" id="pull">Menu</a>
			</nav>
		</div>
	</div>
