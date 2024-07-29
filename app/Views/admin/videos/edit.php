<!DOCTYPE html>
<html>
<head>
    <title>Edit Video</title>
</head>
<body>
    <h1>Edit Video</h1>
    <?= \Config\Services::validation()->listErrors() ?>
    <form action="admin/videos/update/<?= esc($video['id_video']) ?>" method="post">
        <?= csrf_field() ?>
        <label for="judul_video">Judul Video</label>
        <input type="text" name="judul_video" id="judul_video" value="<?= esc($video['judul_video']) ?>">
        <br>
        <label for="video_url">Video URL</label>
        <input type="text" name="video_url" id="video_url" value="<?= esc($video['video_url']) ?>">
        <br>
        <label for="deskripsi_video">Deskripsi Video</label>
        <textarea name="deskripsi_video" id="deskripsi_video"><?= esc($video['deskripsi_video']) ?></textarea>
        <br>
        <label for="id_katvideo">Kategori Video</label>
        <select name="id_katvideo" id="id_katvideo">
            <?php foreach ($kategori_videos as $kategori): ?>
                <option value="<?= esc($kategori['id_katvideo']) ?>" <?= $kategori['id_katvideo'] == $video['id_katvideo'] ? 'selected' : '' ?>><?= esc($kategori['nama_kategori_video']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Update Video</button>
    </form>
</body>
</html>
