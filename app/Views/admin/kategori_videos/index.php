<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Kategori Video List</title>
</head>
<body>
    <h1>Kategori Video List</h1>
    <ul>
        <?php foreach ($kategori_videos as $kategori): ?>
            <li>
                <?= esc($kategori['nama_kategori_video']) ?> 
                <a href="admin/kategori_videos/edit/<?= esc($kategori['id_katvideo']) ?>">Edit</a>
                <a href="admin/kategori_videos/delete/<?= esc($kategori['id_katvideo']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?php echo base_url() . "admin/kategori_videos/create" ?>" class="btn btn-primary me-md-2">Tambah Pengumuman</a>
    </body>
</html>
