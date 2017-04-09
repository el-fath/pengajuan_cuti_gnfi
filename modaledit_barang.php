<?php  
	include 'koneksi.php';
	$id_pbarang=$_GET['id_pbarang'];

	$sql = mysqli_query($conn,"SELECT * FROM pengadaan_barang WHERE id_pbarang='$id_pbarang'");
	$r=mysqli_fetch_assoc($sql) 	
?>
<div class="modal-dialog" style="margin-top: 150px">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myModalLabel">Edit Data Jenis Cuti</h4>
		</div>
		<div class="modal-body">
			<form action="proses/edit_barang.php" name="modal_popup" enctype="multipart/form-data" method="POST">
				<div class="form-group" style="padding-bottom: 20px;">
				<!-- <label for="id_jabatan">ID JABATAN</label> -->
					<input type="hidden" name="id_pbarang"  class="form-control" value="<?php echo $r['id_pbarang']; ?>" />
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
					<label for="nama cuti">BERKAS</label>
					<input type="file" name="berkas" value="<?php echo $r['berkas']; ?>" class="form-control">
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit" name="btnUpload">Confirm</button>
					<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

