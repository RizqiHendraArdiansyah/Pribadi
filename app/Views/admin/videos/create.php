<!DOCTYPE html>
<html>
<head>
    <title>Tambah Video</title>
</head>
<body>
    <h1>Tambah Video</h1>
    <?= \Config\Services::validation()->listErrors() ?>
    <form action="admin/videos/store" method="post">
        <?= csrf_field() ?>
        <label for="judul_video">Judul Video</label>
        <input type="text" name="judul_video" id="judul_video">
        <br>
        <label for="video_url">Video URL</label>
        <input type="text" name="video_url" id="video_url">
        <br>
        <label for="deskripsi_video">Deskripsi Video</label>
        <textarea name="deskripsi_video" id="deskripsi_video"></textarea>
        <br>
        <label for="id_katvideo">Kategori Video</label>
        <select name="id_katvideo" id="id_katvideo">
            <?php foreach ($kategori_videos as $kategori): ?>
                <option value="<?= esc($kategori['id_katvideo']) ?>"><?= esc($kategori['nama_kategori_video']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Tambah Video</button>
    </form>
</body>
</html>
