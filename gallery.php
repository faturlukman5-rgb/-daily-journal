<?php
session_start();
include "koneksi.php";
include "upload_foto.php";

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login dulu');window.location='login.php';</script>";
    exit;
}

// ================= SIMPAN / UPDATE =================
if (isset($_POST['simpan'])) {
    $judul_gallery = $_POST['judul_gallery'];
    $isi           = $_POST['deskripsi'];
    $tanggal       = date("Y-m-d H:i:s");
    $username      = $_SESSION['username'];
    $gambar        = '';
    $nama_gambar   = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('".$cek_upload['message']."');history.back();</script>";
            exit;
        }
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            if(file_exists("img/" . $_POST['gambar_lama'])) unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE gallery SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("sssssi", $judul_gallery, $isi, $gambar, $tanggal, $username, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO gallery (judul, isi, gambar, tanggal, username) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $judul_gallery, $isi, $gambar, $tanggal, $username);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data gallery berhasil disimpan');window.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
    $stmt->close();
}

// ================= HAPUS =================
if (isset($_POST['hapus'])) {
    $id     = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '' && file_exists("img/" . $gambar)) unlink("img/" . $gambar);

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Gallery berhasil dihapus');window.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menghapus gallery');</script>";
    }
    $stmt->close();
}
?>

<div class="container mt-3">
    <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>

    <!-- ================= MODAL TAMBAH ================= -->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" enctype="multipart/form-data" action="">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Gallery</label>
                            <input type="text" name="judul_gallery" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= TABLE GALLERY ================= -->
    <div class="table-responsive mt-2">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
<?php
// ================= PAGINATION =================
$hlm = isset($_GET['hlm']) ? (int)$_GET['hlm'] : 1;
$limit = 3;
$start = ($hlm - 1) * $limit;
$no = $start + 1;

// Ambil data per halaman
$sql = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $start,$limit";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $no++ ?></td>
    <td><strong><?= $row['judul'] ?></strong><br>
        <small>Pada: <?= $row['tanggal'] ?> | Oleh: <?= $row['username'] ?></small>
    </td>
    <td><?= $row['isi'] ?></td>
    <td>
        <?php if($row['gambar'] != '' && file_exists('img/'.$row['gambar'])): ?>
            <img src="img/<?= $row['gambar'] ?>" width="100">
        <?php endif; ?>
    </td>
    <td>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>"><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id'] ?>"><i class="bi bi-x-circle"></i></button>
    </td>
</tr>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" enctype="multipart/form-data" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Judul Gallery</label>
                        <input type="text" name="judul_gallery" value="<?= $row['judul'] ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required><?= $row['isi'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Lama</label><br>
                        <?php if($row['gambar'] != '' && file_exists('img/'.$row['gambar'])): ?>
                            <img src="img/<?= $row['gambar'] ?>" width="100">
                        <?php endif; ?>
                        <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal fade" id="modalHapus<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    Yakin hapus gallery <strong><?= $row['judul'] ?></strong> ?
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <input type="submit" name="hapus" value="Hapus" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>

<?php endwhile; ?>
            </tbody>
        </table>
    </div>

<?php
// ================= PAGINATION =================
$total_records = $conn->query("SELECT COUNT(*) AS total FROM gallery")->fetch_assoc()['total'];
$total_page = ceil($total_records / $limit);
?>

<nav>
    <ul class="pagination justify-content-end">
        <!-- First / Prev -->
        <?php if($hlm > 1): ?>
            <li class="page-item"><a class="page-link" href="?page=gallery&hlm=1">First</a></li>
            <li class="page-item"><a class="page-link" href="?page=gallery&hlm=<?= $hlm-1 ?>">&laquo;</a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">First</span></li>
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        <?php endif; ?>

        <!-- Nomor halaman -->
        <?php for($i=1; $i<=$total_page; $i++): ?>
            <li class="page-item <?= ($i==$hlm)?'active':'' ?>"><a class="page-link" href="?page=gallery&hlm=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>

        <!-- Next / Last -->
        <?php if($hlm < $total_page): ?>
            <li class="page-item"><a class="page-link" href="?page=gallery&hlm=<?= $hlm+1 ?>">&raquo;</a></li>
            <li class="page-item"><a class="page-link" href="?page=gallery&hlm=<?= $total_page ?>">Last</a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            <li class="page-item disabled"><span class="page-link">Last</span></li>
        <?php endif; ?>
    </ul>
</nav>
