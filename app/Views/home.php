<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Zakat & Infak</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <style>
        html {
            scroll-behavior: smooth;
            /* biar pindah section halus */
        }

        body {
            font-family: "Segoe UI", sans-serif;
        }

        section {
            padding: 80px 0;
        }

        /* Hanya untuk home (carousel), buang padding bawah */
        #home {
            background-color: #f0f8ff;
            padding-bottom: 0;
            /* hilangkan jarak kosong bawah carousel */
        }

        /* Tentang Kami: bisa perkecil padding atas */
        #tentang {
            background-color: #fff5e6;
            padding-top: 40px;
            /* lebih kecil dari default 80px */
        }

        #bantuan {
            background-color: #e6ffe6;
            /* hijau muda */
        }

        #zakat {
            background-color: #fff0f5;
            /* ungu muda */
        }

        #syarat {
            background-color: #ffffe6;
            /* kuning muda */
        }

        #daftar {
            background-color: #e6f7ff;
            /* biru muda */
        }

        footer {
            background-color: #004d00;
            /* hijau tua */
        }

        .btn-custom {
            border-radius: 30px;
            padding: 10px 25px;
        }

        /* Navbar aktif */
        .navbar-nav .nav-link {
            color: #f8f9fa !important;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffeb3b !important;
        }

        .navbar-nav .nav-link.active {
            color: #ffeb3b !important;
            font-weight: bold;
            border-bottom: 2px solid #ffeb3b;
        }

        /* Tombol Back to Top */
        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: none;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        #backToTop:hover {
            background: #218838;
        }

        .carousel-img {
            height: 777px;
            width: 100%;
            object-fit: contain;
            background-color: #000;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            padding: 15px;
        }

        @media (max-width: 992px) {
            .carousel-img {
                height: 500px;
                object-fit: cover;
            }
        }

        @media (max-width: 576px) {
            .carousel-img {
                height: 250px;
                object-fit: contain;
            }

            .carousel-caption h3 {
                font-size: 1rem;
            }

            .carousel-caption p {
                font-size: 0.8rem;
            }
        }

        .card-custom {
            border-radius: 20px;
            padding: 30px 20px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #eaf7f0, #d0f0c0);
            cursor: pointer;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .card-custom h5 {
            font-weight: 600;
            color: #006400;
        }

        .card-custom p {
            color: #333;
        }

        .card-zakat {
            border-radius: 20px;
            padding: 25px 15px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f9f9f9, #d9f2f9);
            cursor: pointer;
        }

        .card-zakat:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .card-zakat h5 {
            font-weight: 600;
            color: #007b55;
        }

        .card-zakat p {
            color: #444;
        }

        .list-persyaratan-modal li {
            background: #e6ffe6;
            /* hijau muda */
            margin-bottom: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 1rem;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .list-persyaratan-modal li:hover {
            transform: translateX(5px);
        }

        .list-persyaratan-modal li i {
            color: #28a745;
            /* hijau */
            margin-right: 10px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">SIPDZIS Papua</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)" data-target="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-target="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-target="#bantuan">Jenis Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-target="#zakat">Jenis Zakat</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-success btn-custom ml-2" href="/auth">Login</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <section id="home" class="pt-5 pb-0">
        <div id="mainCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#mainCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mainCarousel" data-slide-to="1"></li>
                <li data-target="#mainCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="file.jpg" class="d-block w-100 carousel-img" alt="Slide 1" />
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp">
                        <h3>Selamat Datang di Sistem Informasi Zakat & Infak</h3>
                        <p>Digital, Amanah, Transparan</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="file1.jpg" class="d-block w-100 carousel-img" alt="Slide 2" />
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp">
                        <h3>Bersama Kita Berbagi</h3>
                        <p>Mari ringankan beban saudara kita yang membutuhkan</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="file2.jpg" class="d-block w-100 carousel-img" alt="Slide 3" />
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp">
                        <h3>Transparansi Pengelolaan</h3>
                        <p>Laporan infak & zakat jelas dan terpercaya</p>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Sebelumnya</span>
            </a>
            <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Selanjutnya</span>
            </a>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center mb-4">Tentang Kami</h2>
            <p class="text-center">
                Sistem ini memudahkan pengelolaan zakat & infak secara digital. Dari
                pendaftaran mustahik, pembayaran zakat, hingga pelaporan, semuanya
                dilakukan secara transparan dan akuntabel.
            </p>
        </div>
    </section>

    <section id="bantuan">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Jenis Bantuan</h2>
            <div class="row">
                <?php foreach ($bantuan as $index => $b): ?>
                    <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
                        <div class="card card-custom text-center bantuan-card"
                            data-id="<?= $b->id ?>"
                            data-nama="<?= htmlspecialchars($b->nama_bantuan) ?>"
                            data-persyaratan='<?= json_encode($b->persyaratan) ?>'>
                            <h5><?= $b->nama_bantuan ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="zakat" style="background-color: #f9f9f9">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Jenis Zakat</h2>
            <div class="row">
                <?php foreach ($kategori as $index => $b): ?>
                <div class="col-md-4 mb-4" data-aos="zoom-in">
                    <div class="card card-zakat text-center">
                        <h5><?= $b->nama_kategori?></h5>
                        <p><?= $b->keterangan?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Persyaratan -->
    <div class="modal fade" id="persyaratanModal" tabindex="-1" aria-labelledby="persyaratanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="persyaratanModalLabel">Persyaratan Bantuan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="list-persyaratan-modal" class="list-group list-persyaratan-modal"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="text-white text-center py-3">
        <p class="mb-0">&copy; 2025 Sistem Informasi Zakat & Infak</p>
    </footer>

    <!-- Tombol Back to Top -->
    <button id="backToTop">&#8679;</button>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false, // animasi bisa muncul berulang kali
        });

        // Back to Top
        const backToTop = document.getElementById("backToTop");
        window.onscroll = function() {
            if (
                document.body.scrollTop > 200 ||
                document.documentElement.scrollTop > 200
            ) {
                backToTop.style.display = "flex";
            } else {
                backToTop.style.display = "none";
            }
        };
        backToTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });

        // Scrollspy untuk aktifkan menu
        document.querySelectorAll('.nav-link[data-target]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Hapus 'active' dari semua link
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));

                // Tambahkan 'active' ke link yang diklik
                this.classList.add('active');

                // Scroll ke target
                const target = document.querySelector(this.getAttribute('data-target'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 70, // offset untuk navbar fixed
                        behavior: 'smooth'
                    });
                }
            });
        });


        document.querySelectorAll('.bantuan-card').forEach(card => {
            card.addEventListener('click', () => {
                const nama = card.getAttribute('data-nama');
                const persyaratan = JSON.parse(card.getAttribute('data-persyaratan'));

                // Ganti judul modal
                document.getElementById('persyaratanModalLabel').textContent = `Persyaratan - ${nama}`;

                // Isi ulang daftar persyaratan
                const list = document.getElementById('list-persyaratan-modal');
                list.innerHTML = '';

                persyaratan.forEach(item => {
                    const li = document.createElement('li');
                    li.classList.add("list-group-item");

                    const icon = document.createElement('i');
                    icon.classList.add("fas", "fa-check-circle", "me-2", "text-success");
                    li.appendChild(icon);

                    const text = document.createTextNode(item.nama_persyaratan);
                    li.appendChild(text);

                    list.appendChild(li);
                });

                // Tampilkan modal (Bootstrap 4 pakai jQuery)
                $('#persyaratanModal').modal('show');
            });
        });
    </script>
</body>

</html>