<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SiDegraf</title>
    <link rel="icon" href="https://pre-crastinator.com/degraf-smkmuda/assets/images/logo.png">
    <!-- Favicon-->
    <link rel="icon" href="<?= base_url('assets/'); ?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Core Css -->
    <link href="<?= base_url('assets/'); ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url('assets/'); ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url('assets/'); ?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?= base_url('assets/'); ?>plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="<?= base_url('assets/'); ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="<?= base_url('assets/'); ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.semanticui.min.css"> -->

    <!-- JQuery Steps Plugin Js -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/jquery-steps/jquery.steps.js"></script>
    <link href="<?= base_url('assets/'); ?>plugins/jquery-steps/jquery.steps.css" rel="stylesheet">

    <!-- Jquery Countdown -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery-countdown/jquery.countdown.js"></script>

    <!-- Wait Me Css -->
    <link href="<?= base_url('assets/'); ?>plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= base_url('assets/'); ?>css/themes/all-themes.css" rel="stylesheet" />

</head>

<body class="theme-teal">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?= base_url() ?>">SiDegraf SMK Muhammadiyah 2 Malang</a>
            </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->

        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?= base_url('assets/'); ?>images/12.jpg" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('nama') ?></div>
                    <div class="email"><?= $this->session->userdata('email') ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">

                            <li><a href="<?= base_url('auth/logout') ?>"><i class="material-icons">input</i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <?php
            if ($this->session->userdata('role') == 1) {
                $data = [
                    'role' => 'guru',
                    'presensi' => 'Presensi',
                    'nilai' => 'Nilai Siswa',
                    'forum' => 'Jawab Siswa'
                ];
            } elseif ($this->session->userdata('role') == 2) {
                $data = [
                    'role' => 'siswa',
                    'presensi' => 'Presensi',
                    'nilai' => 'Daftar Nilai',
                    'forum' => 'Tanya Guru'
                ];
            } ?>


            <!-- Menu -->
            <div class="menu">
                <ul class="list ">
                
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($data['role'] . '/presensi') ?>">
                            <i class="material-icons">playlist_add_check</i>
                            <span><?= $data['presensi'] ?></span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('siswa/materi') ?>">
                            <i class="material-icons">menu_book</i>
                            <span>Materi</span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('siswa/tugas') ?>">
                            <i class="material-icons">library_books</i>
                            <span>Tugas</span>
                        </a>
                    </li>

                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('siswa/kuis') ?>">
                            <i class="material-icons">style</i>
                            <span>Quiz</span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('siswa/daftarNilai') ?>">
                            <i class="material-icons">list</i>
                            <span><?= $data['nilai'] ?></span>
                        </a>
                    </li>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('siswa/forumSiswa') ?>">
                            <i class="material-icons">forum</i>
                            <span><?= $data['forum'] ?></span>
                        </a>
                    </li>
                    <?php
                    if ($this->session->userdata('role') == 1) {
                    ?>
                        <li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('guru/pengguna') ?>">
                                <i class="material-icons">group</i>
                                <span>Manajemen Pengguna</span>
                            </a>
                        </li>
                        <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('./upload/GURU.pdf') ?>">
                            <i class="material-icons">book</i>
                            <span>Buku Panduan</span>
                        </a>
                    </li>
                    <?php
                    }elseif($this->session->userdata('role') == 2){
                    ?>
                    <li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('./upload/SISWA.pdf') ?>">
                            <i class="material-icons">book</i>
                            <span>Buku Panduan</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- #Menu -->

            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; copyright <a href="<?= base_url() ?>">SiDegraf</a>.
                </div>
                <div class="version">
                    <b>SMK Muhammadiyah 2 Malang </b>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD <?= strtoupper($data['role']) ?></h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text"><?= strtoupper($data['presensi']) ?></div>
                            <div class="number">
                                <?php
                                if ($this->session->userdata('role') == 1) {

                                    echo $this->db->get('presensi')->num_rows();
                                } elseif ($this->session->userdata('role') == 2) {
                                    $absen = $this->db->get_where('presensi', ['username' => $this->session->userdata('username')])->result();
                                    foreach ($absen as $row) {
                                        $h = '';
                                        if ($row->h1 == null) {
                                            $h = '0';
                                        } elseif ($row->h2 == null) {
                                            $h = '1';
                                        } elseif ($row->h3 == null) {
                                            $h = '2';
                                        } elseif ($row->h4 == null) {
                                            $h = '3';
                                        } elseif ($row->h5 == null) {
                                            $h = '4';
                                        } elseif ($row->h6 == null) {
                                            $h = '5';
                                        } elseif ($row->h7 == null) {
                                            $h = '6';
                                        } elseif ($row->h8 == null) {
                                            $h = '7';
                                        } elseif ($row->h9 == null) {
                                            $h = '8';
                                        } elseif ($row->h10 == null) {
                                            $h = '9';
                                        } elseif ($row->h11 == null) {
                                            $h = '10';
                                        } elseif ($row->h12 == null) {
                                            $h = '11';
                                        } elseif ($row->h13 == null) {
                                            $h = '12';
                                        } elseif ($row->h14 == null) {
                                            $h = '13';
                                        } elseif ($row->h15 == null) {
                                            $h = '14';
                                        } elseif ($row->h16 == null) {
                                            $h = '15';
                                        } elseif ($row->h16 != null) {
                                            $h = '16';
                                        }
                                        echo  $h;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">menu_book</i>
                        </div>
                        <div class="content">
                            <div class="text">MATERI</div>
                            <div class="number">
                                <?= $this->db->get('materi')->num_rows();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">TUGAS</div>
                            <div class="number">
                                <?= count($this->model_materi->getTugas());
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">style</i>
                        </div>
                        <div class="content">
                            <div class="text">QUIZ</div>
                            <div class="number">
                                <?= count($this->model_kuis->getKuis());
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">list_alt</i>
                        </div>
                        <div class="content">
                            <div class="text"><?= strtoupper($data['nilai']) ?></div>
                            <div class="number">
                                <?php
                                $nilai = [
                                    'role' => $this->session->userdata('role'),
                                    'username' => $this->session->userdata('username')
                                ];
                                echo count($this->model_presensi->daftarNilai($nilai));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text"><?= strtoupper($data['forum']) ?></div>
                            <div class="number">
                                <?= count($this->model_presensi->getForum()) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->