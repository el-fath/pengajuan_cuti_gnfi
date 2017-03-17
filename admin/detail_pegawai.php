<?php
    include "koneksi.php";
  $id_pegawai=$_GET['id_pegawai'];
  
  $modal=mysqli_query($conn,"SELECT * FROM pegawai 
                            INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan
                            INNER JOIN pegawai_group ON pegawai_group.id_pegawai = pegawai.id_pegawai
                            WHERE pegawai.id_pegawai='$id_pegawai' ");
  while($r=mysqli_fetch_array($modal)){
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Detail Pegawai</h4>
        </div>

        <div class="modal-body">
           <form action="#" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                            <td align="center" rowspan="10"><img src="<?php echo'img/'.$r['foto']; ?>" style="width: 280px; height: 300px"></td>
                        </tr>
                        <tr>
                            <td><strong>IS Coordinator</strong></td>
                            <td><?php $r['is_coordinator']; ?>
                              <?php if ($r['is_coordinator'] == 1 ){ ?>
                                <?php echo 'Yes' ?>
                              <?php }elseif($r['is_coordinator'] == 2){ ?>
                                <?php echo 'Super Admin' ?>
                              <?php }else{ ?>
                                <?php echo 'No' ?>
                              <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Nama Pegawai</strong></td>
                            <td><?php echo $r['nama_pegawai']; ?></td>
                        </tr>
                        <tr> 
                            <td><strong>Jabatan</strong></td>
                            <td><?php echo $r['jabatan']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td><?php echo $r['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tgl Lahir</strong></td>
                            <td><?php echo $r['tgl_lahir']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tgl bergabung</strong></td>
                            <td><?php echo $r['tgl_bergabung'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?php echo $r['email']; ?></td>
                        </tr
                        <tr>
                            <td><strong>Telpon</strong></td>
                            <td><?php echo $r['telpon_pegawai']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><?php echo $r['username']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td colspan="2"><?php echo $r['alamat_pegawai']; ?></td>
                        </tr>
                        <!-- </div> -->
                    </table>
                  </div>               
              </div>
              <div class="modal-footer">
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Close</button>
              </div>
          </form>
             <?php } ?>
        </div>           
    </div>
</div>