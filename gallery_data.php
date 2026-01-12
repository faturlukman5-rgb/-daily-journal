<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th class="w-25">Judul Gallery</th>
            <th class="w-75">Deskripsi</th>
            <th class="w-25">Gambar</th>
            <th class="w-25">Aksi</th>
        </tr>
    </thead>
    <tbody>
<?php
include "koneksi.php";

$hlm = (isset($_POST['hlm'])) ? $_POST['hlm'] : 1;
$limit = 3;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM gallery ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);

while ($row = $hasil->fetch_assoc()) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <strong><?= $row["judul"] ?></strong>
        <br>pada : <?= $row["tanggal"] ?>
        <br>oleh : <?= $row["username"] ?>
    </td>
    <td><?= $row["isi"] ?></td>
    <td>
        <?php
        if ($row["gambar"] != '') {
            if (file_exists('img/' . $row["gambar"])) {
        ?>
            <img src="img/<?= $row["gambar"] ?>" width="100">
        <?php
            }
        }
        ?>
    </td>
    <td>
        <a href="#" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
            <i class="bi bi-pencil"></i>
        </a>
        <a href="#" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
            <i class="bi bi-x-circle"></i>
        </a>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="id" value="<?= $row["id"] ?>">

                    <div class="mb-3">
                        <label class="form-label">Judul Gallery</label>
                        <input type="text" class="form-control" name="judul_gallery" value="<?= $row["judul"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required><?= $row["isi"] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Lama</label><br>
                        <?php
                        if ($row["gambar"] != '') {
                            if (file_exists('img/' . $row["gambar"])) {
                        ?>
                            <img src="img/<?= $row["gambar"] ?>" width="100">
                        <?php
                            }
                        }
                        ?>
                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
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
<!-- ================= END MODAL EDIT ================= -->

<!-- ================= MODAL HAPUS ================= -->
<div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">
                <div class="modal-body">
                    Yakin hapus gallery <strong><?= $row["judul"] ?></strong> ?
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <input type="submit" name="hapus" value="Hapus" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================= END MODAL HAPUS ================= -->

    </td>
</tr>
<?php } ?>
    </tbody>
</table>

<?php
$sql1 = "SELECT * FROM gallery";
$hasil1 = $conn->query($sql1);
$total_records = $hasil1->num_rows;
?>
<p>Total gallery : <?= $total_records ?></p>

<nav>
<ul class="pagination justify-content-end">
<?php
$jumlah_page = ceil($total_records / $limit);
$jumlah_number = 1;
$start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
$end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;

if($hlm == 1){
    echo '<li class="page-item disabled"><a class="page-link">First</a></li>';
    echo '<li class="page-item disabled"><a class="page-link">&laquo;</a></li>';
}else{
    $prev = $hlm - 1;
    echo '<li class="page-item halaman" id="1"><a class="page-link">First</a></li>';
    echo '<li class="page-item halaman" id="'.$prev.'"><a class="page-link">&laquo;</a></li>';
}

for($i=$start_number; $i<=$end_number; $i++){
    $active = ($hlm==$i)? 'active':'';
    echo '<li class="page-item halaman '.$active.'" id="'.$i.'"><a class="page-link">'.$i.'</a></li>';
}

if($hlm==$jumlah_page){
    echo '<li class="page-item disabled"><a class="page-link">&raquo;</a></li>';
    echo '<li class="page-item disabled"><a class="page-link">Last</a></li>';
}else{
    $next = $hlm + 1;
    echo '<li class="page-item halaman" id="'.$next.'"><a class="page-link">&raquo;</a></li>';
    echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link">Last</a></li>';
}
?>
</ul>
</nav>
