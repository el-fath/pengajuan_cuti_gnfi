<?php
    include "../koneksi.php";
  $id_pcuti=$_GET['id_pcuti'];
  $modal=mysqli_query($conn,"SELECT * FROM permohonan_cuti INNER JOIN pegawai ON pegawai.id_pegawai=permohonan_cuti.id_pegawai WHERE id_pcuti='$id_pcuti'");
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
          	<form role="form" action="proses/note2.php" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                  <input type="hidden" name="id_pcuti" class="form-control" value="<?php echo $r['id_pcuti']; ?>" />
                  <textarea name="note2" class="form-control" placeholder="Note Super Admin" value="<?php echo $r['note2']; ?>"></textarea>
                </div>
              	<div class="modal-footer">
                  <input class="btn btn-success" value="Send" type="submit"/>
                  <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              	</div>
			      </form>
        </div>
    </div>
</div>
<?php } ?>