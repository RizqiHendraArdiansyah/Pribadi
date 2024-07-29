<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>


<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Member</h1>
            </div>
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?php echo base_url() . "admin/member/tambah" ?>" class="btn btn-primary me-md-2"> + Tambah Member</a>
            </div>
        </div>
        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center" valign="middle">No</th>
                                        <th class="text-center" valign="middle">Username</th>
                                        <th class="text-center" valign="middle">Password</th>
                                        <th class="text-center" valign="middle">Nama</th>
                                        <th class="text-center" valign="middle">DPC</th>
                                        <th class="text-center" valign="middle">Status Kepengurusan</th>
                                        <th class="text-center" valign="middle">Alamat</th>
                                        <th class="text-center" valign="middle">No Hp</th>
                                        <th class="text-center" valign="middle">Email</th>
                                        <th class="text-center" valign="middle">IG</th>
                                        <th class="text-center" valign="middle">FB</th>
                                        <th class="text-center" valign="middle">Pendidikan</th>
                                        <th class="text-center" valign="middle">Pekerjaan</th>
                                        <th class="text-center" valign="middle">Sertifikasi</th>
                                        <th class="text-center" valign="middle">Jenis Kelamin</th>
                                        <th class="text-center" valign="middle">Foto</th>
                                        <th class="text-center" valign="middle">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($all_data_member as $tampilMember) : ?>
                                        <tr>
                                            <td class="text-center" valign="middle"><?php echo $i; ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['username'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['password'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['nama_member'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['nama_dpc'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['status_kepengurusan'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['alamat_member'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['no_hp_member'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['email_member'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['ig_member'] ?></td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['fb_member'] ?></td>
                                            <td class="text-center col-4" valign="middle"><?= substr(strip_tags($tampilMember['pendidikan_member']), 0, 60) ?>...</td>
                                            <td class="text-center col-4" valign="middle"><?= substr(strip_tags($tampilMember['pekerjaan_member']), 0, 60) ?>...</td>
                                            <td class="text-center col-4" valign="middle"><?= substr(strip_tags($tampilMember['sertifikasi_member']), 0, 60) ?>...</td>
                                            <td class="text-center" valign="middle"><?= $tampilMember['jenis_kelamin'] ?></td>
                                            <td class="text-center col-2" valign="middle"><img src="<?= base_url() . 'assets-baru/img/' . $tampilMember['foto_member'] ?>" class="img-fluid" alt="Foto Member"></td>
                                            <td class="text-center col-2" valign="middle"><img src="<?= base_url() . 'assets-baru/img/' . $tampilMember['cv_member'] ?>" class="img-fluid" alt="CV Member"></td>
                                            <td valign="middle">
                                                <div class="d-grid gap-2">
                                                    <a href="<?= base_url('admin/member/delete') . '/' . $tampilMember['id_member'] ?>" class="btn btn-danger">Hapus</a>
                                                    <a href="<?= base_url('admin/member/edit') . '/' . $tampilMember['id_member'] ?>" class="btn btn-primary">Ubah</a>
                                                    <a href="<?= base_url('/member/detail/' . $tampilMember['id_member'] . '/' . $tampilMember['slug']) ?>" class="btn btn-info" target="_blank">Preview</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//tab-pane-->
        </div><!--//container-fluid-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<?= $this->endSection('content') ?>