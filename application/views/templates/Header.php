 <!DOCTYPE html>
 <html lang="en">

 <head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">

     <title><?= $judul_page; ?></title>

     <!-- Custom fonts for this template-->
     <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

     <!-- Custom styles for this template-->
     <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

 </head>

 <body class="bg-gradient-light">
     <!-- Page Wrapper -->
     <div id="wrapper">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">

             <!-- Main Content -->
             <div id="content">

                 <!-- Topbar -->
                 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                     <!-- Topbar Search -->
                     <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                         <div class="input-group">
                             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                             <div class="input-group-append">
                                 <button class="btn btn-primary" type="button">
                                     <i class="fas fa-search fa-sm"></i>
                                 </button>
                             </div>
                         </div>
                     </form>

                     <!-- Topbar Navbar -->
                     <ul class="navbar-nav ml-auto">
                         <!-- Nav Item - Alerts -->
                         <li class="nav-item dropdown no-arrow mx-1">
                             <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-bell fa-fw"></i>
                                 <!-- Counter - Alerts -->
                                 <span class="badge badge-danger badge-counter">3+</span>
                             </a>
                         </li>

                         <!-- Nav Item - Messages -->
                         <li class="nav-item dropdown no-arrow mx-1">
                             <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-envelope fa-fw"></i>
                                 <!-- Counter - Messages -->
                                 <span class="badge badge-danger badge-counter">7</span>
                             </a>
                         </li>

                         <div class="topbar-divider d-none d-sm-block"></div>

                         <!-- Nav Item - User Information -->
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"> USERNAME </span>
                                 <img class="img-profile rounded-circle" src="https://source.unsplash.com/random/60x60">
                             </a>
                         </li>

                     </ul>

                 </nav>
                 <!-- End of Topbar -->