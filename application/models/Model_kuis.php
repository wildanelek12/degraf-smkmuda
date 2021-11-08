<?php

class Model_kuis extends CI_Model
{
    public function sudahIkut($data)
    {
        return $this->db->get_where('hasil_kuis', ("(id_kuis = " . $data['id_kuis'] . " AND username = " . $data['username'] . " )"))->num_rows();
    }
    public function mulaiKuis($id, $jenis)
    {
        if ($jenis == 'Urut') {
            return $this->db->order_by('tgl_input', 'ASC')->get_where('soal', ['id_kuis' => $id])->result();
        } elseif ($jenis == 'Acak') {
            return $this->db->order_by('tgl_input', 'RANDOM')->get_where('soal', ['id_kuis' => $id])->result();
        }
    }
    public function hasilKuis($data)
    {
        $this->id_kuis = $data['id_kuis'];
        $this->username = $data['username'];
        $this->soal = $data['soal'];
        $this->jawaban = $data['jawab'];
        $this->benar = $data['benar'];
        $this->nilai = $data['nilai'];
        $this->tgl_mulai = $data['mulai'];
        $this->tgl_selesai = $data['selesai'];

        return $this->db->insert('hasil_kuis', $this);
    }
    public function getHasil($id)
    {
        $this->db->select('*, user.nama AS siswa');
        $this->db->where('user.status', '1');
        $this->db->join('user', 'user.username=hasil_kuis.username');
        return $this->db->get_where('hasil_kuis', ['id_kuis' => $id])->result();
    }
    public function getKuis()
    {
        $now = date('Y-m-d H:i:s');
        if ($this->session->userdata('role') == 1) {
            return $this->db->get('kuis')->result();
        } elseif ($this->session->userdata('role') == 2) {
            return $this->db->get_where('kuis', ("(tgl_buka <= '$now' AND tgl_tutup >= '$now' )"))->result();
        }
    }
    public function addKuis($kuis)
    {
        $this->nama_kuis = $kuis['nama_kuis'];
        $this->tgl_buka = $kuis['tgl_buka'];
        $this->tgl_tutup = $kuis['tgl_tutup'];
        $this->waktu = $kuis['waktu'];
        $this->jenis = $kuis['jenis'];

        return $this->db->insert('kuis', $this);
    }
    public function editKuis($kuis)
    {
        $this->nama_kuis = $kuis['nama_kuis'];
        $this->tgl_buka = $kuis['tgl_buka'];
        $this->tgl_tutup = $kuis['tgl_tutup'];
        $this->waktu = $kuis['waktu'];
        $this->jenis = $kuis['jenis'];

        return $this->db->update('kuis', $this, ['id_kuis' => $kuis['id_kuis']]);
    }
    public function delKuis($kuis)
    {
        return $this->db->delete('kuis', ['id_kuis' => $kuis['id_kuis']]);
    }

    public function getSoal($id)
    {
        return $this->db->get_where('soal', ['id_kuis' => $id])->result();
    }
    public function addSoal($kuis)
    {
        $this->id_kuis = $kuis['id_kuis'];
        $this->soal = $kuis['soal'];
        $this->a = $kuis['a'];
        $this->b = $kuis['b'];
        $this->c = $kuis['c'];
        $this->d = $kuis['d'];
        $this->benar = $kuis['benar'];
        $this->tgl_input = $kuis['tgl_input'];

        return $this->db->insert('soal', $this);
    }
    public function editSoal($kuis)
    {
        $this->id_kuis = $kuis['id_kuis'];
        $this->soal = $kuis['soal'];
        $this->a = $kuis['a'];
        $this->b = $kuis['b'];
        $this->c = $kuis['c'];
        $this->d = $kuis['d'];
        $this->benar = $kuis['benar'];

        return $this->db->update('soal', $this, ['id_soal' => $kuis['id_soal']]);
    }
    public function delSoal($kuis)
    {
        return $this->db->delete('soal', ['id_soal' => $kuis['id_soal']]);
    }
}
