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
			        dengan jumlah soal <i class='lead'>\" ".$datas." Butir \"</i>  Soal Pilihan Ganda. <p>
			        Setiap halaman terdiri atas 5 soal dan anda harus memilih salah satu pilihan jawaban yang <i class='lead'>\" Paling Benar \"</i> 
			        dan nilai akan kami tampilkan jika semua soal sudah terjawab.
			       </p> ";
			      ?>
			      <hr>
			      </td>
			      </tr><tr>
			      <td style="text-align:right">
			      <?php
			       echo anchor(get_site_url(''),'<button type="button" class="btn btn-danger">Tolak</button>').nbs();
			       echo anchor(get_site_url('start'),'<button type="button" class="btn btn-primary">Lanjut</button>');
			      ?>
			      </td>
		      </tr>
	      </table>
    </div>
 
</div>
</div>
<!-- -->