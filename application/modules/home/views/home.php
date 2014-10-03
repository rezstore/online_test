<!DOCTYPE HTML>
<html>
<head>
     <title>Online Tes</title>
	<link href="<?php echo get_css('style.css');?>" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo get_css('custom.css');?>" rel='stylesheet' type='text/css'>
	<style>
	 p.heading{margin-top:-40px;margin-bottom:40px;}
	 p.heading a{color:#F3F3F3;}
	 p.heading a:hover{text-decoration:underline;}
	</style>
	</head>
	<body>
	<div class="content">
			<div class="wrap">
				<div class="content-grid">
			<p><img src="<?php echo get_image('top.png');?>" title=""></p>
				</div>
				<div class="grid">
		<p><img src="<?php echo get_image('coming.png');?>" title=""></p>
		<h3>Online Tes Pertama Di indonesia</h3>
		<p class="heading">
			<?php echo 
			anchor(get_site_url(""),"Home")."
			 | ".
			 anchor("http://blog.onlinetes.com","Blog")." 
			 | ".
			 anchor("http://forum.onlinetes.com","Forum");?></p>
		<form action="" method= "POST">
		  <div style="float:center;">
			<input type="text" size="20" value="Masukkan Nama" onblur="if (this.value=='') this.value = 'Masukkan Nama'" onfocus="this.value = ''" name="user" style="width:150px;-webkit-border-radius: 3px;border-radius: 10px;">
			<input type="text" size="20" value="Masukkan Email" onblur="if (this.value=='') this.value = 'Masukkan Email'" onfocus="this.value = ''" name="email" id="email" style="width:150px;-webkit-border-radius: 3px;border-radius: 10px;">
			<input type="image" src="<?php echo get_site_url('captcha');?>" style="border-radius:10px;">
			<input type="text" size="5" value="captcha" onblur="if (this.value=='') this.value = 'captcha'" onfocus="this.value = ''" name="captcha" id="user" style="width:200px;">
			
			 <a href="<?php echo get_site_url('test');?>">
			 	<button type="submit" class="btn span btn-4 btn-4a icon-arrow-right"><span></span></button>
			 </a>
		  </div>
			<div id="response" style="margin-top:20px;color:red;"><?php if(isset($err))echo $err; ?></div>
				
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
