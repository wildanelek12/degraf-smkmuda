<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    QUIZ
                </h1>
                <?php
                if ($this->session->userdata('role') == 1) {
                ?>
                    <div class="block mb-4 text-left">
                        <button type="button" data-toggle="modal" data-target="#kuis" class="btn bg-green waves-effect">+ Tambah Quiz</button>
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
                            <th>QUIZ</th>
                            <th>JANGKA WAKTU</th>
                            <th>WAKTU PENGERJAAN</th>
                            <?php
                            if ($this->session->userdata('role') == 1) {
                            ?>
                                <th>JENIS SOAL</th>
                            <?php
                            }
                            ?>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kuis as $row) :
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row->nama_kuis ?></td>
                                <td><?= date('H:i / d M Y', strtotime($row->tgl_buka)) . ' s/d ' . date('H:i / d M Y', strtotime($row->tgl_tutup)) ?></td>
                                <td><?= $row->waktu . ' menit' ?></td>
                                <?php
                                if ($this->session->userdata('role') == 1) {
                                ?>
                                    <td><?= $row->jenis ?></td>
                                    <td>
                                        <a href="<?= base_url('guru/soal/' . $row->id_kuis) ?>" type="button" title="Lihat Soal" class="btn btn-xs waves-effect"><i class="material-icons">assignment</i></a>
                                        <a href="<?= base_url('guru/nilaiKuis/' . $row->id_kuis) ?>" type="button" title="Hasil Kuis" class="btn btn-xs bg-green waves-effect"><i class="material-icons">remove_red_eye</i></a>
                                        <button type="button" title="Edit" data-toggle="modal" data-target="#edit" class="btn btn-xs btn-primary waves-effect" onclick="edit(this)" data-id_kuis="<?= $row->id_kuis ?>" data-nama="<?= $row->nama_kuis ?>" data-tgl_buka="<?= $row->tgl_buka ?>" data-tgl_tutup="<?= $row->tgl_tutup ?>" data-waktu="<?= $row->waktu ?>" data-jenis="<?= $row->jenis ?>"><i class="material-icons">edit</i></button>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger waves-effect" onclick="hapus(this)" data-id_kuis="<?= $row->id_kuis ?>" data-nama="<?= $row->nama_kuis ?>"><i class="material-icons">delete</i></button>
                                    </td>
                                    <?php
                                } elseif ($this->session->userdata('role') == 2) {
                                    $data = [
                                        'id_kuis' => $row->id_kuis,
                                        'username' => $this->session->userdata('username')
                                    ];
                                    $cek = $this->model_kuis->sudahIkut($data);
                                    if ($cek < 1) {
                                    ?>
                                        <td>
                                            <a href="<?= base_url('siswa/mulaiKuis/' . $row->id_kuis) ?>" type="button" title="Ikuti Quiz" class="btn btn-xs btn-success waves-effect">Mulai Quiz</a>
                                        </td>
                                    <?php
                                    } elseif ($cek > 0) {
                                    ?>
                                        <td>
                                            Selesai
                                        </td>
                                <?php
                                    } else {
                                        var_dump($cek);
                                        die();
                                    }
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

<div class="modal fade" id="kuis" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Daftar Quiz</h4>
            </div>
            <form action="<?= base_url('guru/addKuis') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="nama">Nama Quiz</label>
                        <input type="text" name="nama" class="form-control" placeholder="Ketikkan nama quiz disini">
                    </div>
                    <div class="input">
                        <label for="tglbuka">Tanggal dibuka</label>
                        <input type="datetime-local" name="tglbuka" class="form-control">
                    </div>
                    <div class="input">
                        <label for="tgltutup">Tanggal ditutup</label>
                        <input type="datetime-local" name="tgltutup" class="form-control">
                    </div>
                    <div class="input">
                        <label for="waktu">Waktu pengerjaan</label><small class="text-danger"> (dalam menit)</small>
                        <input type="number" name="waktu" class="form-control">
                    </div>
                    <div class="input">
                        <label for="jenis">Jenis Soal</label>
                        <select name="jenis" class="form-control show-tick">
                            <option value="">Pilih</option>
                            <option value="Urut">Urut</option>
                            <option value="Acak">Acak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tambah">
                    <button type="submit" class="btn bg-green waves-effect" title="simpan">TAMBAH</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-blue">
                <h4 class="modal-title" id="defaultModalLabel">Konfirmasi Edit Daftar Quiz</h4>
            </div>
            <form action="<?= base_url('guru/addKuis') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="nama">Nama Quiz</label>
                        <input type="text" name="nama" id="nama_edit" class="form-control" placeholder="Ketikkan nama quiz disini">
                    </div>
                    <div class="input">
                        <label for="tglbuka">Tanggal dibuka</label>
                        <input type="text" id="tgl_buka" name="tglbuka" class="form-control">
                    </div>
                    <div class="input">
                        <label for="tgltutup">Tanggal ditutup</label>
                        <input type="text" id="tgl_tutup" name="tgltutup" class="form-control">
                    </div>
                    <div class="input">
                        <label for="waktu">Waktu pengerjaan</label><small class="text-danger"> (dalam menit)</small>
                        <input type="number" name="waktu" id="waktu" class="form-control">
                    </div>
                    <div class="input">
                        <label for="jenis">Jenis Soal</label>
                        <select name="jenis" id="jenis" class="form-control show-tick">
                            <option value="">Pilih</option>
                            <option value="Urut">Urut</option>
                            <option value="Acak">Acak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kuis" id="id_kuis_edit">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn bg-green waves-effect" title="simpan">EDIT</button>
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
                <h4 class="modal-title" id="defaultModalLabel">Konfirmasi Hapus Daftar Quiz</h4>
            </div>
            <form action="<?= base_url('guru/addKuis') ?>" method="post" enctype="multipart/form-data" class="form-submit">

                <div class="modal-body text-center">
                    <div class="nama_hapus"></div>
                    <strong>
                        <h4>

                            Apakah Daftar Quiz Tersebut Yakin Anda Hapus ?
                        </h4>
                    </strong>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kuis" id="id_kuis_hapus">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn bg-red waves-effect">HAPUS</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function edit(identifier) {
        var button = $(identifier);
        var id_kuis = button.data('id_kuis');
        var nama = button.data('nama');
        var tgl_buka = button.data('tgl_buka');
        var tgl_tutup = button.data('tgl_tutup');
        var waktu = button.data('waktu');
        var jenis = button.data('jenis');

        $('#id_kuis_edit').val(id_kuis);
        $('#nama_edit').val(nama);
        $('#tgl_buka').val(tgl_buka);
        $('#tgl_tutup').val(tgl_tutup);
        $('#waktu').val(waktu);
        $('#jenis').val(jenis);
    }

    function hapus(identifier) {
        var button = $(identifier);
        var id_kuis = button.data('id_kuis');
        var nama = button.data('nama');

        $('#id_kuis_hapus').val(id_kuis);
        $('.nama_hapus').html(nama);
    }
</script>