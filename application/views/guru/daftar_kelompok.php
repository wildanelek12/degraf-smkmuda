<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    DAFTAR KELOMPOK
                    <a data-toggle="modal" data-target="#add" class="btn bg-green waves-effect">+Tambah Data Kelompok</a>
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
                            foreach ($kelompok[0] as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?= $row->nama_kelompok ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('guru/showSiswaKelompok/' . $row->id_kelompok.'/'.$kelompok[1]) ?>" class="btn bg-green waves-effect">Tambah Anggota Kelompok</a>
                                        <a href="<?= base_url('guru/showChat/' . $row->id_kelompok) ?>" class="btn bg-green waves-effect">Lihat Chat</a>
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