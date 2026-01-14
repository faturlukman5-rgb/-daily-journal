<?php
include "koneksi.php";

/* ======================
   SIMPAN (INSERT / UPDATE)
====================== */
if (isset($_POST['aksi']) && $_POST['aksi'] == 'simpan') {

    $id       = $_POST['id'];
    $username = $_POST['username'];

    // PASSWORD DIKUNCI = admin
    $password_hashed = md5('admin');

    if ($id == "") {
        $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?,?)");
        $stmt->bind_param("ss", $username, $password_hashed);
    } else {
        $stmt = $conn->prepare("UPDATE user SET username=? WHERE id=?");
        $stmt->bind_param("si", $username, $id);
    }

    $stmt->execute();
    $stmt->close();
    exit;
}


/* ======================
   HAPUS
====================== */
if (isset($_POST['aksi']) && $_POST['aksi'] == 'hapus') {

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM user WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    exit;
}

/* ======================
   PAGINATION
====================== */
$hlm = isset($_POST['hlm']) ? $_POST['hlm'] : 1;
$limit = 5;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

/* DATA */
$result = $conn->query("SELECT * FROM user ORDER BY id DESC LIMIT $limit_start, $limit");

/* TOTAL DATA */
$total = $conn->query("SELECT id FROM user")->num_rows;
$jumlah_page = ceil($total / $limit);
?>

<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th width="5%">No</th>
            <th>Username</th>
            <th>Password</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['password']) ?></td>
        <td>
            <button class="btn btn-success btn-sm btn-edit"
                data-id="<?= $row['id'] ?>"
                data-username="<?= $row['username'] ?>"
                data-password="<?= $row['password'] ?>">
                Edit
            </button>

            <button class="btn btn-danger btn-sm btn-hapus"
                data-id="<?= $row['id'] ?>">
                Hapus
            </button>
        </td>
    </tr>
    <?php } ?>

    </tbody>
</table>

<!-- PAGINATION -->
<nav>
<ul class="pagination justify-content-end">
<?php if ($hlm > 1) { ?>
    <li class="page-item halaman" id="<?= $hlm-1 ?>">
        <a class="page-link">&laquo;</a>
    </li>
<?php } ?>

<?php for ($i=1; $i<=$jumlah_page; $i++) { ?>
    <li class="page-item halaman <?= ($hlm==$i)?'active':'' ?>" id="<?= $i ?>">
        <a class="page-link"><?= $i ?></a>
    </li>
<?php } ?>

<?php if ($hlm < $jumlah_page) { ?>
    <li class="page-item halaman" id="<?= $hlm+1 ?>">
        <a class="page-link">&raquo;</a>
    </li>
<?php } ?>
</ul>
</nav>
