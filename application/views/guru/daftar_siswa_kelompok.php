<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    DAFTAR SISWA
                </h1>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabel" class="table table-bordered table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user[0] as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $row->nama ?>
                                    </td>
                                    <td>
                                        <?php
                                             $this->db->where('id_tugas',$user[2]);
                                             $this->db->where('id_user',$row->username);
                                             $query = $this->db->get('detail_kelompok');
                                             if (!$query->num_rows() > 0){
                                            
                                             
                                        ?>
                                        <a href="<?= base_url('guru/insertSiswaKelompok/' . $row->username.'/'.$user[1].'/'.$user[2]) ?>" class="btn bg-green waves-effect">Masukkan ke Kelompok</a>
                                        
                                        <?php 
                                        
                                             }else{                                           
                                        ?>
                                                <a href="<?= base_url('guru/deleteSiswaKelompok/' . $row->username.'/'.$user[1].'/'.$user[2]) ?>" class="btn bg-red waves-effect">Sudah Masuk Kelompok</a>
                                        <?php
                                             }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h4 class="modal-title" id="defaultModalLabel">Tambah Daftar Tugas Siswa</h4>
                </div>
                <form role="form" action="<?= base_url('guru/addKelompok/' . $kelompok[1]) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <div class="modal-body">
                        <div class="input">
                            <label for="nama">Nama Kelompok</label>
                            <input class="form-control" name="nama" placeholder="Ketikkan nama tugas disini">
                        </div>
                        <div class="input">
                            <input class="form-control" type="hidden" name="id_tugas" value="<?php $kelompok[1] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="tambah">
                        <button type="submit" class="btn bg-green waves-effect">TAMBAH</button>
                        <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>