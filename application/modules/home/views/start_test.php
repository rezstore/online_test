<?php
$subject=$this->m_oltest->select_subject_name($c->get_session('subject'));
$class=strtoupper($c->get_session('class'));
?>
    <div class="banner">
      <table style="width:100%;text-align:justify;">
       <tr>
	      <td>
	      <?php
	       echo "Halo ".$c->get_username()."!!!
	       <p>
	        Anda Memutuskan Untuk mencoba mengerjakan soal \" ".$subject." \" Kelas \"".$class."\"
	        dengan jumlah soal <i class='lead'>\" ".$datas." Butir \"</i>  Soal Pilihan Ganda. 
	        <p>Kami berikan waktu 60 menit untuk menjawab semua pertanyaan yang disediakan.
	        Setiap halaman terdiri atas 5 soal dan anda harus memilih salah satu pilihan jawaban yang 
	        <i class='lead'>\" Paling Benar \"</i> 
	        dan nilai akan kami tampilkan jika semua soal sudah terjawab.
	       </p> ";
	      ?>
	      <hr>
	      <span id="loader"></span>
	      </td>
	      </tr><tr>
	      <td style="text-align:right">
	      <?php
	       echo anchor(get_site_url(''),'<button type="button" class="btn btn-danger">Tolak</button>').nbs();
	       echo '<button type="button" class="btn btn-primary" onclick="set_time();">Lanjut</button>';
	      ?>
	      </td>
       </tr>
      </table>
    </div>
 <script src="<?php echo get_js_family('jquery.min.js'); ?>"></script>
 <script>
 	function set_time(){
 		$("#loader").load("<?php echo get_site_url('set_time'); ?>");
 		window.open("<?php echo get_site_url('set_time'); ?>", "", "width=400, height=100");
 		var url="<?php echo get_site_url('start');?>";
 		setTimeout(function(){window.location=url;},5000);
 	}
 </script>
</div>
</div>
<!-- -->
