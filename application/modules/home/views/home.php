<!DOCTYPE HTML>
<html>
<head>
     <title>p</title>
	<link href="<?php echo get_css('style.css');?>" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo get_css('custom.css');?>" rel='stylesheet' type='text/css'>
	
	</head>
	<body>
	<div class="content">
			<div class="wrap">
				<div class="content-grid">
			<p><img src="<?php echo get_image('top.png');?>" title=""></p>
				</div>
				<div class="grid">
		<p><img src="<?php echo get_image('coming.png');?>" title=""></p>
		<h3>We are Still Working on it.</h3>
		<form action="" method= "POST">
			<input type="text" size="30" value="Masukkan Nama..." onblur="if (this.value=='') this.value = 'Masukkan Nama ...'" onfocus="this.value = ''" name="user" style="width:150px;-webkit-border-radius: 3px;border-radius: 10px;">
			<input type="text" size="30" value="Masukkan Email..." onblur="if (this.value=='') this.value = 'Masukkan Email ...'" onfocus="this.value = ''" name="email" id="email">
			 <a href="<?php echo get_site_url('test');?>">
			 	<button type="submit" class="btn span btn-4 btn-4a icon-arrow-right"><span></span></button>
			 </a>
			<div id="response"></div>
				
			</form>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
		<div class="footer">
		 <p class="a">
			<a href="<?php echo get_site_url('');?>">
			 <img src="<?php echo get_image('facebook.png');?>" title="">
			</a>
			<a href="<?php echo get_site_url('');?>">
			 <img src="<?php echo get_image('twitter.png');?>" title="">
			</a>
		 </p>
		<p>Copyright 2013&nbspTemplate by <a href="#"> w3layouts.com</a> </p>
		</div>
		<div class="clear"></div>
		</div>
		</div>
		<div class="clear"></div>
</body>
</html>
