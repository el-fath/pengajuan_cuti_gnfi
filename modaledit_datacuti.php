<?php  
	include 'koneksi.php';
	$id_pcuti=$_GET['id_pcuti'];

	$sql = mysqli_query($conn,"SELECT * FROM permohonan_cuti WHERE id_pcuti='$id_pcuti'");
	while ($r=mysqli_fetch_assoc($sql)) {
	
?>
<div class="modal-dialog" style="margin-top: 150px">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myModalLabel">Edit Data Jenis Cuti</h4>
		</div>
		<div class="modal-body">
			<form action="proses/edit_cuti.php" name="modal_popup" enctype="multipart/form-data" method="POST">
				<div class="form-group" style="padding-bottom: 20px;">
				<!-- <label for="id_jabatan">ID JABATAN</label> -->
					<input type="hidden" name="id_pcuti"  class="form-control" value="<?php echo $r['id_pcuti']; ?>" />
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
					<label for="nama cuti">TGL MULAI CUTI</label>
					<input type="date" name="tgl_mulai_cuti" value="<?php echo $r['tgl_mulai_cuti']; ?>" class="form-control">
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
					<label for="nama cuti">TGL AKHIR CUTI</label>
					<input type="date" name="tgl_akhir_cuti" value="<?php echo $r['tgl_akhir_cuti']; ?>" class="form-control">
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit">Confirm</button>
					<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Cancel</button>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</div>
