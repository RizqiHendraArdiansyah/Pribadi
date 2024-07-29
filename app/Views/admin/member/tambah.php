<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Member</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/member/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                
                                    <!-- Dropdown untuk memilih penulis -->
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control " id="username" name="username" value="<?= old('username') ?>">
                                        <?php if (!empty(session()->getFlashdata('error_username'))) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session()->getFlashdata('error_username') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <span class="input-group-text" id="togglePassword" onclick="togglePassword()">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Member</label>
                                        <input type="text" class="form-control" id="nama_member" name="nama_member" value="<?= old('nama_member') ?>">
                                    </div>
                                    
                                    <!--<div class="mb-3">-->
                                        <!-- Dropdown untuk memilih kategori -->
                                    <!--    <label class="form-label" for="wilayah_kepengurusan">DPC</label>-->
                                    <!--    <select class="form-control" name="id_dpc" id="id_dpc">-->
                                    <!--        <?php foreach ($all_data_DPC as $DPC) : ?>-->
                                    <!--            <option value="<?= $DPC->id_dpc; ?>"><?= $DPC->nama_dpc; ?></option>-->
                                    <!--        <?php endforeach; ?>-->
                                    <!--    </select>-->
                                    <!--    <small>*dropdown DPC</small>-->
                                    <!--</div>-->
                                    
                                    <div class="mb-3">
                                        <label for="id_dpd" class="form-label">Pilih DPD</label>
                                        <select class="form-select" id="id_dpd" name="id_dpd" onchange="updateDPCDropdown()">
                                            <option value="">pilih dpd</option>
                                            <?php foreach ($all_data_DPD as $dpd): ?>
                                                <option value="<?= $dpd->id_dpd; ?>"><?= $dpd->nama_dpd; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="id_dpc" class="form-label">Pilih DPC</label>
                                        <select class="form-select" id="id_dpc" name="id_dpc">
                                            <!-- Opsi DPC akan diisi melalui JavaScript -->
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Kepengurusan</label>
                                        <input type="text" class="form-control" id="status_kepengurusan" name="status_kepengurusan" value="<?= old('status_kepengurusan') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Member</label>
                                        <input type="text" class="form-control" id="alamat_member" name="alamat_member" value="<?= old('alamat_member') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">No Hp Member</label>
                                        <input type="text" class="form-control" id="no_hp_member" name="no_hp_member" value="<?= old('no_hp_member') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Email Member</label>
                                        <input type="text" class="form-control" id="email_member" name="email_member" value="<?= old('email_member') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">IG Member</label>
                                        <input type="text" class="form-control" id="ig_member" name="ig_member" value="<?= old('ig_member') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">FB Member</label>
                                        <input type="text" class="form-control" id="fb_member" name="fb_member" value="<?= old('fb_member') ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin Member</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Laki-laki" <?php echo (old('jenis_kelamin') == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php echo (old('jenis_kelamin') == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                        <small>*dropdown jenis kelamin</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="pendidikan_member" class="form-label">Pendidikan Member</label>
                                        <textarea type="text" class="form-control tiny" id="pendidikan_member" name="pendidikan_member" rows="5" value="<?= old('pendidikan_member') ?>"></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="pekerjaan_member" class="form-label">Pekerjaan Member</label>
                                        <textarea type="text" class="form-control tiny" id="pekerjaan_member" name="pekerjaan_member" rows="5" value="<?= old('pekerjaan_member') ?>"></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="sertifikasi_member" class="form-label">Sertifikasi Member</label>
                                        <textarea type="text" class="form-control tiny" id="sertifikasi_member" name="sertifikasi_member" rows="5" value="<?= old('sertifikasi_member') ?>"></textarea>
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Foto Member</label>
                                        <input class="form-control <?= ($validation->hasError('foto_member')) ? 'is-invalid' : '' ?>" type="file" id="foto_member" name="foto_member">
                                        <?= $validation->getError('foto_member') ?>
                                    </div>
                                    <p>*Ukuran foto maksimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">CV Member</label>
                                        <input class="form-control <?= ($validation->hasError('cv_member')) ? 'is-invalid' : '' ?>" type="file" id="cv_member" name="cv_member">
                                        <?= $validation->getError('cv_member') ?>
                                    </div>
                                    <p>*Ukuran foto minimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>
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

    // Fungsi untuk memperbarui dropdown DPC berdasarkan DPD yang dipilih
    function updateDPCDropdown() {
        var dpdSelect = document.getElementById('id_dpd');
        var dpcSelect = document.getElementById('id_dpc');

        // Mendapatkan id_dpd yang dipilih
        var selectedDpdId = dpdSelect.options[dpdSelect.selectedIndex].value;

        // Mengosongkan dropdown DPC
        dpcSelect.innerHTML = '';

        // Menambahkan opsi DPC berdasarkan id_dpd yang dipilih
        <?php foreach ($all_data_DPC as $dpc): ?>
            if (<?= $dpc->id_dpd; ?> == selectedDpdId) {
                var option = document.createElement('option');
                option.value = <?= $dpc->id_dpc; ?>;
                option.text = '<?= $dpc->nama_dpc; ?>';
                dpcSelect.add(option);
            }
        <?php endforeach; ?>
    }
</script>

<?= $this->endSection('content'); ?>