<?php
include "koneksi.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My DAILY JOURNAL</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
    crossorigin="anonymous"
    />
  </head>
  <body>
   

    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">My DAILY JOURNAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav  ms-auto  mb-2 mb-lg-0 text-dark">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#article">Article</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#gallery">Gallery</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="#schedule">Schedule</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="#profile">Profile</a>
           <li class="nav-item">
        <a class="nav-link" href="login.php" target="_blank">Login</a>
        `</li>`
      </ul>
      <button id="tombol-Gelap" class="btn btn-warning" ><i class="bi bi-moon-fill"></i></button>
      <button id="tombol-Terang" class="btn btn-secondary" ><i class="bi bi-sun-fill"></i></button>
        </div>
        </div>
    </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="change text-center p-5 bg-danger-subtle text-sm-start change-t " >
        <div class=" container">
          <div class=" d-sm-flex flex-sm-row-reverse align-items-center  ">
            <img src="img/lawu.jpg" class="img-fluid" width="300">
            <div>
              <h1 class=" fw-bold display-4">Semua adalah sebuah memori</h1>
              <h4 class=" lead display-6">Mencatat kegiatan sehari hari yang ada tanpa tekecuali</h4>
              <h6>
                <span id="tanggal" ></span>
                <span id="jam"> </span>
              </h6>
            </div>
          </div>
        </div>
        <div class="mb-5"></div>
        <br> <br>
    </section>
    <!-- hero end -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container mt-4">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    
     <!-- SCHEDULE -->
      
    <section id="schedule" class="change text-center p-5">
      <div class="container mt-4">
        <h1 class="fw-bold display-4 pb-3 text-start">Jadwal Kuliah & Kegiatan Mahasiswa</h1>
        

        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
         <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-primary text-white">Senin</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">09:00 - 12:00</div>
                <div>Rekayasa Perangkat Lunak</div>
                <div class="text-muted">Ruang H.5.4</div>
                <div class="fw-bold">12:30 - 15:00</div>
                <div>Logika informatika</div>
                <div class="text-muted">Ruang H.5.2</div>    
              </div>
            </div>
          </div>

          <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-success text-white">Selasa</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">08:00 - 10:20</div>
                <div>Technopreneur</div>
                <div class="text-muted">Ruang H.4.3</div>
                <div class="fw-bold">16:20 - 18:00</div>
                <div>Pendidikan Kewarganegaraan</div>
                <div class="text-muted">Ruang E.3</div>
              </div>
            </div>
          </div>

           <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-success text-white">Rabu</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">07:00 - 09:00</div>
                <div>Sistem Operasi</div>
                <div class="text-muted">Ruang H.4.3</div>
                <div class="fw-bold">10:20 - 12:00</div>
                <div>Pemograman Berbasis Web</div>
                <div class="text-muted">Ruang D.2.J</div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-warning text-dark">Kamis</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">07:00 - 08:40</div>
                <div>Basis Data</div>
                <div class="text-muted">Ruang H.5.2</div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-info text-dark">Jumat</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">10:20 - 12.00</div>
                <div>Basis Data</div>
                <div class="text-muted">Ruang D.2.D</div>
                <div class="fw-bold">12:30 - 15.00</div>
                <div>Probabilitas dan statistik</div>
                <div class="text-muted">Ruang H.3.2</div>
              </div>
            </div>
          </div>

                    <div class="col">
            <div class="schedule-card">
              <div class="schedule-header bg-info text-dark">Sabtu</div>
              <div class="p-3 bg-white text-start">
                <div class="fw-bold">08:00 - 12.00</div>
                <div>Latihan Badminton</div>
                <div class="text-muted">Gor Tunggal Mas</div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </section>
    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-danger-subtle">
    <div class="container mt-4">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>

         <?php
$gallery = mysqli_query($conn,"SELECT * FROM gallery");
foreach($gallery as $g):
?>
  <div>
    <img src="img/<?= $g['image'] ?>" width="200">
    <h4><?= $g['title'] ?></h4>
  </div>
<?php endforeach; ?>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
                include "koneksi.php"; // sesuaikan dengan file koneksi kamu

                $query = "SELECT * FROM gallery ORDER BY tanggal DESC";
                $result = mysqli_query($conn, $query);

                $active = "active";

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                   <div class="carousel-item <?= $active; ?> text-center">

    <!-- WRAPPER -->
    <div class="d-inline-block position-relative">

        <img 
            src="img/<?= $row['gambar']; ?>" 
            style="height: 400px; max-width: 100%; object-fit: contain;"
            alt="<?= $row['judul']; ?>"
        >

        <!-- BACKGROUND OPACITY -->
        <div 
            class="position-absolute bottom-0 end-0 m-2 bg-dark bg-opacity-50 p-2 rounded"
            style="max-width: 90%;"
        >
            <h6 class="text-white mb-0"><?= $row['judul']; ?></h6>
        </div>

    </div>
</div>


                <?php
                    $active = ""; // hanya item pertama yg active
                }
                ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

    <!-- gallery end -->

