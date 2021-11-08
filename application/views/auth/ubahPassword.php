<p class="login-box-msg"><b>Ubah Password</b></p>
<?= $this->session->flashdata('message') ?>
<form class="user mt-4 form-submit" method="post" action="<?= base_url('auth/ubahPassword') ?>">
    <div class="form-group">
        <input type="password" class="form-control form-control-user" id="password" name='password' placeholder="Password Baru">
        <small style=" text-align: left; font-size: small;"><?= form_error('password'); ?></small>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user" id="repassword" name='repassword' placeholder="Konfirmasi Password Baru">
    </div>

    <button type="submit" class="btn btn-warning btn-user btn-block">
        Perbarui Password
    </button>
</form>