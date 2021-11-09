<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model(array('model_presensi', 'model_materi', 'model_kuis'));
    }
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }
    public function presensi()
    {
        $data['presensi'] = $this->model_presensi->getPresensi();
        $this->load->view('templates/header');
        $this->load->view('guru/presensi', $data);
        $this->load->view('templates/footer');
    }
    public function addMateri()
    {
        $id_materi = $this->input->post('id_materi');
        if (isset($_POST['tambah'])) {
            if ($this->model_materi->addMateri()) {
                redirect('siswa/materi');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->model_materi->editMateri($id_materi)) {
                redirect('siswa/materi');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_materi->delMateri($id_materi)) {
                redirect('siswa/materi');
            } else {
                redirect('auth');
            }
        }
    }
    public function addTugas()
    {
        $data = [
            'id_tugas' => $this->input->post('id_tugas'),
            'tgl_buka' => $this->input->post('tglbuka'),
            'tgl_tutup' => $this->input->post('tgltutup'),
            'role' => $this->session->userdata('role')
        ];
        if (isset($_POST['tambah'])) {
            if ($this->model_materi->addTugas($data)) {
                redirect('siswa/tugas');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->model_materi->editTugas($data)) {
                redirect('siswa/tugas');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_materi->delTugas($data)) {
                redirect('siswa/tugas');
            } else {
                redirect('auth');
            }
        }
    }
    public function showChat($id_kelompok)
    {
        $forum['forum'] = [$this->model_presensi->getGroupChatValue($id_kelompok),$id_kelompok];
        $this->load->view('templates/header');
        $this->load->view('siswa/forum_tugas_siswa', $forum);
        $this->load->view('templates/footer');
    }
    public function detailKumpul($id)
    {
        $data['id_tugas'] = $id;
        $data['tugas'] = $this->model_materi->getKumpul($id);
        $this->load->view('templates/header');
        $this->load->view('guru/nilai_tugas', $data);
        $this->load->view('templates/footer');
    }
    public function nilaiTugas($id)
    {
        $id_kumpul = $this->input->post('id_kumpul');
        $tugas = $this->db->get_where('kumpul_tugas', ['id_kumpul' => $id_kumpul])->row_array();
        $data = [
            'id_kumpul' => $id_kumpul,
            'nilai' => $this->input->post('nilai'),
            'tabel' => 'tugas',
            'id_tugas' => $id,
            'username' => $tugas['username']
        ];
        if (isset($_POST['add'])) {
            if ($this->model_materi->nilaiTugas($data)) {
                $data = ['nilai' => 'add'];
                redirect('guru/detailKumpul/' . $id);
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->model_materi->nilaiTugas($data)) {
                $data = ['nilai' => 'edit'];
                redirect('guru/detailKumpul/' . $id);
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_materi->delKumpul($data)) {
                redirect('guru/detailKumpul/' . $id);
            } else {
                redirect('auth');
            }
        }
    }
    public function addKuis()
    {
        $data = [
            'id_kuis' => $this->input->post('id_kuis'),
            'nama_kuis' => $this->input->post('nama'),
            'tgl_buka' => $this->input->post('tglbuka'),
            'tgl_tutup' => $this->input->post('tgltutup'),
            'waktu' => $this->input->post('waktu'),
            'jenis' => $this->input->post('jenis')
        ];
        if (isset($_POST['tambah'])) {
            if ($this->model_kuis->addKuis($data)) {
                redirect('siswa/kuis');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->model_kuis->editKuis($data)) {
                redirect('siswa/kuis');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_kuis->delKuis($data)) {
                redirect('siswa/kuis');
            } else {
                redirect('auth');
            }
        }
    }
    public function nilaiKuis($id)
    {
        $data['kuis'] = $this->model_kuis->getHasil($id);
        $this->load->view('templates/header');
        $this->load->view('guru/nilai_kuis', $data);
        $this->load->view('templates/footer');
    }
    public function soal($id)
    {
        $data['id'] = $id;
        $data['soal'] = $this->model_kuis->getSoal($id);
        $this->load->view('templates/header');
        $this->load->view('guru/soal', $data);
        $this->load->view('templates/footer');
    }
    public function addSoal($id)
    {
        $data = [
            'id_kuis' => $this->input->post('id_kuis'),
            'id_soal' => $this->input->post('id_soal'),
            'soal' => $this->input->post('soal'),
            'a' => $this->input->post('a'),
            'b' => $this->input->post('b'),
            'c' => $this->input->post('c'),
            'd' => $this->input->post('d'),
            'benar' => $this->input->post('benar'),
            'tgl_input' => date('Y-m-d H:i:s')
        ];
        if (isset($_POST['tambah'])) {
            if ($this->model_kuis->addSoal($data)) {
                redirect('guru/soal/' . $id);
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->model_kuis->editSoal($data)) {
                redirect('guru/soal/' . $id);
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_kuis->delSoal($data)) {
                redirect('guru/soal/' . $id);
            } else {
                redirect('auth');
            }
        }
    }
    public function daftarNilai()
    {
        $data['tugas'] = $this->model_presensi->nilaiTugas();
        $data['kuis'] = $this->model_presensi->nilaiKuis();
        $this->load->view('templates/header');
        $this->load->view('guru/daftar_nilai', $data);
        $this->load->view('templates/footer');
    }
    public function detailNilai($id)
    {
        $data['tugas'] = $this->model_materi->getKumpul($id);
        $data['kuis'] = $this->model_kuis->getHasil($id);
        // $data['nilai'] = $this->model_materi->getKumpul($id);
        // $data['nilai'] = $this->model_kuis->getHasil($id);
        $this->load->view('templates/header');
        $this->load->view('guru/detail_nilai', $data);
        $this->load->view('templates/footer');
    }
    public function pengguna()
    {
        $data['pengguna'] = $this->model_presensi->getPengguna();
        $this->load->view('templates/header');
        $this->load->view('guru/pengguna', $data);
        $this->load->view('templates/footer');
    }
    public function setPengguna()
    {
        $username = $this->input->post('username');
        if (isset($_POST['atur'])) {
            if ($this->model_presensi->aturPengguna($username)) {
                redirect('guru/pengguna');
            } else {
                redirect('auth');
            }
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_presensi->delPengguna($username)) {
                redirect('guru/pengguna');
            } else {
                redirect('auth');
            }
        }
    }
    public function kelompok($id)
    {
        $data['kelompok'] = [$this->model_materi->getKelompok($id), $id];
        $this->load->view('templates/header');
        $this->load->view('guru/daftar_kelompok', $data);
        $this->load->view('templates/footer');
    }
    public function addKelompok($id_tugas)
    {
        $data = [
            'nama_kelompok' => $this->input->post('nama'),
            'id_tugas' => $id_tugas
        ];
        if ($this->model_materi->addKelompok($data)) {
            redirect('guru/kelompok/' . $id_tugas);
        }
        // if (isset($_POST['tambah'])) {
        //     if ($this->model_materi->addKelompok($data)) {
        //         redirect('guru/daftar_kelompok');
        //     } else {
        //         var_dump("Here");
        //         // redirect('auth');
        //     }
        // } elseif (isset($_POST['edit'])) {
        //     if ($this->model_materi->editTugas($data)) {
        //         redirect('siswa/tugas');
        //     } else {
        //         redirect('auth');
        //     }
        // } elseif (isset($_POST['hapus'])) {
        //     if ($this->model_materi->delTugas($data)) {
        //         redirect('siswa/tugas');
        //     } else {
        //         redirect('auth');
        //     }
        // }
    }
    public function showSiswaKelompok($id_kelompok,$id_tugas)
     {
        $data['user'] = [$this->model_materi->getUser(),$id_kelompok,$id_tugas];
        $this->load->view('templates/header');
        $this->load->view('guru/daftar_siswa_kelompok', $data);
        $this->load->view('templates/footer');
    }
    public function deleteSiswaKelompok($id_user,$id_kelompok,$id_tugas)
    {
       $data['user'] = [$this->model_materi->deleteSiswaKelompok($id_user,$id_tugas),$id_kelompok,$id_tugas];
       redirect('guru/showSiswaKelompok/'.$id_kelompok.'/'.$id_tugas);
   }
    public function insertSiswaKelompok($id_user,$id_kelompok,$id_tugas)
    {
    
        $data = [
            'id_user' => $id_user,
            'id_kelompok' => $id_kelompok,
            'id_tugas' => $id_tugas
            
        ];

        if ($this->model_materi->setSiswaKelompok($data)) {
            redirect('guru/showSiswaKelompok/'.$id_kelompok.'/'.$id_tugas);
        }
   }
}
