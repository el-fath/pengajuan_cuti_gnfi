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
$sql = "SELECT pengadaan_barang.id_pbarang, pegawai.nama_pegawai, pegawai.foto ,jabatan.jabatan, pengadaan_barang.tgl_pengajuan, pengadaan_barang.alasan ,pengadaan_barang.status,pengadaan_barang.nama_barang,pengadaan_barang.berkas, pengadaan_barang.tgl_sah
        FROM pegawai, pengadaan_barang, jabatan
        WHERE pegawai.id_pegawai = pengadaan_barang.id_pegawai
        AND pegawai.id_jabatan= jabatan.id_jabatan
        AND pengadaan_barang.id_pbarang = '$id_pbarang'";
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
$temp=mysqli_fetch_array($s);
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
                      <td style="padding-left: 284px"><strong><?php echo $temp['disahkan']; ?></strong></td>
                    </tr>
                  </table>
                  <br>
                 </div>
              </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                  <a href="index.php"><button type="button" class="btn btn-default">Kembali</button></a>
                 <button type="button" onclick="printContent('p1')" class="btn btn-primary">Print</button>
              
          
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
                          