 <header class="topbar" data-navbarbg="skin6">
     <nav class="navbar top-navbar navbar-expand-md">
         <div class="navbar-header" data-logobg="skin6">
             <!-- This is for the sidebar toggle which is visible on mobile only -->
             <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                     class="ti-menu ti-close"></i></a>
             <!-- ============================================================== -->
             <!-- Logo -->
             <!-- ============================================================== -->
             <div class="navbar-brand">
                 <!-- Logo icon -->
                 <a href="#">
                     <b class="logo-icon">
                         <!-- Dark Logo icon -->
                         <img src="{{ asset('assets/images/logo pondok.png') }}" alt="homepage" class="dark-logo" />
                     </b>
                     <!--End Logo icon -->
                     <!-- Logo text -->
                     <span class="logo-text">
                         <!-- dark Logo text -->
                         <img src="{{ asset('assets/images/nama.png') }}" alt="homepage" class="dark-logo" />
                     </span>
                 </a>
             </div>
             <!-- ============================================================== -->
             <!-- End Logo -->
             <!-- ============================================================== -->
             <!-- ============================================================== -->
             <!-- Toggle which is visible on mobile only -->
             <!-- ============================================================== -->
             <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                 data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                 aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
         </div>
         <!-- ============================================================== -->
         <!-- End Logo -->
         <!-- ============================================================== -->
         <div class="navbar-collapse collapse" id="navbarSupportedContent">

             <ul class="navbar-nav float-left mr-auto ml-3 pl-1">

             </ul>
             <!-- ============================================================== -->
             <!-- Right side toggle and nav items -->
             <!-- ============================================================== -->
             <ul class="navbar-nav float-right">
                 <li class="nav-item dropdown">
                     @php
                         $user = Auth::user();
                         $photo = asset('assets/images/avatar.png'); // default
                         $namaLengkap = 'User';

                         switch ($user->role) {
                             case 'pengurus':
                                 if ($user->pengurus) {
                                     $photo = $user->pengurus->photo
                                         ? asset('storage/' . $user->pengurus->photo)
                                         : $photo;
                                     $namaLengkap = $user->pengurus->nama_lengkap;
                                 }
                                 break;
                             case 'pengasuh':
                                 if ($user->pengasuh) {
                                     $photo = $user->pengasuh->photo
                                         ? asset('storage/' . $user->pengasuh->photo)
                                         : $photo;
                                     $namaLengkap = $user->pengasuh->nama_lengkap;
                                 }
                                 break;
                             case 'santri':
                                 if ($user->santri) {
                                     $photo = $user->santri->photo ? asset('storage/' . $user->santri->photo) : $photo;
                                     $namaLengkap = $user->santri->nama_lengkap;
                                 }
                                 break;
                             case 'admin':
                                 $namaLengkap = 'Admin'; // atau bisa ambil dari field lain kalau ada
                                 break;
                         }
                     @endphp

                     <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false">
                         <img src="{{ $photo }}" alt="user" class="rounded-circle" width="40"
                             height="40" style="object-fit: cover;" />
                         <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span>
                             <span class="text-dark">{{ $namaLengkap }}</span>
                             <i data-feather="chevron-down" class="svg-icon"></i>
                         </span>
                     </a>

                     <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <button type="submit" class="dropdown-item text-danger py-3"
                                 style="background: none; border: none; padding: 0; width: 100%; text-align: left;">
                                 <i data-feather="power" class="svg-icon ml-4"></i> Logout
                             </button>
                         </form>

                     </div>
                 </li>

             </ul>
         </div>
     </nav>
 </header>
