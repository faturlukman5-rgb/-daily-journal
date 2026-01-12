
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Gallery
    </button>

    <div class="row">
        <div class="table-responsive" id="gallery_data"></div>
    </div>

    <!-- Awal Modal Tambah -->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Gallery</label>
                            <input type="text" class="form-control" name="judul_gallery" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="gambar">
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
</div>
<script>
$(document).ready(function(){
    load_data();

    function load_data(hlm){
        $.ajax({
            url : "gallery_data.php",
            method : "POST",
            data : { hlm: hlm },
            success : function(data){
                $('#gallery_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>
<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {

    $judul_gallery = $_POST['judul_gallery'];
    $isi   = $_POST['deskripsi'];
    $tanggal       = date("Y-m-d H:i:s");
    $username      = $_SESSION['username'];
    $gambar        = '';
    $nama_gambar   = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('".$cek_upload['message']."');</script>";
            die;
        }
    }

    // UPDATE
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare(
            "UPDATE gallery SET 
            judul=?,
            isi=?,
            gambar=?,
            tanggal=?,
            username=?
            WHERE id=?"
        );

        $stmt->bind_param("sssssi", 
            $judul_gallery, $isi, $gambar, $tanggal, $username, $id
        );

    } 
    // INSERT
    else {
        $stmt = $conn->prepare(
            "INSERT INTO gallery (judul, isi, gambar, tanggal, username)
             VALUES (?,?,?,?,?)"
        );

        $stmt->bind_param("sssss", 
            $judul_gallery, $isi, $gambar, $tanggal, $username
        );
    }

    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>alert('Data gallery berhasil disimpan');document.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }

    $stmt->close();
    $conn->close();
}

// HAPUS
if (isset($_POST['hapus'])) {
    $id     = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>alert('Gallery berhasil dihapus');document.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menghapus gallery');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container">
    

    <div class="row">
        <div class="table-responsive" id="gallery_data"></div>
    </div>

    <!-- Awal Modal Tambah -->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Gallery</label>
                            <input type="text" class="form-control" name="judul_gallery" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="gambar">
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
</div>
<script>
$(document).ready(function(){
    load_data();

    function load_data(hlm){
        $.ajax({
            url : "gallery_data.php",
            method : "POST",
            data : { hlm: hlm },
            success : function(data){
                $('#gallery_data').html(data);
            }
        });
    }

    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    });
});
</script>
<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {

    $judul_gallery = $_POST['judul_gallery'];
    $isi   = $_POST['deskripsi'];
    $tanggal       = date("Y-m-d H:i:s");
    $username      = $_SESSION['username'];
    $gambar        = '';
    $nama_gambar   = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('".$cek_upload['message']."');</script>";
            die;
        }
    }

    // UPDATE
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare(
            "UPDATE gallery SET 
            judul=?,
            isi=?,
            gambar=?,
            tanggal=?,
            username=?
            WHERE id=?"
        );

        $stmt->bind_param("sssssi", 
            $judul_gallery, $isi, $gambar, $tanggal, $username, $id
        );

    } 
    // INSERT
    else {
        $stmt = $conn->prepare(
            "INSERT INTO gallery (judul, isi, gambar, tanggal, username)
             VALUES (?,?,?,?,?)"
        );

        $stmt->bind_param("sssss", 
            $judul_gallery, $isi, $gambar, $tanggal, $username
        );
    }

    $simpan = $stmt->execute();

    if ($simpan) {
        echo "<script>alert('Data gallery berhasil disimpan');document.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }

    $stmt->close();
    $conn->close();
}

// HAPUS
if (isset($_POST['hapus'])) {
    $id     = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>alert('Gallery berhasil dihapus');document.location='admin.php?page=gallery';</script>";
    } else {
        echo "<script>alert('Gagal menghapus gallery');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

