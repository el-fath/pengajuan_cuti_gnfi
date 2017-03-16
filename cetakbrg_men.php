<script>
  function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
  </script>
<?php
$id_pbarang=$_GET['id_pbarang'];
$sql = "SELECT pengadaan_barang.id_pbarang,pengadaan_barang.note,pengadaan_barang.note2,pengadaan_barang.disahkan,pengadaan_barang.status, pegawai.nama_pegawai, pegawai.foto ,jabatan.jabatan, pengadaan_barang.tgl_pengajuan, pengadaan_barang.alasan ,pengadaan_barang.status,pengadaan_barang.nama_barang,pengadaan_barang.berkas, pengadaan_barang.tgl_sah
        FROM pegawai, pengadaan_barang, jabatan
        WHERE pegawai.id_pegawai = pengadaan_barang.id_pegawai
        AND pegawai.id_jabatan= jabatan.id_jabatan
        AND pengadaan_barang.id_pbarang = '$id_pbarang'";
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
$temp=mysqli_fetch_array($s);
$tgl_sah = $temp['tgl_sah'];
?>
<div class="table-responsive">
  <div id="p1">
      <div class="modal-dialog" style="width: 700px;">
          <div class="modal-content">
              <div class="modal-header">
                  <img src="assets/img/logo.png" style="width: 100px; height: 100px; " align="right">
                  <label class="modal-title" id="myModalLabel" style="padding-left: 110px; font-size: 24px"><strong>Form Pengajuan Barang Dan Anggaran</strong></label>
                  <h3 class="modal-title" id="myModalLabel" style="padding-left: 250px"><strong>Karyawan GNFI</strong></h3>
              </div>
              <div class="modal-body">
                <p style="padding-left: 70px">Dengan Hormat,</p>
                <p style="padding-left: 70px">Yang bertanda tangan di bawah ini,</p>
                 <table align="center">
                     <tr>
                         <td ><strong>Nama</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>
                         <td style="padding-left: 30px"><?php echo $temp['nama_pegawai']; ?></td>
                     </tr>
                     <tr>
                         <td><strong> Divisi</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>
                         <td style="padding-left: 30px"><?php echo $temp['jabatan']; ?></td>
                     </tr>
                     <tr>
                       <td><strong>Tanggal Pengajuan</strong></td>
                       <td style="padding-left: 30px"><strong>:</strong></td>
                       <td style="padding-left: 30px"><?php echo date("d-m-Y", strtotime($temp['tgl_pengajuan'])); ?></td>
                     </tr>
                     <tr>
                         <td><strong>Nama Barang</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>                                               
                         <td style="padding-left: 30px"><?php echo $temp['nama_barang']; ?></td>
                     </tr>
                     <tr>
                         <td><strong>Perincian Dalam File</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>                                               
                         <td style="padding-left: 30px"><?php echo $temp['berkas']; ?></td>
                     </tr>
                     <tr>
                         <td><strong>Keperluan</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>                                               
                         <td style="padding-left: 30px"><?php echo $temp['alasan']; ?></td>
                     </tr>
                     <tr>
                         <td><strong>Status</strong></td>
                         <td style="padding-left: 30px"><strong>:</strong></td>                                               
                         <td style="padding-left: 30px"><?php echo $temp['status']; ?></td>
                     </tr>
                 </table>
                 <br>
                  <p style="padding-left: 70px">Demikian surat pengajuan ini dibuat dan kami ucapkan terimakasih.</p>
                  <p style="padding-left: 70px"><strong>Surabaya, <?php echo date("d F Y", strtotime($tgl_sah)); ?></strong></p>
                  <table>
                  <tr>
                    <td style="padding-left: 90px"><strong>Yang Mengajukan Cuti</strong></td>
                    <td style="padding-left: 200px"><strong>Yang Menyetujui Cuti</strong></td>
                  </tr>
                  <tr>
                  </tr>
                  </table>
                  <table>
                  <br>
                  <br>
                  <br>
                  <br>
                    <tr>
                      <td style="padding-left: 90px"><strong><?php echo $temp['nama_pegawai']; ?></strong></td>
                      <td style="padding-left: 230px"><strong><?php echo $temp['disahkan']; ?></strong></td>
                    </tr>
                  </table>
                  <br>
                 </div>
              </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                <?php 
                $id_pegawai=$_SESSION['id_pegawai'];
                $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
                $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
                while ($t = mysqli_fetch_assoc($a)) {
                    if ($t['is_coordinator'] == '2') {
                ?>
                  <a href="approvel.php"><button type="button" class="btn btn-default">Kembali</button></a>
                  <button type="button" data-toggle="modal" data-target=".komen" class="btn btn-success">Approvel Note</button>
                  <button type="button" onclick="printContent('p1')" class="btn btn-primary">Print</button>
                  <button type="button" data-toggle="modal" data-target=".send" class="btn btn-success"> <i class="glyphicon glyphicon-envelope"></i> Kirim Ke Keuangan</button>
                <?php }else{ ?>
                  <a href="index.php"><button type="button" class="btn btn-default">Kembali</button></a>
                  <button type="button" data-toggle="modal" data-target=".komen" class="btn btn-success">Approvel Note</button>
                  <button type="button" onclick="printContent('p1')" class="btn btn-primary">Print</button>
                <?php }} ?>
              </div>
  <div class="modal fade komen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="padding-top: 130px;">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Note From Approvel</h3>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class="table-responsive">
            <table>
              <tr>
                <td>Approvel 1 Note :</td>
              </tr>
              <tr>
                <td><?php echo $temp['note']; ?></td>
              </tr>
              <tr>
                <td>Approvel 2 Note :</td>
              </tr>
              <tr>
                <td><?php echo $temp['note2']; ?></td>                
              </tr>
            </table>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            <!--Footer-->
        </div>
        <!--/.Content-->
    </div>
  </div>
  <div class="modal fade send" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="padding-top: 130px;">
        <!--Content-->
        <div class="modal-content">
            <!--Body-->
            <div class="modal-body">
            <form action="proses/kimel.php" method="POST" enctype="multipart/form-data">
              <h3><center>Apa Anda Yakin untuk mengirim Ke Keuangan</center></h3>
              <input type="hidden" name="id_pbarang" value="<?php echo $temp['id_pbarang']; ?>">
              </div>
              <div class="modal-footer" style="text-align:center;">
                <button type="submit" class="btn btn-success">Yakin</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
            </form>
            <!--Footer-->
        </div>
        <!--/.Content-->
    </div>
  </div>
  <script>
  function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
  </script>
                          