<?php
    include "koneksi.php";
  $id_jabatan=$_GET['id_jabatan'];
  
  $modal=mysqli_query($conn,"SELECT * FROM jabatan WHERE id_jabatan='$id_jabatan'");
  while($r=mysqli_fetch_array($modal)){
?>

<div class="modal-dialog" style="margin-top: 150px">
    <div class="modal-content">

      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data jabatan</h4>
        </div>

        <div class="modal-body">
          <form action="proses/edit_jabatan.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <!-- <label for="id_jabatan">ID JABATAN</label> -->
                    <input type="hidden" name="id_jabatan"  class="form-control" value="<?php echo $r['id_jabatan']; ?>" />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="jabatan">JABATAN</label>
                  <input type="text" name="jabatan" value="<?php echo $r['jabatan']; ?>" class="form-control">
                </div>

                
              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      Confirm
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              </div>

              </form>

             <?php } ?>

            </div>

           
        </div>
    </div>