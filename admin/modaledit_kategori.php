<?php
    include "koneksi.php";
  $id_kategori=$_GET['id_kategori'];
  
  $modal=mysqli_query($conn,"SELECT * FROM kategori_barang WHERE id_kategori='$id_kategori'");
  while($r=mysqli_fetch_array($modal)){
?>

<div class="modal-dialog" style="margin-top: 150px">
    <div class="modal-content">

      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Kategori</h4>
        </div>

        <div class="modal-body">
          <form action="proses/edit_kategori.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <!-- <label for="id_kategori">ID KATEGORI</label> -->
                    <input type="hidden" name="id_kategori"  class="form-control" value="<?php echo $r['id_kategori']; ?>" />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="kategori">KATEGORI</label>
                  <input type="text" name="kategori" value="<?php echo $r['kategori']; ?>" class="form-control">
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