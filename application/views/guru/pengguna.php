<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h1>
                    MANAJEMEN PENGGUNA
                </h1>
            </div>
            <div class="body">
                 <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tabel">
                    <thead>
                        <th>No</th>
                        <th>Nomor Induk</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pengguna as $row) :
                            if ($row->role == 1) {
                                $role = 'Guru';
                            } elseif ($row->role == 2) {
                                $role = 'Siswa';
                            }
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row->username ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $role ?></td>
                                <td>
                                    <button class="btn bg-blue btn-xs" title="Atur" data-toggle="modal" data-target="#atur" onclick="fetchAtur(this)" data-username="<?= $row->username ?>" data-nama="<?= $row->nama ?>" data-role="<?= $row->role ?>">Atur Sebagai</button>
                                    <button class="btn bg-red btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-username="<?= $row->username ?>" data-nama="<?= $row->nama ?>" data-role="<?= $row->role ?>">Hapus</button>
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

<div class="modal fade" id="atur" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h4 class="modal-title" id="defaultModalLabel">Atur Daftar Pengguna</h4>
            </div>
            <form role="form" action="<?= base_url('guru/setPengguna') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="username">Nomor Induk</label>
                        <input type="text" class="form-control form-control-user" name="username" id="username_atur" readonly>
                    </div>
                    <div class="input">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user" name="nama" id="nama_atur" readonly>
                    </div>
                    <div class="input">
                        <label for="role">Jabatan</label>
                        <select id="role_atur" name="role" class="form-control form-control-user">
                            <option value="1">Guru</option>
                            <option value="2">Siswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="input">
                        <input type="hidden" name="atur">
                        <button type="submit" class="btn btn-primary waves-effect">ATUR SEBAGAI</button>
                        <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="defaultModalLabel">Konfirmasi Hapus Daftar Pengguna</h4>
            </div>
            <form role="form" action="<?= base_url('guru/setPengguna') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="form">
                        <label for="username">Nomor Induk</label>
                        <input type="text" class="form-control form-control-user" name="username" id="username_hapus" readonly>
                    </div>
                    <div class="form">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user" name="nama" id="nama_hapus" readonly>
                    </div>
                    <div class="form">
                        <label for="role">Jabatan</label>
                        <select id="role_atur" name="role" class="form-control form-control-user" disabled>
                            <option value="1">Guru</option>
                            <option value="2">Siswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn bg-red waves-effect">HAPUS</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    function fetchAtur(identifier) {
        var button = $(identifier);
        var username = button.data('username');
        var nama = button.data('nama');
        var role = button.data('role');

        $('#username_atur').val(username);
        $('#nama_atur').val(nama);
        $('#role_atur').val(role);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var username = button.data('username');
        var nama = button.data('nama');
        var role = button.data('role');

        $('#username_hapus').val(username);
        $('#nama_hapus').val(nama);
        $('#role_hapus').val(role);
    }
</script>