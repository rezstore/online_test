
    <!-- start content -->
	 <div class="main1">
	 	 <div class="content">
	 	 	<h2>INDOTES BLOG</h2><i>Hargai Ilmu Walau Hanya Satu Kata<i>
	 	 </div>
		<div class="blog">
		<?php
		foreach($datas->result() as $r){
			$title=$r->blog_title;
			$image=$r->image;
			$content=$r->blog_content;
			$url=$r->blog_url;
		?>
			<div class="blog_list">
				<h4><a href="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a></h4>
				<h5>January 3rd, 2013 , Posted by&nbsp;<a href="<? php echo get_site_url('index');?>">H. Rackham</a></h5>
				<div class="blog_para">
					<p class="para1"><a href="<?php echo get_site_url();?>" rel="lightbox"><img src="<?php echo get_image('pic9.jpg');?>"" alt=""></a>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will,</p>
					<div class="read_more">
						<a class="btn" href="<?php echo get_site_url();?>">Read More</a>
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