<?php

class Model_presensi extends CI_Model
{
    public function getPresensi()
    {
        if ($this->session->userdata('role') == 1) {
            $this->db->select('*, user.nama AS siswa');
            $this->db->where('user.status', '1');
            $this->db->join('user', 'user.username=presensi.username', 'left');
            $this->db->order_by('siswa', 'ASC');
            return $this->db->get('presensi')->result();
        } elseif ($this->session->userdata('role') == 2) {
            return $this->db->get_where('presensi', ['username' => $this->session->userdata('username')])->row_array();
        }
    }
    public function addPresensi()
    {
        $h = $this->db->get('presensi')->row_array();

        $pertemuan = 'h' . $this->input->post('pertemuan');
        $this->username = $this->session->userdata('username');
        $this->$pertemuan = $this->input->post('ket');

        if ($h['h1'] == null) {
            return $this->db->insert('presensi', $this);
        } else {
            return $this->db->update('presensi', [$pertemuan => $this->$pertemuan], ['username' => $this->username]);
        }
    }
    public function getForum()
    {
        $this->db->select('*, user.nama AS nama');
        $this->db->join('user', 'user.username = forum.username');
        $this->db->order_by('tgl_forum', 'ASC');
        return $this->db->get('forum')->result();
    }
    public function getForumSiswa()
    {
        $this->db->select('*, user.nama AS nama');
        $this->db->join('user', 'user.username = forum_siswa.username');
        $this->db->order_by('tgl_forum', 'ASC');
        return $this->db->get('forum_siswa')->result();
    }
    public function getGroupChat($id_user,$id_tugas)
    {
        $query = $this->db->get_where('detail_kelompok', ("(id_user <= '$id_user' AND id_tugas >= '$id_tugas' )"));
        $ret = $query->row();
        return $ret;

    }
    public function getGroupChatValue($id_kelompok)
    {

        $this->db->select('*, user.nama AS nama');
        $this->db->where('id_kelompok',$id_kelompok);
        
        $this->db->join('user', 'user.username = forum.username');
        $this->db->order_by('tgl_forum', 'ASC');
        return $this->db->get('forum')->result();

    }
    public function addForum($id_kelompok)
    {

        $data = [
            'folder' => 'forum',
            'nama' => $_FILES['berkas']['name']
        ];
        $this->username = $this->session->userdata('username');
        $this->isi = $this->input->post('isi');
        $this->tgl_forum = date('Y-m-d H:i:s');
        $this->id_kelompok = $id_kelompok;

        if ($_FILES['berkas']['name'] != "") {
            $this->berkas = $this->_uploadBerkasForum($data);
            
        }
        return $this->db->insert('forum', $this);
    }
    public function addForumSiswa()
    {
        $data = [
            'folder' => 'forum_siswa',
            'nama' => $_FILES['berkas']['name']
        ];
        $this->username = $this->session->userdata('username');
        $this->isi = $this->input->post('isi');
        $this->tgl_forum = date('Y-m-d H:i:s');

        if ($_FILES['berkas']['name'] != "") {
            $this->berkas = $this->_uploadBerkasForum($data);
            
        }
        return $this->db->insert('forum_siswa', $this);
    }

    public function daftarNilai($nilai)
    {
        $this->db->select('*, user.nama AS siswa, hasil_kuis.nilai AS nilai_kuis, kumpul_tugas.nilai AS nilai_tugas');
        $this->db->join('kumpul_tugas', 'kumpul_tugas.username=user.username');
        $this->db->join('hasil_kuis', 'hasil_kuis.username=user.username');
        if ($nilai['role'] == 1) {
            return $this->db->get('user')->result();
        } elseif ($nilai['role'] == 2) {
            return $this->db->get_where('user', ['user.username' => $nilai['username']])->result();
        }
    }
    public function nilaiTugas()
    {
        $this->db->select('kumpul_tugas.id_tugas, nama_tugas');
        $this->db->join('kumpul_tugas', 'kumpul_tugas.id_tugas=tugas.id_tugas');
        $this->db->group_by('nama_tugas');
        return $this->db->get('tugas')->result();
    }
    public function nilaiKuis()
    {
        $this->db->select('hasil_kuis.id_kuis, nama_kuis');
        $this->db->join('hasil_kuis', 'hasil_kuis.id_kuis=kuis.id_kuis');
        $this->db->group_by('nama_kuis');
        return $this->db->get('kuis')->result();
    }
    public function getPengguna()
    {
        return $this->db->get('user')->result();
    }
    public function aturPengguna($user)
    {
        $this->role = $this->input->post('role');
        return $this->db->update('user', $this, ['username' => $user]);
    }
    public function delPengguna($user)
    {
        return $this->db->delete('user', ['username' => $user]);
    }
    public function _uploadBerkasForum($file)
    {
        $now = date('d M Y');
        $config['upload_path']          = './upload/' . $file['folder'] . '/';
        if ($file['folder'] == 'kumpul tugas') {
            $config['file_name']            = $now . '_' . $file['folder'] . '_' . $file['username'] . '_' . $file['nama'];
        } else {
            $config['file_name']            = $now . '_' . $file['folder'] . '_' . $file['nama'];
        }
        $config['allowed_types']        = 'jpg|jpeg|png|pdf|docx|mp4|avi|flv|pptx';
        $config['overwrite']            = false;
        $config['max_size']             = 10240;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'format_upload');
        $this->format_upload->initialize($config);

        if ($this->format_upload->do_upload('berkas')) {
            return $this->format_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal Upload File');
            redirect($this->uri->uri_string());
        }
    }
    public function _uploadBerkasForumSiswa($file)
    {
        $now = date('d M Y');
        $config['upload_path']          = './upload/' . $file['folder'] . '/';
        if ($file['folder'] == 'kumpul tugas') {
            $config['file_name']            = $now . '_' . $file['folder'] . '_' . $file['username'] . '_' . $file['nama'];
        } else {
            $config['file_name']            = $now . '_' . $file['folder'] . '_' . $file['nama'];
        }
        $config['allowed_types']        = 'jpg|jpeg|png|pdf|docx|mp4|avi|flv|pptx';
        $config['overwrite']            = false;
        $config['max_size']             = 10240;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'format_upload');
        $this->format_upload->initialize($config);

        if ($this->format_upload->do_upload('berkas')) {
            return $this->format_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal Upload File');
            redirect($this->uri->uri_string());
        }
    }
}
