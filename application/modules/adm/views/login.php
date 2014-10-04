
<html>
    <head>
        <title>/_\</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css');?>" />
    </head>
    <body>
    <?php
     if(isset($error)){
       $user_log=$user;
       $error_message=$error;
       $bg="#D3D3D3";
     }else{
       $user_log="";
       $error_message="";
       $bg="transparent";
     }
    ?>
	<div class="wrapper">
	  <div class="content">
	   <div class='error' style="background:<?php echo $bg; ?>;"><?php echo $error_message; ?></div>
		<div id="form_wrapper" class="form_wrapper">
		  <form class="login active" action="<?php echo get_site_url('check_login'); ?>" method="POST">
			<h3>Login</h3>
			<div>
				<label>Username:</label>
				<input type="text" name='user_admin' autocomplete="off" value="<?php echo $user_log; ?>" />
			</div>
			<div>
				<label>Password: <a href="#" rel="forgot_password" class="forgot linkform">Lupa password?</a></label>
				<input type="password" name='pass_admin' autocomplete="off" />
			</div>
			<div>
				<label>Captcha:</label>
				<img src="<?php echo site_url('adm/captcha'); ?>"  style="margin-left:30px;">
				<input type="text" name="captcha" autocomplete="off" placeholder="Masukkan Captcha"/>
			</div>
<br>
			<div class="bottom">
				<input type="submit" value="Login"></input>
				<div class="clear"></div>
			</div>
		  </form>
		</div>
	   </div>
	</div>
    </body>
</html>
