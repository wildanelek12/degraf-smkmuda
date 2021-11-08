<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <?php
                if ($this->session->userdata('role') == 1) {
                ?>

                    <h1>
                        JAWAB SISWA
                    </h1>
                <?php
                } elseif ($this->session->userdata('role') == 2) {
                ?>
                    <h1>
                        TANYA GURU
                    </h1>
                <?php
                } ?>
            </div>

            <div class="body">
                <?php
                foreach ($forum as $row) {
                    if ($this->session->userdata('username') == $row->username) {
                ?>
                        <div class="row clearfix">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10 bg-primary">
                                <div class="card hover-expand-effect text-left">
                                    <div class="header">
                                        <div class="pull-right"><?= $row->tgl_forum ?></div>

                                        <h4>Anda</h4>

                                    </div>
                                    <div class="body">
                                        <!-- cols="87" -->
                                        <textarea name="" id="" rows="5" style="width: 100%; resize: none; overflow-y: auto; border: 0px; outline: none;" readonly><?= $row->isi ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row clearfix">
                            <div class="col-lg-10 bg-red">
                                <div class="card hover-expand-effect">
                                    <div class="header">
                                        <div class="pull-right"><?= $row->tgl_forum ?></div>
                                        <h4><?= $row->nama ?></h4>
                                    </div>
                                    <div class="body">
                                        <textarea name="" id="" rows="5" style="width: 100%; resize: none; overflow-y: auto; border: 0px; outline: none;" readonly><?= $row->isi ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="footer">
                <div class="card">
                    <form method="POST" action="<?= base_url('siswa/addForum') ?>">
                        <div class="col-lg-11">
                            <textarea name="isi" id="" cols="100" rows="1" style="resize: none; overflow-y: auto;" class="form-control" placeholder="Ketik Pesan" autofocus autocomplete="off" required></textarea>
                        </div>
                        <div class="col-lg-1">
                            <input type="hidden" name="tambah">
                            <button class="btn btn-block bg-green" type="submit">Kirim
                                <i class="material-icons">

                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>