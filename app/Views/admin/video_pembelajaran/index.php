<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Daftar Video Pembelajaran</h1>
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
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="card-body">
                        <a href="<?= base_url('admin/video_pembelajaran/tambah') ?>" class="btn btn-primary mb-3">+ Tambah Video</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Video</th>
                                    <th>URL Video</th>
                                    <th>Thumbnail</th>
                                    <th>Deskripsi Video</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($videos as $key => $video) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $video->judul_video ?></td>
                                        <td><a href="<?= $video->video_url ?>" target="_blank"><?= $video->video_url ?></a></td>
                                        <td>
                                            <?php if ($video->thumbnail): ?>
                                                <img src="<?= base_url('uploads/thumbnails/' . $video->thumbnail) ?>" alt="Thumbnail" class="img-thumbnail" style="max-width: 100px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $video->deskripsi_video ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/video_pembelajaran/edit/' . $video->id_video) ?>" class="btn btn-warning btn-sm mb-2">Ubah</a>
                                            <a href="<?= base_url('admin/video_pembelajaran/delete/' . $video->id_video) ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
