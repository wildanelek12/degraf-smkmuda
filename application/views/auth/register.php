<div class="card">
    <div class="body">
        <form id="sign_up" method="POST" action="<?= base_url('auth/register') ?>">
            <div class="msg">Register Akun Baru</div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">contacts</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Masukkan No Induk" required autofocus>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" required>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password" minlength="6" placeholder="Masukkan Password" required>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="repassword" minlength="6" placeholder="Ulangi Password" required>
                </div>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTER</button>

            <div class="m-t-25 m-b--5 align-center">
                <a class="small" href="<?= base_url('auth') ?>">Sudah memiliki akun? Login !!!</a>
            </div>
        </form>
    </div>
</div>