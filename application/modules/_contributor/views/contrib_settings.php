<table class="table" style="width:70%">
	<?php
	if(isset($error))
	echo "<tr>
	 <th colspan='3'>
		 <div class='alert alert-danger' role='alert'>".$error."</div>
	 </th>
	</tr>";
	
	if(isset($success))
	if(!empty($success))
	echo "<tr>
	 <th colspan='3'>
		 <div class='alert alert-success' role='alert'>".$success."</div>
	 </th>
	</tr>";
	
	?>
	<tr>
	 <th width="200" colspan="3">Change Password :</th>
	</tr>
	<tr>
	 <td>New Password :</td>
	 	<td width="200"><?php echo form_open().input('contrib_pass','','type="password" placeholder="******"'); ?></td>
	 	<td><?php echo submit('submit','Ubah','class="btn btn-primary"').form_close(); ?></td>
	</tr>
</table>
