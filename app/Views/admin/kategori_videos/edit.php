<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori Video</title>
</head>
<body>
    <h1>Edit Kategori Video</h1>
    <?= \Config\Services::validation()->listErrors() ?>
    <form action="admin/kategori_videos/update/<?= esc($kategori_video['id_katvideo']) ?>" method="post">
        <?= csrf_field() ?>
        <label for="nama_kategori_video">Nama Kategori Video</label>
        <input type="text" name="nama_kategori_video" id="nama_kategori_video" value="<?= esc($kategori_video['nama_kategori_video']) ?>">
        <br>
        <button type="submit">Update Kategori</button>
    </form>
</body>
</html>
