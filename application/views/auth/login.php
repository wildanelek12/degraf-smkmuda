<div class="card">
    <div class="body">
        <form id="sign_in" method="POST" action="<?= base_url('auth') ?>">
            <div class="msg">Silahkan Login Untuk Masuk Ke Halaman Utama</div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Masukkan No Induk" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                </div>
            </div>
            <button class="btn btn-block bg-pink waves-effect" type="submit">LOGIN</button>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-6">
                    <a class="small" href="<?= base_url('auth/register') ?>">Register Sekarang!</a>
                </div>
                <div class="col-xs-6 align-right">
                    <a class="small" href="<?= base_url('auth/lupaPassword') ?>">Lupa Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>