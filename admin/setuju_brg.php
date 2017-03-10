<?php
    include "koneksi.php";
  $id_pbarang=$_GET['id_pbarang'];
  $modal=mysqli_query($conn,"SELECT * FROM pengadaan_barang WHERE id_pbarang='$id_pbarang'");
  while($r=mysqli_fetch_array($modal)){
?>

<div class="modal-dialog" style="margin-top: 80px">
    <div class="modal-content">
        <div class="modal-body">
          	<form role="form" action="admin/proses_setuju_brg.php" enctype="multipart/form-data" method="POST">
                <div class="form-group" style="padding-bottom: 20px;">
                  	<h1 class="modal-title" id="myModalLabel">Apa Anda yakin Untuk Menyetujui </h1>
                  	<input type="hidden" name="id_pbarang"  class="form-control" value="<?php echo $r['id_pbarang']; ?>" />
                </div>
                <div class="form-group">
                  <label>Alasan Anda Kenapa Menyetujui Pengajuan Ini ??</label>
                  <textarea name="note" class="form-control" placeholder="Alasan Anda Kenapa Menyetujui Pengajuan Ini ??"><?php echo $r['note']; ?></textarea>
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