<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    MATERI
                </h1>
                <?php
                if ($this->session->userdata('role') == 1) {
                ?>
                    <div class="block mb-4 text-left">
                        <a data-toggle="modal" data-target="#add" class="btn bg-green waves-effect">+ Tambah Materi</a>
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
                                <th>MATERI</th>
                                <th>TANGGAL</th>
                                <th>FILE MATERI</th>
                                <?php
                                if ($this->session->userdata('role') == 1) {
                                ?>
                                    <th>AKSI</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($materi as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?php
                                        $file = pathinfo($row->file_materi, PATHINFO_EXTENSION);
                                        if ($file == 'mp4' || $file == 'avi' || $file == 'flv') {
                                        ?>
                                            <video width="560" height="315" controls="true" src="<?= base_url('/upload/materi/') . $row->file_materi ?>"></video>
                                        <?php
                                        } elseif ($file == 'docx' || $file == 'pdf' || $file == 'png' || $file == 'jpg' || $file == 'jpeg' || $file == 'pptx') {
                                            if ($row->isi_materi == null) {
                                                echo $row->nama_materi;
                                            } else {
                                                echo $row->isi_materi;
                                            }
                                        } else {
                                            echo $row->isi_materi;
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($row->tanggal)) ?></td>
                                    <td>
                                        <?php
                                        if ($row->file_materi == null) {
                                            echo 'Tidak Tersedia';
                                        } else {
                                        ?>
                                            <a href="<?= base_url('/upload/materi/') . $row->file_materi ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                    </td>
                                <?php
                                        }
                                        if ($this->session->userdata('role') == 1) {
                                ?>
                                    <td>
                                        <button type="button" title="Edit" data-toggle="modal" data-target="#edit" class="btn btn-xs btn-primary waves-effect" onclick="edit(this)" data-id_materi="<?= $row->id_materi ?>" data-file_materi="<?= $row->file_materi ?>" data-isi="<?= $row->isi_materi ?>"><i class="material-icons">edit</i></button>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger waves-effect" onclick="hapus(this)" data-id_materi="<?= $row->id_materi ?>"><i class="material-icons">delete</i></button>
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

<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Daftar Materi</h4>
            </div>
            <form role="form" action="<?= base_url('guru/addMateri') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="isi">Isi Materi</label>
                        <input class="form-control" name="isi" id="isi_edit" rows="10" placeholder="Ketikkan isi materi disini jika diperlukan">
                    </div>
                    <div class="form">
                        <label for="exampleInputFile">File Materi</label>
                        <div class="input">
                            <div class="custom-file">
                                <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">

                            </div>
                        </div>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title">Konfirmasi Edit Daftar Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= base_url('guru/addMateri') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="isi">Isi Materi</label>
                        <input class="form-control" name="isi" id="isi_edit" rows="10" placeholder="Ketikkan isi materi disini jika diperlukan">
                    </div>
                    <div class="form">
                        <label for="exampleInputFile">File Materi</label>
                        <div class="input">
                            <div class="custom-file">
                                <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf, pptx" data-validation-min-size="1kb" data-validation-max-size="2M">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_materi" id="id_materi_edit">
                    <input type="hidden" name="berkas_ada" id="berkas">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary">EDIT</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h5 class="modal-title">Konfirmasi Hapus Daftar Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <strong>
                    <h4>Apakah Anda Yakin Ingin Menghapus Daftar Materi ?</h4>
                </strong>
            </div>
            <div class="modal-footer">
                <form role="form" action="<?= base_url('guru/addMateri') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_materi" id="id_materi_hapus">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger">HAPUS</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">BATAL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function edit(identifier) {
        var b = $(identifier);
        var id_materi = b.data('id_materi');
        var isi = b.data('isi');
        var file_materi = b.data('file_materi');

        $('#id_materi_edit').val(id_materi);
        $('#isi_edit').val(isi);
        $('#berkas').val(file_materi);
    }

    function hapus(identifier) {
        var b = $(identifier);
        var id_materi = b.data('id_materi');

        $('#id_materi_hapus').val(id_materi);
    }
</script>