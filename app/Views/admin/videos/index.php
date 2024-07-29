<!DOCTYPE html>
<html>
<head>
    <title>Video List</title>
</head>
<body>
    <h1>Video List</h1>
    <ul>
        <?php foreach ($videos as $video): ?>
            <li>
                <?= esc($video['judul_video']) ?> - <?= esc($video['video_url']) ?>
                <a href="admin/videos/edit/<?= esc($video['id_video']) ?>">Edit</a>
                <a href="admin/videos/delete/<?= esc($video['id_video']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?');">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/videos/create">Tambah Video</a>
</body>
</html>
