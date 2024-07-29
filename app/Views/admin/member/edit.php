<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Member</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/member/proses_edit/' . $memberData->id_member) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $memberData->username; ?>">
                                        <?php if (!empty(session()->getFlashdata('error_username'))) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session()->getFlashdata('error_username') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" value="<?= $memberData->password; ?>">
                                            <span class="input-group-text" id="togglePassword" onclick="togglePassword()">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Member</label>
                                        <input type="text" class="form-control" id="nama_member" name="nama_member" value="<?= $memberData->nama_member; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <!-- Dropdown untuk memilih kategori -->
                                        <label class="form-label" for="kategori">Nama DPC</label>
                                        <select class="form-control" id="id_dpc" name="id_dpc">
                                            <?php foreach ($dpcData as $dpc) : ?>
                                                <option value="<?= $dpc->id_dpc; ?>" <?php echo ($dpc->id_dpc == $memberData->id_dpc) ? 'selected' : ''; ?>>
                                                    <?= $dpc->nama_dpc; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small>*dropdown DPC</small>
                                    </div>

                                    
                                   <div class="mb-3">
                                        <label class="form-label">Status Kepengurusan</label>
                                        <input type="text" class="form-control" id="status_kepengurusan" name="status_kepengurusan" value="<?= $memberData->status_kepengurusan; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Member</label>
                                        <input type="text" class="form-control" id="alamat_member" name="alamat_member" value="<?= $memberData->alamat_member; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">No HP Member</label>
                                        <input type="text" class="form-control" id="no_hp_member" name="no_hp_member" value="<?= $memberData->no_hp_member; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Email Member</label>
                                        <input type="text" class="form-control" id="email_member" name="email_member" value="<?= $memberData->email_member; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">IG Member</label>
                                        <input type="text" class="form-control" id="ig_member" name="ig_member" value="<?= $memberData->ig_member; ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">FB Member</label>
                                        <input type="text" class="form-control" id="fb_member" name="fb_member" value="<?= $memberData->fb_member; ?>">
                                    </div>
                                    
                                   <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin Member</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Laki-laki" <?= ($memberData->jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= ($memberData->jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                        <small>*dropdown jenis kelamin</small>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label class="form-label">Pendidikan Member</label>
                                        <textarea type="text" class="form-control tiny" id="pendidikan_member" name="pendidikan_member"><?= $memberData->pendidikan_member; ?></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan Member</label>
                                        <textarea type="text" class="form-control tiny" id="pekerjaan_member" name="pekerjaan_member"><?= $memberData->pekerjaan_member; ?></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Sertifikasi Member</label>
                                        <textarea type="text" class="form-control tiny" id="sertifikasi_member" name="sertifikasi_member"><?= $memberData->sertifikasi_member; ?></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Foto Member</label>
                                        <input type="file" class="form-control" id="foto_member" name="foto_member">
                                        <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets-baru/img/" . $memberData->foto_member; ?>">
                                        <?= $validation->getError('foto_member') ?>
                                    </div>
                                    <p>*Ukuran foto minimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">CV Member</label>
                                        <input type="file" class="form-control" id="cv_member" name="cv_member">
                                        <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets-baru/img/" . $memberData->cv_member; ?>">
                                        <?= $validation->getError('cv_member') ?>
                                    </div>
                                    <p>*Ukuran foto maksimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                    <p>*File harus berekstensi pdf</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                <div class="col">
                                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo session()->getFlashdata('success') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--//app-card-->

            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>

<?= $this->endSection('content') ?>