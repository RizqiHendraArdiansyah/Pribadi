<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Video Pembelajaran</h1>
        <hr class="mb-4">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <form action="<?= base_url('admin/video_pembelajaran/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Judul Video</label>
                                <input type="text" class="form-control" name="judul_video" value="<?= old('judul_video') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">URL Video</label>
                                <input type="text" class="form-control" name="video_url" value="<?= old('video_url') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Video</label>
                                <textarea class="form-control" name="deskripsi_video"><?= old('deskripsi_video') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('admin/video_pembelajaran/index') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
