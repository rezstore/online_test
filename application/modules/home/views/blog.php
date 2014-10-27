
    <!-- start content -->
	 <div class="main1">
	 	 <div class="content">
	 	 	<h2>INDOTES BLOG</h2><i class="text-italic">Hargai Ilmu Walau Hanya Satu Kata<i>
	 	 </div>
		<div class="blog">
		<?php
		foreach($datas->result() as $r){
			$title=$r->blog_title;
			$image=$r->blog_image;
			$content=$r->blog_content;
			$url=$r->blog_url;
			$date = date_create($r->post_date);
     			$post_date=date_format($date,'d M Y');
		?>
			<div class="blog_list">
				<h4><a href=""><?php echo $title; ?></a></h4>
				<h5><?php echo $post_date; ?></h5>
				<div class="blog_para">
					<p class="para1" style="text-align:justify">
					 <a href="<?php echo get_site_url();?>" rel="lightbox">
					  <img class="img img-thumbnail" style="width:200px;" src="<?php echo get_image('pic9.jpg');?>" alt="<?php echo $title; ?>">
					 </a>
					 <?php
					  echo $content.'...';
					 ?>
					</p>
					<hr>
					<div class="read_more">
						<a class="btn btn-primary" href="<?php echo get_site_url();?>">Read More</a>
					</div>
					<div class="clear"></div>
				</div>
			 </div>
		<?php
		}
		?>
		</div>
 	 </div>
</div>
</div>
