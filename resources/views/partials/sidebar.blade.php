<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.admin') }}" aria-expanded="false"><i
                                data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Data Master</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kelas.index') }}" aria-expanded="false"><i
                                data-feather="tag" class="feather-icon"></i><span class="hide-menu">Data
                                Kelas</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('pengurus.index') }}"
                            aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Pengurus</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('pengasuh.index') }}"
                            aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Pengasuh</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('santri.index') }}" aria-expanded="false"><i
                                data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Data
                                Santri</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('data-kegiatan.index') }}"
                            aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Kegiatan</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('data-pelanggaran.index') }}"
                            aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Pelanggaran</span></a>
                    </li>

                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Info Kegiatan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.hafalan-santri.index') }}"
                            aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Hafalan</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.pelanggaran-santri.index') }}"
                            aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                class="hide-menu">Data
                                Pelanggaran</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('admin.perizinan-pulang.index') }}"
                            aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                class="hide-menu">Data Perizinan
                                Pulang</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Rekapitulasi</span>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                class="hide-menu">Rekapitulasi</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ route('admin.laporan-hafalan.index') }}"
                                    class="sidebar-link"><span class="hide-menu"> Hafalan Santri
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('admin.laporan-pelanggaran.index') }}"
                                    class="sidebar-link"><span class="hide-menu"> Pelanggaran Santri
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ route('admin.laporan-perizinan-pulang.index') }}"
                                    class="sidebar-link"><span class="hide-menu"> Perizinan Santri
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                @elseif (Auth::user()->role === 'pengurus')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.pengurus') }}"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Hafalan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pengurus.hafalan.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Hafalan
                                Santri</span></a>
                    </li>
                    {{-- <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Rekapitulasi</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('kelas.index') }}" aria-expanded="false"><i
                                data-feather="tag" class="feather-icon"></i><span class="hide-menu">Rekapitulasi
                                Hafalan
                            </span></a>
                    </li> --}}
                @elseif (Auth::user()->role === 'pengasuh')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.pengasuh') }}"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Pelanggaran</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pengasuh.pelanggaran.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Pelanggaran
                                Santri</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Perizinan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pengasuh.perizinan-pulang.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Perizinan Santri
                            </span></a>
                    </li>
                    {{-- <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Kelola Rekapitulasi</span>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                class="hide-menu">Rekapitulasi</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                                        class="hide-menu"> Pelanggaran
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                        class="hide-menu"> Perizinan Santri
                                    </span></a>
                            </li>
                        </ul>
                    </li> --}}
                @elseif (Auth::user()->role === 'santri')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('dashboard.santri') }}"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Data Hafalan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('santri.hafalan-saya.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Hafalan
                                Saya</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Data Pelanggaran</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('santri.pelanggaran-saya.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Pelanggaran
                                Saya</span></a>
                    </li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap">
                        <span class="hide-menu">Ajukan Perizinan</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('perizinan-pulang.index') }}"
                            aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                class="hide-menu">Perizinan Pulang
                            </span></a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
