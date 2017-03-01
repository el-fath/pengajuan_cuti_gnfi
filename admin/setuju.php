<?php
    include "koneksi.php";
  $id_pcuti=$_GET['id_pcuti'];
  $modal=mysqli_query($conn,"SELECT * FROM permohonan_cuti INNER JOIN pegawai ON pegawai.id_pegawai=permohonan_cuti.id_pegawai WHERE id_pcuti='$id_pcuti'");
  while($r=mysqli_fetch_array($modal)){
?>
<div class="modal-dialog" style="margin-top: 150px">
    <div class="modal-content">
        <div class="modal-body">
          	<form role="form" action="admin/proses_jon.php" enctype="multipart/form-data" method="POST">
                <?php if ($r['jatah_cuti'] != '0'){ ?>
                <div class="form-group" style="padding-bottom: 20px;">
                  	<h1 class="modal-title" id="myModalLabel">Apa Anda yakin Untuk Menyetujui....!</h1>
                  	<input type="hidden" name="id_pcuti"  class="form-control" value="<?php echo $r['id_pcuti']; ?>" />
                    <input type="hidden" name="id_jcuti"  class="form-control" value="<?php echo $r['id_jcuti']; ?>" />
                </div>
              	<div class="modal-footer">
                  <input class="btn btn-success" value="yakin" type="submit" />
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              	</div>
                <?php }else{ ?>
                <div class="form-group" style="padding-bottom: 20px;">
                    <h1 class="modal-title" id="myModalLabel">Mohon Maaf Jatah Cuti <?php echo $r['nama_pegawai']; ?> Habis.........!</h1>
                </div>
                <?php } ?>
			      </form>
        </div>
    </div>
</div>
<?php } ?>