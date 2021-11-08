<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    DAFTAR PENGUMPUL TUGAS
                </h1>
            </div>

            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabel">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>DIKUMPULKAN PADA</th>
                                <th>JAWABAN</th>
                                <th>NILAI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tugas as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->siswa ?></td>
                                    <td><?= date('H:i / d M Y', strtotime($row->tgl_kumpul)) ?></td>
                                    <td>
                                        <?php
                                        if ($row->file_kumpul != null) {
                                            if ($row->isi_kumpul != null) {
                                                echo $row->isi_kumpul;
                                        ?>
                                                <a href="<?= base_url('/upload/kumpul tugas/') . $row->file_kumpul ?>" target="_blank" download class="btn btn-xs btn-primary">Download</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= base_url('/upload/kumpul tugas/') . $row->file_kumpul ?>" target="_blank" download class="btn btn-xs btn-primary">Download</a>
                                        <?php
                                            }
                                        } else {
                                            echo $row->isi_kumpul;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->nilai == null) {
                                            $edit = '';
                                        ?>
                                            <button type="button" title="Nilai" data-toggle="modal" data-target="#nilai" class="btn btn-xs bg-green waves-effect" onclick="nilai(this)" data-id_kumpul="<?= $row->id_kumpul ?>" data-nama="<?= $row->siswa ?>">Nilai</button>
                                        <?php
                                        } else {
                                            echo $row->nilai;
                                            $edit = '<button type="button" title="Edit Nilai" data-toggle="modal" data-target="#edit" class="btn btn-xs btn-primary waves-effect" onclick="edit(this)" data-id_kumpul="' . $row->id_kumpul . '" data-nama="' . $row->siswa . '" data-nilai="' . $row->nilai . '"><i class="material-icons">edit</i></button>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $edit ?>
                                        <button type="button" title="Hapus Jawaban" data-toggle="modal" data-target="#hapus" class="btn btn-xs bg-red waves-effect" onclick="hapus(this)" data-id_kumpul="<?= $row->id_kumpul ?>"><i class="material-icons">delete</i></button>
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
    </div>
</div>
<!-- #END# Basic Examples -->
</div>

<div class="modal fade" id="nilai" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Beri Nilai Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/nilaiTugas/' . $id_tugas) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <label for="nama">Nama Siswa</label>
                    <div class="input">
                        <input type="text" id="username_nilai" name="nama" class="form-control" readonly>
                    </div>
                    <label for="nilai">Nilai</label>
                    <div class="input">
                        <input type="number" name="nilai" min="0" max="100" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kumpul" id="id_kumpul_nilai">
                    <input type="hidden" name="add">
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
                <h4 class="modal-title" id="defaultModalLabel">Edit Daftar Nilai Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/nilaiTugas/' . $id_tugas) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <label for="nama">Nama Siswa</label>
                    <div class="input">
                        <input type="text" id="username_edit" name="nama" class="form-control" readonly>
                    </div>
                    <label for="nilai">Nilai</label>
                    <div class="input">
                        <input type="number" id="nilai_edit" name="nilai" min="0" max="100" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kumpul" id="id_kumpul_edit">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn bg-primary waves-effect">EDIT</button>
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
                <h4 class="modal-title" id="defaultModalLabel">Hapus Daftar Nilai & Tugas Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('guru/nilaiTugas/' . $id_tugas) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                </div>
                <div class="modal-body text-center">
                    <strong>
                        <h4>Apakah Anda Yakin Ingin Menghapus Daftar Nilai & Tugas Siswa ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kumpul" id="id_kumpul_hapus">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn bg-red waves-effect">HAPUS</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function nilai(identifier) {
        var b = $(identifier);
        var id_kumpul = b.data('id_kumpul');
        var nama = b.data('nama');

        $('#id_kumpul_nilai').val(id_kumpul);
        $('#username_nilai').val(nama);
    }

    function edit(identifier) {
        var b = $(identifier);
        var id_kumpul = b.data('id_kumpul');
        var username = b.data('nama');
        var nilai = b.data('nilai');

        $('#id_kumpul_edit').val(id_kumpul);
        $('#username_edit').val(username);
        $('#nilai_edit').val(nilai);
    }

    function hapus(identifier) {
        var b = $(identifier);
        var id_kumpul = b.data('id_kumpul');

        $('#id_kumpul_hapus').val(id_kumpul);
    }
</script>