<!-- Navbar Start -->
<div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
            <a href="/" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-primary"><span class="text-white font-weight-normal">MPI</span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <ul class="navbar-nav mr-auto py-0">
                    <?php helper('url'); // Load the URL Helper if not already loaded ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/') ?>" data-page="pengumuman" class="nav-link <?= current_url() === base_url('/') ? 'active' : '' ?>">Pengumuman</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('/member') ?>" data-page="member" class="nav-link <?= current_url() === base_url('/member') ? 'active' : '' ?>" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data Member
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?= base_url('/member') ?>" class="nav-link <?= current_url() === base_url('/member') ? 'active' : '' ?>">Data Member</a>
                                <?php foreach ($dpd as $wilayah) : ?>
                                    <a class="dropdown-item" href="<?= base_url("/member/{$wilayah->id_dpd}") ?>" class="nav-link <?= current_url() === base_url("/member/{$wilayah->id_dpd}") ? 'active' : '' ?>">
                                        <?= $wilayah->nama_dpd ?>
                                    </a>
                                <?php endforeach; ?>
                        </div>
                    </li>
                    <?php $userRole = session()->get('role'); ?>
                    <!-- Jika User -->
                    <?php if ($userRole === 'admin') : ?>
                    <!--</li>-->
                    <li class="nav-item">
                        <a href="<?= base_url('/admin') ?>" class="nav-link">Admin</a>
                    </li>
                    <?php endif; ?>
                    <!-- Dropdown Mobile-->
                    <li class="nav-item dropdown d-block d-lg-none">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('/profil') ?>" data-page= "profil" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profil
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>">Lihat Profil</a>
                            <a class="dropdown-item" href="<?= base_url('/logout') ?>" class="nav-link <?= current_url() === base_url('/logout') ? 'active' : '' ?>">Logout</a>
                        </div>
                    </li>
                </ul>

                <!-- Tombol Profil dan Dropdown Dekstop-->
                <div class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="<?= base_url('/profil') ?>" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user" style="font-size:38px;color:white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <!-- Isi dropdown Anda di sini -->
                        <a class="dropdown-item" href="<?= base_url('/profil') ?>" data-page= "profil" class="nav-link <?= current_url() === base_url('/profil') ? 'active' : '' ?>">Lihat Profil</a>
                        <a class="dropdown-item" href="<?= base_url('/logout') ?>" data-page= "profil" class="nav-link <?= current_url() === base_url('/logout') ? 'active' : '' ?>">Logout</a>
                    </div>
                </div>

            </div>
        </nav>
 </div>
<!-- Navbar End -->