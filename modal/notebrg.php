<?php
    include "../koneksi.php";
  $id_pbarang=$_GET['id_pbarang'];
  $modal=mysqli_query($conn,"SELECT * FROM pengadaan_barang INNER JOIN pegawai ON pegawai.id_pegawai=pengadaan_barang.id_pegawai WHERE id_pbarang='$id_pbarang'");
  while($r=mysqli_fetch_array($modal)){
?>
<div class="modal-dialog">
    <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Approvel Note</h4>
            </div>
        <div class="modal-body">
          	<form role="form" action="proses/notebrg.php" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <input type="hidden" name="id_pbarang"  class="form-control" value="<?php echo $r['id_pbarang']; ?>" />
                  <textarea name="note" value="<?php echo $r['note']; ?>" class="form-control" placeholder="write you note here"></textarea>
                </div>
              	<div class="modal-footer">
                  <input class="btn btn-success" value="Send" type="submit" />
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              	</div>
			      </form>
        </div>
    </div>
</div>
<?php } ?>