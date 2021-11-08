<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
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
        $data['absen'] = $this->db->get_where('presensi', ['username' => $this->session->userdata('username')])->result();
        $data['presensi'] = $this->model_presensi->getPresensi();
        $this->load->view('templates/header');
        $this->load->view('siswa/presensi', $data);
        $this->load->view('templates/footer');
    }
    public function addPresensi()
    {
        if (isset($_POST['tambah'])) {
            if ($this->model_presensi->addPresensi()) {
                redirect('siswa/presensi');
            } else {
                redirect('siswa');
            }
        }
    }
    public function materi()
    {
        $data['materi'] = $this->model_materi->getMateri();
        $this->load->view('templates/header');
        $this->load->view('materi', $data);
        $this->load->view('templates/footer');
    }
    public function tugas()
    {
        $data['tugas'] = $this->model_materi->getTugas();
        $this->load->view('templates/header');
        $this->load->view('tugas', $data);
        $this->load->view('templates/footer');
    }
    public function addTugas()
    {
        $id_tugas = $this->input->post('id_tugas');
        $user = $this->session->userdata('username');
        $cek = $this->model_materi->cekKumpul($id_tugas, $user);
        if ($cek < 1) {
            $data = [
                'id_tugas' => $id_tugas,
                'tgl_kumpul' => date('Y-m-d H:i:s'),
                'role' => $this->session->userdata('role')
            ];
            if (isset($_POST['tambah'])) {
                $this->model_materi->addTugas($data);
            }
            redirect('siswa/tugas');
        } else {
            redirect($this->uri->uri_string());
        }
    }
    public function forum()
    {
        $data['forum'] = $this->model_presensi->getForum();
        $this->load->view('templates/header');
        $this->load->view('forum', $data);
        $this->load->view('templates/footer');
    }
    public function addForum($id_kelompok)
    {
        if (isset($_POST['tambah'])) {
            $this->model_presensi->addForum($id_kelompok);
        }
        redirect('siswa/kelompokChatComplete/'.$id_kelompok);
    }
    public function kuis()
    {
        $data['kuis'] = $this->model_kuis->getKuis();
        $this->load->view('templates/header');
        $this->load->view('kuis', $data);
        $this->load->view('templates/footer');
    }
    public function mulaiKuis($id)
    {
        $data = [
            'id_kuis' => $id,
            'username' => $this->session->userdata('username')
        ];
        $cek = $this->model_kuis->sudahIkut($data);
        if ($cek < 1) {
            $soal = $this->db->get_where('kuis', ['id_kuis' => $id])->row_array();

            $data['kuis'] = [
                'nama_kuis' => $soal['nama_kuis'],
                'id' => $id,
                'waktu' => $soal['waktu']
            ];
            $data['soal'] = $this->model_kuis->mulaiKuis($id, $soal['jenis']);
            $this->load->view('templates/header');
            $this->load->view('siswa/mulai_kuis', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('siswa/kuis');
        }
    }
    public function hasilKuis($id)
    {
        $jawab = '';
        $listsoal = $this->input->post('soal');
        $id_soal = explode(',', $listsoal);
        for ($i = 0; $i < sizeof($id_soal); $i++) {
            $jawab .= $id_soal[$i] . ':' . $this->input->post('jawab' . $id_soal[$i]) . ',';
        }
        $listjawab = substr($jawab, 0, -1);

        $pc_jawaban = explode(",", $listjawab);

        $jumlah_benar = 0;
        $jumlah_salah = 0;
        $jumlah_soal = sizeof($pc_jawaban);

        foreach ($pc_jawaban as $jwb) {
            $pc_dt         = explode(":", $jwb);
            $id_soal     = $pc_dt[0];
            $jawaban     = $pc_dt[1];
            $cek_jwb     = $this->db->get_where('soal', ['id_soal' => $id_soal])->row();
            $jawaban == $cek_jwb->benar ? $jumlah_benar++ : $jumlah_salah++;
        }
        $nilai = ($jumlah_benar / $jumlah_soal)  * 100;

        $data = [
            'id_kuis' => $id,
            'username' => $this->session->userdata('username'),
            'soal' => $listsoal,
            'jawab' => $listjawab,
            'benar' => $jumlah_benar,
            'nilai' => $nilai,
            'mulai' => $this->input->post('mulai'),
            'selesai' => date('Y-m-d H:i:s')
        ];
        if (isset($_POST['hasil'])) {
            $this->model_kuis->hasilKuis($data);
            redirect('siswa/kuis');
        } else {
            redirect('siswa');
        }
    }
    public function daftarNilai()
    {
        $nilai = [
            'role' => $this->session->userdata('role'),
            'username' => $this->session->userdata('username')
        ];
        if ($nilai['role'] == 1) {
            $tugas = $this->db->get('kumpul_tugas')->result();
            $kuis = $this->db->get('hasil_kuis')->result();
        } elseif ($nilai['role'] == 2) {
            $tugas = $this->db->get_where('kumpul_tugas', ['username' => $nilai['username']])->result();
            $kuis = $this->db->get_where('hasil_kuis', ['username' => $nilai['username']])->result();
        }
        $n_tugas = '';
        $n_kuis = '';
        foreach ($tugas as $t) {
            $namat = $this->db->select('nama')->get_where('user', ['username' => $t->username])->row();
            $tugas = $this->db->select('nama_tugas')->get_where('tugas', ['id_tugas' => $t->id_tugas])->row();
            $n_tugas .= $namat->nama . ', tugas ' . $tugas->nama_tugas . ' : ' . $t->nilai . ';';
        }
        foreach ($kuis as $k) {
            $namak = $this->db->select('nama')->get_where('user', ['username' => $k->username])->row();
            $kuis = $this->db->select('nama_kuis')->get_where('kuis', ['id_kuis' => $k->id_kuis])->row();
            $n_kuis .= $namak->nama . ', kuis ' . $kuis->nama_kuis . ' : ' . $k->nilai . ';';
        }
        $tugas = substr($n_tugas, 0, -1);
        $kuis = substr($n_kuis, 0, -1);
        $data = [
            'kuis' => $kuis,
            'tugas' => $tugas
        ];
        $this->load->view('templates/header');
        $this->load->view('daftar_nilai', $data);
        $this->load->view('templates/footer');
    }
    public function kelompokChat($id_user,$id_tugas)
    {
        $data['kelompok'] = $this->model_presensi->getGroupChat($id_user,$id_tugas);

        foreach($data as $item)
        {
            redirect('siswa/kelompokChatComplete/'.$item->id_kelompok);
        }
       
        // $this->load->view('templates/header');
        // $this->load->view('forum', $data);
        // $this->load->view('templates/footer');
    }
    public function kelompokChatComplete($id_kelompok)
    {
        $forum['forum'] = [$this->model_presensi->getGroupChatValue($id_kelompok),$id_kelompok];
        $this->load->view('templates/header');
        $this->load->view('siswa/forum_tugas_siswa', $forum);
        $this->load->view('templates/footer');
    }
}
