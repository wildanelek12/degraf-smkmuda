<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="header">
                <h1>
                    PRESENSI
                </h1>
                <?php
                if ($presensi['h16'] == null) {
                ?>
                    <div class="block mb-4 text-left">
                        <a data-toggle="modal" data-target="#presensi" class="btn bg-green waves-effect">+ Presensi</a>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="body">
                <table class="table table-bordered table-striped table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>Pertemuan ke-</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($n = 1; $n <= 16; $n++) {
                            if ($presensi['h' . $n] != null) {
                                echo "
                                    <tr>
                                        <td>" . $n . "</td>
                                        <td>" . $presensi['h' . $n] . "</td>
                                    </tr>
                                    ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>

<div class="modal fade" id="presensi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title" id="defaultModalLabel">Presensi Kehadiran Siswa</h4>
            </div>
            <form role="form" action="<?= base_url('siswa/addPresensi') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="input">
                        <label for="pertemuan" class="lead">Pertemuan ke-</label>
                        <?php
                        foreach ($absen as $row) {
                            $h = '';
                            if ($row->h1 == null) {
                                $h = '1';
                            } elseif ($row->h2 == null) {
                                $h = '2';
                            } elseif ($row->h3 == null) {
                                $h = '3';
                            } elseif ($row->h4 == null) {
                                $h = '4';
                            } elseif ($row->h5 == null) {
                                $h = '5';
                            } elseif ($row->h6 == null) {
                                $h = '6';
                            } elseif ($row->h7 == null) {
                                $h = '7';
                            } elseif ($row->h8 == null) {
                                $h = '8';
                            } elseif ($row->h9 == null) {
                                $h = '9';
                            } elseif ($row->h10 == null) {
                                $h = '10';
                            } elseif ($row->h11 == null) {
                                $h = '11';
                            } elseif ($row->h12 == null) {
                                $h = '12';
                            } elseif ($row->h13 == null) {
                                $h = '13';
                            } elseif ($row->h14 == null) {
                                $h = '14';
                            } 
                            echo '<input  class="lead" type="text" name="pertemuan" value="' . $h . '" readonly>';
                        }
                        ?>
                        <div class="input">
                            <label for="ket" class="lead">Keterangan</label>
                            <select name="ket" id="ket" class="form-control show-tick">
                                <option value="">Pilih</option>
                                <option value="H">Hadir</option>
                                <option value="S">Sakit</option>
                                <option value="I">Ijin</option>
                                <option value="A">Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tglinput" value="<?= date('Y-m-d H:i:s') ?>">
                    <input type="hidden" name="tambah">
                    <button type="submit" class="btn bg-green waves-effect">PRESENSI</button>
                    <button type="button" class="btn waves-effect" data-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>