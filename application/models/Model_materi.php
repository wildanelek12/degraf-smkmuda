<?php

class Model_materi extends CI_Model
{
    public function getMateri()
    {
        return $this->db->get('materi')->result();
    }
    public function addMateri()
    {
        $data = [
            'folder' => 'materi',
            'nama' => $_FILES['berkas']['name']
        ];
        if ($_FILES['berkas']['name'] == "") {
            $this->isi_materi = $this->input->post('isi');
        } else {
            $this->nama_materi = pathinfo($_FILES['berkas']['name'], PATHINFO_FILENAME);
            $this->isi_materi = $this->input->post('isi');
            $this->file_materi = $this->_uploadBerkas($data);
        }
        $this->tanggal = date('Y-m-d');

        return $this->db->insert('materi', $this);
    }
    public function editMateri($id)
    {
        $data = [
            'folder' => 'materi',
            'nama' => $_FILES['berkas']['name']
        ];
        if ($_FILES['berkas']['name'] == "") {
            $this->file_materi = $this->input->post('berkas_ada');
            $this->isi_materi = $this->input->post('isi');
        } else {
            $this->nama_materi = pathinfo($_FILES['berkas']['name'], PATHINFO_FILENAME);
            $this->isi_materi = $this->input->post('isi');
            $this->file_materi = $this->_uploadBerkas($data);
        }

        return $this->db->update('materi', $this, ['id_materi' => $id]);
    }
    public function delMateri($id)
    {
        return $this->db->delete('materi', ['id_materi' => $id]);
    }

    public function getTugas()
    {
        $now = date('Y-m-d H:i:s');
        if ($this->session->userdata('role') == 1) {
            return $this->db->get('tugas')->result();
        } elseif ($this->session->userdata('role') == 2) {
            return $this->db->get_where('tugas', ("(tgl_buka <= '$now' AND tgl_tutup >= '$now' )"))->result();
        }
    }
    public function cekKumpul($id_tugas, $user)
    {
        return $this->db->get_where('kumpul_tugas', ("(id_tugas=$id_tugas AND username=$user)"))->num_rows();
    }
    public function getKelompok($id)
    {
        $this->db->select('*');
        $this->db->where('id_tugas',$id);
        return $this->db->get('kelompok')->result();

    }
    public function getTotalSiswa($id)
    {
        $this->db->select('*');
        $this->db->where('id_tugas',$id);
        return $this->db->get('kelompok')->result();

    }
    public function getUser()
    {
        return $this->db->get('user')->result();
    }
    public function deleteSiswaKelompok($id_user,$id_tugas)
    {
    
        return $this->db->delete('detail_kelompok', array('id_user' => $id_user,'id_tugas'=>$id_tugas)); 
    }
    public function addTugas($tugas)
    {
        // guru tambah tugas
        if ($tugas['role'] == 1) {
            $data = [
                'folder' => 'tugas',
                'nama' => $_FILES['berkas']['name']
            ];

            $this->nama_tugas = $this->input->post('nama');
            $this->isi_tugas = $this->input->post('isi');

            if ($_FILES['berkas']['name'] != "") {
                $this->file_tugas = $this->_uploadBerkas($data);
            }

            $this->tgl_buka = $tugas['tgl_buka'];
            $this->tgl_tutup = $tugas['tgl_tutup'];

            return $this->db->insert('tugas', $this);
        }

        // siswa kumpul tugas
        elseif ($tugas['role'] == 2) {
            $data = [
                'folder' => 'kumpul tugas',
                'username' => $this->session->userdata('username'),
                'nama' => $_FILES['berkas']['name']
            ];
            $this->id_tugas = $tugas['id_tugas'];
            $this->username = $data['username'];

            if ($_FILES['berkas']['name'] == "") {
                $this->isi_kumpul = $this->input->post('isi');
            } else {
                $this->isi_kumpul = $this->input->post('isi');
                $this->file_kumpul = $this->_uploadBerkas($data);
            }

            $this->tgl_kumpul = $tugas['tgl_kumpul'];

            return $this->db->insert('kumpul_tugas', $this);
        }
    }
    public function addKelompok($kelompok)
    {

        return $this->db->insert('kelompok', $kelompok);
    }
    public function editTugas($tugas)
    {
        $data = [
            'folder' => 'chat',
            'nama' => $_FILES['berkas']['name']
        ];

        $this->nama_tugas = $this->input->post('nama');
        $this->isi_tugas = $this->input->post('isi');

        if ($_FILES['berkas']['name'] != "") {
            $this->file_tugas = $this->_uploadBerkas($data);
        }

        $this->tgl_buka = $tugas['tgl_buka'];
        $this->tgl_tutup = $tugas['tgl_tutup'];

        return $this->db->update('tugas', $this, ['id_tugas' => $tugas['id_tugas']]);
    }
    public function delTugas($tugas)
    {
        return $this->db->delete('tugas', ['id_tugas' => $tugas['id_tugas']]);
    }

    public function nilaiTugas($nilai)
    {
        $this->nilai = $nilai['nilai'];
        return $this->db->update('kumpul_tugas', $this, ['id_kumpul' => $nilai['id_kumpul']]);
    }

    public function setSiswaKelompok  ($data){
        return $this->db->insert('detail_kelompok', $data);
    }

    public function getKumpul($id)
    {
        $this->db->select('*, user.nama AS siswa');
        $this->db->where('user.status', '1');
        $this->db->join('user', 'user.username=kumpul_tugas.username');
        return $this->db->get_where('kumpul_tugas', ['id_tugas' => $id])->result();
    }
    public function delKumpul($nilai)
    {
        return $this->db->delete('kumpul_tugas', ['id_kumpul' => $nilai['id_kumpul']]);
    }

    public function _uploadBerkas($file)
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
