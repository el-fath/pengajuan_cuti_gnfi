<?php
    include "koneksi.php";
  $id_pcuti=$_GET['id_pcuti'];
  $modal=mysqli_query($conn,"SELECT * FROM permohonan_cuti WHERE id_pcuti='$id_pcuti'");
  while($r=mysqli_fetch_array($modal)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
          	<form role="form" action="admin/proses_tolak_jon.php" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                  	<h1 class="modal-title" id="myModalLabel">Apa Anda yakin Untuk Menolak....!</h1>
                  	<input type="hidden" name="id_pcuti"  class="form-control" value="<?php echo $r['id_pcuti']; ?>" />
                </div>
                <div class="form-group">
                  <label>Alasan Anda Kenapa Menolak Pengajuan Ini ??</label>
                  <textarea name="note" class="form-control" placeholder="Alasan Anda Kenapa Menolak Pengajuan Ini ??"><?php echo $r['note']; ?></textarea>
                </div>
              	<div class="modal-footer">
                  <input class="btn btn-success" value="yakin" type="submit" />
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              	</div>
			</form>
        </div>
    </div>
</div>
<?php } ?>