<!-- PROFILE -->
    <section id="profile" class="change p-5 bg-danger-subtle">
      <div class="container">
        <h1 class="fw-bold display-4 text-start pb-3">Profil Mahasiswa</h1>

        <div class="d-flex flex-column flex-md-row align-items-center justify-content-start">
          <img src="img/fatur.jpg" class="rounded-circle mb-3 mb-md-0 me-md-4" width="180" height="180" alt="Foto Profil">

          <div class="card change-a text-center text-md-start" style="max-width: 700px;">
            <div class="card-body">
              <h5 class="card-title fw-bold">Fatur Lukman Dinata</h5>
              <p class="card-text mb-1"><strong>NIM:</strong> A11.2024.16076</p>
              <p class="card-text mb-1"><strong>Program Studi:</strong> Teknik Informatika</p>
              <p class="card-text mb-1"><strong>Email:</strong> faturlukman5@gmail.com</p>
              <p class="card-text mb-1"><strong>Telepon:</strong> +62 87813869838</p>
              <p class="card-text"><strong>Alamat:</strong> Barusari kec.Semarang Seletan kota.Semarang</p>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- footer begin -->
    <footer class="change-ikon text-center p-5">
      <div>
        <a href="https://www.instagram.com/udinusofficial"  class=" bi bi-instagram h2 p-2 "></a>
        <a href="https://x.com/udinusofficial" class="bi bi-twitter-x  h2 p-2"></a>
        <a href="https://wa.me/+62812685577" class=" bi bi-whatsapp  h2 p-2"></a>
      </div>
      <div class="change-ikon">
        A11.2024.16076 &copy; 2025
      </div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
    crossorigin="anonymous"></script>

    <script type="text/javascript">
    window.setTimeout("tampilwaktu()", 1000);

    function tampilwaktu() {
    var waktu = new Date();
    var bulan = waktu.getMonth() + 1;

    setTimeout("tampilwaktu()", 1000);
    document.getElementById("tanggal").innerHTML =
        waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
    document.getElementById("jam").innerHTML =
        waktu.getHours() +
        ":" +
        waktu.getMinutes() +
        ":" +
        waktu.getSeconds();
      }
    </script>

   <script type="text/javascript">
    // Mendapatkan elemen tombol
    const tombolGelap = document.getElementById("tombol-Gelap");
    const tombolTerang = document.getElementById("tombol-Terang");

    // Mendapatkan elemen koleksi yang akan diubah temanya
    const collection = document.getElementsByClassName("change"); // Sections & Cards
    const textCollection = document.getElementsByClassName("change-ikon"); // Teks/ikon footer

    // Mendapatkan elemen footer (untuk mengubah background)
    const footer = document.getElementById("mainFooter"); 
    
    // Pastikan tombol Terang nonaktif di awal
    tombolTerang.disabled = true;


    // --- FUNGSI MODE GELAP ---
    tombolGelap.onclick = function () {
        // 1. Body: Hapus kelas terang, tambahkan kelas gelap
        document.body.classList.remove("bg-white", "text-dark");
        document.body.classList.add("bg-dark", "text-white");

        // 2. Tombol: Atur status disabled dan warna
        tombolGelap.classList.remove("btn-warning");
        tombolGelap.classList.add("btn-secondary");
        tombolGelap.disabled = true; // Nonaktifkan tombol Gelap

        tombolTerang.classList.remove("btn-secondary");
        tombolTerang.classList.add("btn-warning");
        tombolTerang.disabled = false; // Aktifkan tombol Terang

        // 3. Footer: Ubah ke background gelap
        if (footer) {
            footer.classList.remove("bg-body-tertiary");
            footer.classList.add("bg-dark");
        }

        // 4. Elemen Utama (Sections & Cards - Kelas "change")
        for (let i = 0; i < collection.length; i++) {
            // Hapus kelas terang yang mungkin ada
            collection[i].classList.remove("bg-danger-subtle", "bg-white", "text-dark", "text-black");
            
            // Tambahkan kelas gelap
            collection[i].classList.add("bg-secondary", "text-black");
        }
        
        // 5. Teks/Ikon Footer (Kelas "change-ikon")
        for (let i = 0; i < textCollection.length; i++) {
            textCollection[i].classList.remove("text-dark", "text-black"); 
            textCollection[i].classList.add("text-white"); 
        }
    };


    // --- FUNGSI MODE TERANG (Kembali ke Semula) ---
    tombolTerang.onclick = function () {
        // 1. Body: Hapus kelas gelap, tambahkan kelas terang
        document.body.classList.remove("bg-dark", "text-white");
        document.body.classList.add("bg-white", "text-dark");

        // 2. Tombol: Atur status disabled dan warna
        tombolTerang.classList.remove("btn-warning");
        tombolTerang.classList.add("btn-secondary");
        tombolTerang.disabled = true; // Nonaktifkan tombol Terang

        tombolGelap.classList.remove("btn-secondary");
        tombolGelap.classList.add("btn-warning");
        tombolGelap.disabled = false; // Aktifkan tombol Gelap

        // 3. Footer: Kembalikan ke background terang
        if (footer) {
            footer.classList.remove("bg-dark");
            footer.classList.add("bg-body-tertiary");
        }

        // 4. Elemen Utama (Sections & Cards - Kelas "change")
        for (let i = 0; i < collection.length; i++) {
            // Hapus kelas gelap
            collection[i].classList.remove("bg-secondary", "text-white");
            
            // Kembalikan warna awal spesifik (berdasarkan ID/kondisi)
            if (collection[i].id === "hero" || collection[i].id === "gallery") {
                collection[i].classList.add("bg-danger-subtle"); // Untuk Hero dan Gallery
            } else {
                collection[i].classList.add("bg-white"); // Untuk Card
            }
            // Kembalikan warna teks awal
            collection[i].classList.add("text-dark");
        }

        // 5. Teks/Ikon Footer (Kelas "change-ikon")
        for (let i = 0; i < textCollection.length; i++) {
            textCollection[i].classList.remove("text-white"); 
            textCollection[i].classList.add("text-dark"); 
        }
    };
</script>
  </body>
</html>