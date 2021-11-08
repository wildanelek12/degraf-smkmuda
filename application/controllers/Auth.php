<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        if ($this->session->userdata('username')) {
            if ($this->session->userdata('role') == 1) {
                redirect('guru');
            } elseif ($this->session->userdata('role') == 2) {
                redirect('siswa');
            } else {
                redirect('auth/block');
            }
        }

        $this->form_validation->set_rules('username', 'Nomor Induk', 'trim|required', [
            'required' => 'Nomor Induk Harus Diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password Harus Diisi!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login | SiDegraf';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['status'] == '1') {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 1) {
                        redirect('guru');
                    } elseif ($user['role'] == 2) {
                        redirect('siswa');
                    } else {
                        redirect('auth/block');
                    }
                } else {
                    $this->toastr->error('Password Salah!');
                    redirect('auth');
                }
            } else {
                $this->toastr->error('Akun Belum Aktif\nSilahkan Aktivasi!');
                redirect('auth');
            }
        } else {
            $this->toastr->error('Akun Tidak Ditemukan\nSilahkan Daftar!');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('username')) {
            if ($this->session->userdata('role') == 1) {
                redirect('guru');
            } elseif ($this->session->userdata('role') == 2) {
                redirect('siswa');
            } else {
                redirect('auth/block');
            }
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama Harus Diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'Username Harus Diisi!',
            'is_unique' => 'Akun Sudah Terdaftar'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email Harus Diisi!',
            'valid_email' => 'Email Tidak Valid!',
            'is_unique' => 'Email Sudah Terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repassword]', [
            'required' => 'Password Harus Diisi!',
            'min_length' => 'Password Minimal 3 Karakter',
            'matches' => 'Konfirmasi Password Tidak Sesuai!'
        ]);
        $this->form_validation->set_rules('repassword', 'RePassword', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Daftar | SiDegraf';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $nama   = $this->input->post('name', true);
            $username  = $this->input->post('username', true);
            $email  = $this->input->post('email', true);

            // token
            // $token = base64_encode(random_bytes(32));

            $data = [
                'nama' => htmlspecialchars($nama),
                'username' => htmlspecialchars($username),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                // 'token' => $token,
                'role' => '2',
                'status' => '1'
            ];

            $this->db->insert('user', $data);
            $this->db->insert('presensi', ['username' => $username]);

            // $this->_sendEmail($token, 'verify');
            $this->toastr->success('Akun Berhasil Dibuat');
            redirect('auth');
        }
    }

    // private function _sendEmail($token, $type)
    // {
    //     $email = $this->input->post('email');
    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     $config = [
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'sinaumarketing.info@gmail.com',
    //         'smtp_pass' => 'base_url()',
    //         'smtp_port' => 465,
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n"
    //     ];

    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);

    //     $this->email->from($config['smtp_user'], 'Verifikasi Email Sinau Marketing');
    //     $this->email->to($email);

    //     if ($type == 'verify') {
    //         $this->email->subject('Aktivasi Akun Sinau Marketing');
    //         $this->email->message('
    //         Selamat Datang ' . $user['nama'] . ' di Sinau Marketing. Satu langkah lagi untuk dapat mengakses Sinau Marketing. Silahkan
    //         <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Aktivasi Akun Sinau Marketing Anda</a>');
    //     } elseif ($type == 'reset') {
    //         $this->email->subject('Reset Password Sinau Marketing');
    //         $this->email->message('
    //         Apakah Anda yakin ingin mengubah password akun Sinau Marketing Anda ? Silahkan
    //         <a href="' . base_url() . 'auth/reset?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password Akun Sinau Marketing Anda</a>');
    //     }

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    // public function verify()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $userToken = $this->db->get_where('user', ['token' => $token])->row_array();
    //         if ($userToken) {
    //             $this->db->set('status', '1');
    //             $this->db->where('email', $email);
    //             $this->db->update('user');
    //             $this->db->insert('presensi', ['username' => $user['username']]);
    //             $this->db->update('user', ['token' => null], ['email' => $email]);
    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="text-align:center;">');
    //             $this->toastr->success($email . ' Telah Aktif\nSilahkan Masuk!');
    //             redirect('auth');
    //         } else {
    //             $this->toastr->error('Token Salah!');
    //             redirect('auth');
    //         }
    //     } else {
    //         $this->toastr->error('Email Salah!');
    //         redirect('auth');
    //     }
    // }

    public function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $userToken = $this->db->get_where('user', ['token' => $token])->row_array();
            if ($userToken) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubahPassword();
            } else {
                $this->toastr->error('Token Salah!');
                redirect('auth');
            }
        } else {
            $this->toastr->error('Email Salah!');
            redirect('auth');
        }
    }

    public function lupaPassword()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Nomor Induk Harus Diisi!'
        ]);
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
        //     'required' => 'Email Harus Diisi!',
        //     'valid_email' => 'Email Tidak Sesuai!'
        // ]);
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Lupa Password | SiDegraf';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupaPassword');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username');
            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            if ($user) {
                $this->session->set_userdata('reset_password', $username);
                $this->ubahPassword();
                redirect('auth/ubahPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align:center;">Akun Tidak Ditemukan, Silahkan Daftar!</div>');
                redirect('auth/lupaPassword');
            }

            // $email = $this->input->post('email');
            // $user = $this->db->get_where('user', ['email' => $email])->row_array();
            // $userStatus = $this->db->get_where('user', ['email' => $email, 'status' => '1'])->row_array();

            // if ($user) {
            //     if ($userStatus) {
            //         $token = base64_encode(random_bytes(32));
            //         $userToken = [
            //             'email' => $email,
            //             'token' => $token
            //         ];

            //         $this->db->update('user', ['token' => $userToken['token']], ['email' => $userToken['email']]);
            //         $this->_sendEmail($token, 'reset');
            //         $this->toastr->success('Konfirmasi Password Baru Telah Terkirim\nSilahkan Cek Email Anda!');
            //         redirect('auth/lupaPassword');
            //     } else {
            //         $this->toastr->error('Akun Belum Aktif!');
            //         redirect('auth/lupaPassword');
            //     }
            // } else {
            //     $this->toastr->error('Akun Belum Terdaftar!');
            //     redirect('auth/lupaPassword');
            // }
        }
    }

    public function ubahPassword()
    {

        // if (!$this->session->userdata('reset_email')) {
        if (!$this->session->userdata('reset_password')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repassword]', [
            'required' => 'Password Harus Diisi!',
            'min_length' => 'Password Minimal 3 Karakter',
            'matches' => 'Konfirmasi Password Tidak Sesuai!'
        ]);
        $this->form_validation->set_rules('repassword', 'RePassword', 'required|trim|matches[password]');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Ubah Password | SiDegraf';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/ubahPassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $username = $this->session->userdata('reset_password');
            // $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            // $this->db->where('email', $email);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->session->unset_userdata('reset_password');
            $this->toastr->success('Password Berhasil Diperbarui!');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->toastr->success('Berhasil Logout');
        redirect('auth');
    }

    public function block()
    {
        $this->load->view('auth/block');
    }
}
