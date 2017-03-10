<div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td rowspan="9"> <img src="<?php echo'admin/img/'.$r['foto']; ?>" style="width: 280px; height: 300px"></td>
                        </tr>
                        <tr>
                            <td><strong>ID Pegawai</strong></td>
                            <td><?php echo $r['id_pegawai']; ?></td>
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
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td><?php echo $r['alamat_pegawai']; ?></td>
                        </tr>
                        <!-- <div class="row">
                            <div class="col-md-2"></div> -->
                            <tr>
                                <td></td>
                                <td><strong>Telpon</strong></td>
                                <td><?php echo $r['telpon_pegawai']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><strong>Username</strong></td>
                                <td><?php echo $r['username']; ?></td>
                            </tr>
                        <!-- </div> -->
                    </table>
                  </div> 