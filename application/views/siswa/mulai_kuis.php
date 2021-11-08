<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-lg-9">
                        <h1>
                            QUIZ <?= strtoupper($kuis['nama_kuis']) ?>
                        </h1>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-box bg-red hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">access_alarm</i>
                            </div>
                            <div class="content">
                                <h4>Sisa Waktu</h4>
                                <div class="number timer" id="timer" data-waktu="<?= $kuis['waktu'] ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <form id="soal" method="post" action="<?= base_url('siswa/hasilKuis/' . $kuis['id']) ?>" enctype="multipart/form-data">
                    <?php
                    $listsoal = '';
                    foreach ($soal as $row) {
                        $jawab = 'jawab' . $row->id_soal;
                    ?>
                        <h6></h6>
                        <section>
                            <p class="lead"><?= $row->soal ?></p>
                            <div class="form-group">
                                <input type="radio" name="<?= $jawab ?>" id="<?= $row->id_soal ?>a" class="with-gap " value="a">
                                <label for="<?= $row->id_soal ?>a"><?= $row->a ?></label><br>
                                <input type="radio" name="<?= $jawab ?>" id="<?= $row->id_soal ?>b" class="with-gap " value="b">
                                <label for="<?= $row->id_soal ?>b"><?= $row->b ?></label><br>
                                <input type="radio" name="<?= $jawab ?>" id="<?= $row->id_soal ?>c" class="with-gap " value="c">
                                <label for="<?= $row->id_soal ?>c"><?= $row->c ?></label><br>
                                <input type="radio" name="<?= $jawab ?>" id="<?= $row->id_soal ?>d" class="with-gap " value="d">
                                <label for="<?= $row->id_soal ?>d"><?= $row->d ?></label>
                            </div>
                        </section>
                    <?php
                        $listsoal .= $row->id_soal . ',';
                    }
                    $listsoal = substr($listsoal, 0, -1);
                    ?>
                    <input type="hidden" name="soal" value="<?= $listsoal ?>">
                    <input type="hidden" name="mulai" value="<?= date('Y-m-d H:i:s') ?>">
                    <input type="hidden" name="hasil">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var form = $("#soal").show();

    form.steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        onFinishing: function(event, currentIndex) {
            return form.submit();
        },
    });

    $(document).ready(function() {
        var t = $('.timer');
        var dataWaktu = t.data('waktu');
        var detik = 1000;
        var menit = detik * 60;
        var waktu = dataWaktu * menit;
        var timer = new Date().getTime() + waktu;

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = timer - now;

            // Time calculations for days, hours, minutes and seconds
            // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("timer").innerHTML = hours + ":" + minutes + ":" + seconds;

            // If the count down is finished, write some text
            if (distance < 1) {
                clearInterval(x);
                return form.submit();
            }
        }, 1000);
    });
</script>