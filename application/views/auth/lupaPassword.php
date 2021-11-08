<div class="card">
    <div class="body">
        <form id="forgot_password" method="POST" action="<?= base_url('auth/lupaPassword') ?>">
            <div class="msg">
                Masukkan alamat email Anda yang Anda gunakan untuk mendaftar. Kami akan mengirimkan email dengan nama pengguna Anda dan tautan untuk mengatur ulang kata sandi Anda.
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                </div>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">ATUR ULANG PASSWORD</button>

            <div class="row m-t-20 m-b--5 align-center">
                <a class="small" href="<?= base_url('auth') ?>">Login!</a>
            </div>
        </form>
    </div>
</div>