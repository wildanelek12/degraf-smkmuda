<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h1>
                    DAFTAR HADIR SISWA
                </h1>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabelnilai">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pert. 1</th>
                            <th>Pert. 2</th>
                            <th>Pert. 3</th>
                            <th>Pert. 4</th>
                            <th>Pert. 5</th>
                            <th>Pert. 6</th>
                            <th>Pert. 7</th>
                            <th>Pert. 8</th>
                            <th>Pert. 9</th>
                            <th>Pert. 10</th>
                            <th>Pert. 11</th>
                            <th>Pert. 12</th>
                            <th>Pert. 13</th>
                            <th>Pert. 14</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($presensi as $row) :
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->siswa ?></td>
                                    <td><?= $row->h1 ?></td>
                                    <td><?= $row->h2 ?></td>
                                    <td><?= $row->h3 ?></td>
                                    <td><?= $row->h4 ?></td>
                                    <td><?= $row->h5 ?></td>
                                    <td><?= $row->h6 ?></td>
                                    <td><?= $row->h7 ?></td>
                                    <td><?= $row->h8 ?></td>
                                    <td><?= $row->h9 ?></td>
                                    <td><?= $row->h10 ?></td>
                                    <td><?= $row->h11 ?></td>
                                    <td><?= $row->h12 ?></td>
                                    <td><?= $row->h13 ?></td>
                                    <td><?= $row->h14 ?></td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
                            <tr>
                                <td>
                                    Keterangan: Hadir (H), 
                         Sakit (S), 
                         Ijin (I),
                         Alpha (A)
                         </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                        </tbody>
                        
                   
                    </table>
                         
                         
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>