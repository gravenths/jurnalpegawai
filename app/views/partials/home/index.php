<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            			<div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 ></h4>
                </div>
                <?php if(USER_ROLE == 1): // Hanya administrator yang bisa lihat kartu Pegawai dan Jabatan ?>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_guru();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("guru/") ?>">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pegawai</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
        <!--        <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_kelas();  ?>
                    <a class="animated zoomIn record-count alert alert-primary"  href="<?php print_link("kelas/") ?>">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-group fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Kelas</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>			-->
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_jabatan();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("jabatan/") ?>">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-file fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Jabatan</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <?php endif; // end admin check ?>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_agenda();  ?>
                    <a class="animated zoomIn record-count card bg-success text-white"  href="<?php print_link("agenda/") ?>">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-calendar fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Aktivitas</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h5>Aktivitas Terbaru</h5>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Aktivitas</th>
                        <th>Tempat</th>
                    </tr>
                </thead>
                <tbody>
               <?php if(!empty($this->view_data->recent_activities)): ?>
                <?php $no = 1; foreach($this->view_data->recent_activities as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['hari']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['aktivitas']; ?></td>
                    <td><?php echo $row['tempat']; ?></td>
                 </tr>
                    <?php endforeach; ?>
              <?php else: ?>
                    <tr><td colspan="6" class="text-center">Belum ada aktivitas</td></tr>
              <?php endif; ?>
                </tbody>
            </table>
            <a href="<?php print_link('agenda/') ?>" class="btn btn-sm btn-secondary">Lihat Semua Aktivitas</a>
            <a href="<?php print_link('agenda/add') ?>" class="btn btn-sm btn-success ml-2"><i class="fa fa-plus"></i> Tambah Aktivitas</a>
        </div>
    </div>
</div>
