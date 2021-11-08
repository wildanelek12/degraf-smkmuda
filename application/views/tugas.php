<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    TUGAS
                </h1>
                <?php
                if ($this->session->userdata('role') == 1) {
                ?>
                    <div class="block mb-4 text-left">
                        <a data-toggle="modal" data-target="#add" class="btn bg-green waves-effect">+ Tambah Tugas</a>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabel">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA TUGAS</th>
                                <th>KELOMPOK</th>
                                <th>JANGKA WAKTU</th>
                                <th>FILE TUGAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $now = date('Y-m-d H:i:s');
                            foreach ($tugas as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->nama_tugas ?></td>
                                    <td>
                                        <div class="block mb-4 text-left">
                                        <?php
                                            if ($this->session->userdata('role') == 1) {
                                            ?>
                                              <?php
                                                if ($row->tgl_tutup <= $now) {
                                                ?>
                                                  <a class="btn bg-red waves-effect disable">+ Tambah Kelompok</a>
                                                   
                                                     <?php
                                                } else {
                                                ?>
                                                   <a href="<?= base_url('guru/kelompok/' . $row->id_tugas) ?>" class="btn bg-green waves-effect">+ Tambah Kelompok</a>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }else {
                                            ?>
                                            <?php
                                                $this->db->where('id_user',$this->session->userdata('username'));
                                                $this->db->where('id_tugas',$row->id_tugas);
                                                $query = $this->db->get('detail_kelompok');
                                                if (!$query->num_rows() > 0){
                                                
                                                
                                            ?>
                                                    <a class="btn bg-red waves-effect disable">Belum Dapat</a>
                                                    
                                                    <?php 
                                                    
                                                        }else{                                           
                                                    ?>
                                                           <a href="<?= base_url('siswa/kelompokChat/' . $this->session->userdata('username').'/'.$row->id_tugas) ?>" class="btn bg-green waves-effect">Group Chat</a>
                                                    <?php
                                                        }
                                                    ?>
                                           
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <?php
                                    if ($row->tgl_tutup <= $now) {
                                    ?>
                                        <td><span class="badge bg-red" title="Tugas Ditutup"><?= date('H:i / d M Y', strtotime($row->tgl_buka)) . ' s/d ' . date('H:i / d M Y', strtotime($row->tgl_tutup)) ?></span></td>
                                    <?php
                                    } elseif ($row->tgl_buka <= $now && $row->tgl_tutup >= $now) {
                                    ?>
                                        <td><span class="badge bg-green" title="Tugas Dibuka"><?= date('H:i / d M Y', strtotime($row->tgl_buka)) . ' s/d ' . date('H:i / d M Y', strtotime($row->tgl_tutup)) ?></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td><?= date('H:i / d M Y', strtotime($row->tgl_buka)) . ' s/d ' . date('H:i / d M Y', strtotime($row->tgl_tutup)) ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td>
                                        <?php
                                        if ($row->file_tugas == null) {
                                            echo 'Tidak Tersedia';
                                        } else {
                                        ?>
                                            <a href="<?= base_url('/upload/tugas/') . $row->file_tugas ?>" target="_blank" download class="btn btn-xs btn-primary">Download</a>
                                        <?php
                                        }
                                        echo '</td>';
                                        if ($this->session->userdata('role') == 1) {
                                        ?>
                                    <td>
                                        <a href="<?= base_url('guru/detailKumpul/' . $row->id_tugas) ?>" title="Detail Pengumpulan" class="btn btn-xs bg-green waves-effect"><i class="material-icons">remove_red_eye</i></a>
                                        <button type="button" title="Edit" data-toggle="modal" data-target="#edit" class="btn btn-xs btn-primary waves-effect" onclick="edit(this)" data-id_tugas="<?= $row->id_tugas ?>" data-nama_tugas="<?= $row->nama_tugas ?>" data-file_tugas="<?= $row->file_tugas ?>" data-isi="<?= $row->isi_tugas ?>" data-tgl_buka="<?= $row->tgl_buka ?>" data-tgl_tutup="<?= $row->tgl_tutup ?>"><i class="material-icons">edit</i></button>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger waves-effect" onclick="hapus(this)" data-id_tugas="<?= $row->id_tugas ?>"><i class="material-icons">delete</i></button>
                                    </td>
                                <?php
                                        } elseif ($this->session->userdata('role') == 2) {

                                ?>
                                    <td>
                                        <?php
                                            $user = $this->session->userdata('username');
                                            $cek = $this->model_materi->cekKumpul($row->id_tugas, $user);
                                            if ($cek < 1) {
                                        ?>
                                            <button data-toggle="modal" data-target="#kumpul" class="btn btn-xs bg-green waves-effect" onclick="kumpul(this)" data-id_tugas="<?= $row->id_tugas ?>">Kumpulkan</button>
                                        <?php
                                            } else {
                                        ?>
                                            <span class="badge bg-grey" title="Sudah Mengumpulkan">Selesai</span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                <?php
                                        }
                                ?>
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
    </div>
    <!-- #END# Basic Examples -->
</div>

<div class="modal fade" id="kumpul" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Kumpulkan Daftar Tugas</h4>
            </div>
            <form role="form" action="<?= base_url('siswa/addTugas') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="isi">Isi Jawaban</label>
                        <input class="form-control" name="isi" rows="10" placeholder="Ketikkan jawaban disini jika diperlukan">
                    </div>
                    <label for="exampleInputFile">File Jawaban</label>
                    <div class="input">
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                            <!-- <label class="custom-file-label" for="exampleInputFile">Pilih File</label> -->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_tugas" id="id_tugas_kumpul">
                    <input type="hidden" name="tambah">
                    <button type="submit" class="btn bg-green waves-effect">KUMPULKAN</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Daftar Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/addTugas') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="nama">Nama Tugas</label>
                        <input class="form-control" name="nama" placeholder="Ketikkan nama tugas disini">
                    </div>

                    <div class="input">
                        <label for="isi">Isi Tugas</label>
                        <input class="form-control" name="isi" id="isi_edit" rows="10" placeholder="Ketikkan isi tugas disini jika diperlukan">
                    </div>
                    <label for="exampleInputFile">File Tugas</label>
                    <div class="input">
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                            <!-- <label class="custom-file-label" for="exampleInputFile">Pilih File</label> -->
                        </div>
                    </div>
                    <label for="tglbuka">Tanggal dibuka</label>
                    <div class="input">
                        <input type="datetime-local" name="tglbuka" class="form-control">
                    </div>
                    <label for="tgltutup">Tanggal ditutup</label>
                    <div class="input">
                        <input type="datetime-local" name="tgltutup" class="form-control">
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Edit Daftar Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/addTugas') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="nama">Nama Tugas</label>
                        <input class="form-control" name="nama" id="nama_edit" placeholder="Ketikkan nama tugas disini">
                    </div>

                    <div class="input">
                        <label for="isi">Isi Tugas</label>
                        <input class="form-control" name="isi" id="isi_edit" rows="10" placeholder="Ketikkan isi tugas disini jika diperlukan">
                    </div>
                    <label for="exampleInputFile">File Tugas</label>
                    <div class="input">
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                            <!-- <label class="custom-file-label" for="exampleInputFile">Pilih File</label> -->
                        </div>
                    </div>
                    <label for="tglbuka">Tanggal dibuka</label>
                    <div class="input">
                        <input type="text" id="tgl_buka" name="tglbuka" class="form-control">
                    </div>
                    <label for="tgltutup">Tanggal ditutup</label>
                    <div class="input">
                        <input type="text" id="tgl_tutup" name="tgltutup" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_tugas" id="id_tugas_edit">
                    <input type="hidden" name="berkas_ada" id="berkas">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn bg-blue waves-effect">EDIT</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Hapus Daftar Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/addTugas') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                </div>
                <div class="modal-body text-center">
                    <strong>
                        <h4>Apakah Anda Yakin Ingin Menghapus Daftar Tugas ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_tugas" id="id_tugas_hapus">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn bg-red waves-effect">HAPUS</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function kumpul(identifier) {
        var b = $(identifier);
        var id_tugas = b.data('id_tugas');

        $('#id_tugas_kumpul').val(id_tugas);
    }

    function edit(identifier) {
        var b = $(identifier);
        var id_tugas = b.data('id_tugas');
        var nama = b.data('nama_tugas');
        var isi = b.data('isi');
        var file_tugas = b.data('file_tugas');
        var tglbuka = b.data('tgl_buka');
        var tgltutup = b.data('tgl_tutup');

        $('#id_tugas_edit').val(id_tugas);
        $('#nama_edit').val(nama);
        $('#isi_edit').val(isi);
        $('#berkas').val(file_tugas);
        $('#tgl_buka').val(tglbuka);
        $('#tgl_tutup').val(tgltutup);
    }

    function hapus(identifier) {
        var b = $(identifier);
        var id_tugas = b.data('id_tugas');

        $('#id_tugas_hapus').val(id_tugas);
    }
</script>