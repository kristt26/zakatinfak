        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="/assets/img/baznas.png">
                </div>
                <div class="sidebar-brand-text mx-3">SIPDZIS</div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <?php if (session('akses') == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- Pengguna -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                        aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pengguna</span>
                    </a>
                    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../petugas"><i class="fas fa-user-shield"></i> Petugas</a>
                            <a class="collapse-item" href="/muzaki-mustahik"><i class="fas fa-user-friends"></i> Muzaki/Mustahik</a>
                        </div>
                    </div>
                </li>

                <!-- Jenis Bantuan -->
                <li class="nav-item">
                    <a class="nav-link" href="/jenis_bantuan">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Jenis Bantuan</span>
                    </a>
                </li>

                <!-- Kategori ZIS -->
                <li class="nav-item">
                    <a class="nav-link" href="/kategori_zis">
                        <i class="fas fa-th-list"></i>
                        <span>Kategori ZIS</span>
                    </a>
                </li>

                <!-- Kriteria -->
                <li class="nav-item">
                    <a class="nav-link" href="/kriteria">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Kriteria</span>
                    </a>
                </li>

                <!-- Pembayaran -->
                <li class="nav-item">
                    <a class="nav-link" href="/pembayaran">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>

                <!-- Pengajuan Bantuan -->
                <li class="nav-item">
                    <a class="nav-link" href="/pendaftaran">
                        <i class="fas fa-file-signature"></i>
                        <span>Pengajuan Bantuan</span>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                        aria-controls="collapseForm">
                        <i class="fas fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/laporan/pembayaran-zis"><i class="fas fa-file-invoice-dollar"></i> Pembayaran ZIS</a>
                            <a class="collapse-item" href="/laporan/bantuan"><i class="fas fa-people-carry"></i> Penerima Bantuan</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (session('akses') == 'mustahik'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/mustahik/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mustahik/biodata">
                        <i class="fas fa-id-card"></i>
                        <span>Biodata</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/mustahik/pengajuan">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Pengajuan Bantuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mustahik/pembayaran">
                        <i class="fas fa-donate"></i>
                        <span>Pembayaran ZIS</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (session('akses') == 'muzaki'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/muzaki/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/muzaki/biodata">
                        <i class="fas fa-id-card"></i>
                        <span>Biodata</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/muzaki/pembayaran">
                        <i class="fas fa-donate"></i>
                        <span>Pembayaran ZIS</span>
                    </a>
                </li>

            <?php endif; ?>
            <?php if (session('akses') == 'petugas'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pendaftaran">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Pengajuan Bantuan</span>
                    </a>
                </li>
            <?php endif; ?>

            <hr class="sidebar-divider">
        </ul>