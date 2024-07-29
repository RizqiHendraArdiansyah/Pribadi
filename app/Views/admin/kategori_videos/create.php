<!DOCTYPE html>

<html>
<head>
    <title>Tambah Kategori Video</title>
</head>
<body>
    <h1>Tambah Kategori Video</h1>
    <?= \Config\Services::validation()->listErrors() ?>
    <form action="kategori_videos/store" method="post">
        <?= csrf_field() ?>
        <label for="nama_kategori_video">Nama Kategori Video</label>
        <input type="text" name="nama_kategori_video" id="nama_kategori_video">
        <br>
        <button type="submit">Tambah Kategori</button>
    </form>
</body>
</html>
