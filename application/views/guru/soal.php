<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    SOAL
                </h1>
                <div class="block mb-4 text-left">
                    <button type="button" data-toggle="modal" data-target="#add" class="btn bg-green waves-effect">+ Tambah Soal</button>
                </div>
            </div>

            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabel" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>SOAL</th>
                                <th>JAWABAN</th>
                                <th>JAWABAN BENAR</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($soal as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->soal ?></td>
                                    <td><?= "A. " . $row->a . "<br>B. " . $row->b . "<br>C. " . $row->c . "<br>D. " . $row->d ?></td>
                                    <td><?= strtoupper($row->benar) ?></td>
                                    <td>
                                        <button type="button" title="Edit" data-toggle="modal" data-target="#edit" class="btn btn-xs btn-primary waves-effect" onclick="edit(this)" data-id_kuis="<?= $row->id_kuis ?>" data-id_soal="<?= $row->id_soal ?>" data-soal="<?= $row->soal ?>" data-a="<?= $row->a ?>" data-b="<?= $row->b ?>" data-c="<?= $row->c ?>" data-d="<?= $row->soal ?>" data-benar="<?= $row->benar ?>"><i class="material-icons">edit</i></button>
                                        <button type="button" title="Hapus" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger waves-effect" onclick="hapus(this)" data-id_kuis="<?= $row->id_kuis ?>" data-id_soal="<?= $row->id_soal ?>"><i class="material-icons">delete</i></button>
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
    <!-- #END# Basic Examples -->
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Tambah Soal</h4>
            </div>
            <form action="<?= base_url('guru/addSoal/' . $id) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label>Soal</label>
                        <div class="form-line">
                            <textarea name="soal" rows="5" class="form-control no-resize" placeholder="Ketikkan Soal disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban A</label>
                        <div class="form-line">
                            <textarea name="a" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban A disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban B</label>
                        <div class="form-line">
                            <textarea name="b" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban B disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban C</label>
                        <div class="form-line">
                            <textarea name="c" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban C disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban D</label>
                        <div class="form-line">
                            <textarea name="d" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban D disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban Benar</label>
                        <div class="form-line">
                            <select name="benar" class="form-control show-tick">
                                <option value="">Pilih</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kuis" value="<?= $id ?>">
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
                <h4 class="modal-title" id="defaultModalLabel">Edit Daftar Soal</h4>
            </div>
            <form action="<?= base_url('guru/addSoal/' . $id) ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label>Soal</label>
                        <div class="form-line">
                            <textarea id="soal" name="soal" rows="5" class="form-control no-resize" placeholder="Ketikkan Soal disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban A</label>
                        <div class="form-line">
                            <textarea id="a" name="a" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban A disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban B</label>
                        <div class="form-line">
                            <textarea id="b" name="b" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban B disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban C</label>
                        <div class="form-line">
                            <textarea id="c" name="c" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban C disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban D</label>
                        <div class="form-line">
                            <textarea id="d" name="d" rows="5" class="form-control no-resize" placeholder="Ketikkan Jawaban D disini"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <label>Jawaban Benar</label>
                        <div class="form-line">
                            <select id="benar" name="benar" class="form-control show-tick">
                                <option value="">Pilih</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kuis" value="<?= $id ?>">
                    <input type="hidden" name="id_soal" id="id_soal_edit">
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
                <h4 class="modal-title" id="defaultModalLabel">Hapus Soal</h4>
            </div>
            <form action="<?= base_url('guru/addSoal/' . $id) ?>" method="post" enctype="multipart/form-data" class="form-submit">

                <div class="modal-body text-center">
                    <div class="soal_hapus"></div>
                    <strong>
                        <h4>
                            Apakah Anda Yakin Ingin Menghapus Daftar Soal ?
                        </h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_soal_hapus" name="id_soal">
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
        var b = $(identifier);
        var id_soal = b.data('id_soal');
        var soal = b.data('soal');
        var jawab_a = b.data('a');
        var jawab_b = b.data('b');
        var jawab_c = b.data('c');
        var jawab_d = b.data('d');
        var benar = b.data('benar');

        $('#id_soal_edit').val(id_soal);
        $('#soal').val(soal);
        $('#a').val(jawab_a);
        $('#b').val(jawab_b);
        $('#c').val(jawab_c);
        $('#d').val(jawab_d);
        $('#benar').val(benar);
    }

    function hapus(identifier) {
        var b = $(identifier);
        var id_soal = b.data('id_soal');

        $('#id_soal_hapus').val(id_soal);
    }
</script>