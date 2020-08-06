<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Diskominfo JATIM - Pinjam Ruangan</title>
        <link rel="icon" type="image/png" href="assets/img/LOGO.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">DISKOMINFO JATIM</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ URL::to('register')}}">DAFTAR</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Tentang</a></li>
                        <!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Ruangan</a></li> -->
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">DISKOMINFO<br> JAWA TIMUR</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Peminjaman Ruangan</h2>
                <a class="btn btn-primary js-scroll-trigger" href="{{ URL::to('login')}}">Masuk</a>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-white mb-4">Peminjaman Ruangan</h2>
                        <p class="text-white-50">
                            Dikelola oleh Dinas Komunikasi dan Informatika Jawa Timur
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="assets/img/ipadSplashscreen.png" alt="ipadSplashscreen" />
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-darkblue" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Alamat</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">Jl. Ahmad Yani No.242-244, Gayungan, Kec. Gayungan, Kota SBY, Jawa Timur 60235</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">E-mail</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="#!">kominfo@jatimprov.go.id</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Telpon</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">(031) 8294608</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-3" href="https://twitter.com/KominfoJatim"><i class="fab fa-twitter"></i></a>
                    <a class="mx-3" href="https://www.facebook.com/Diskominfo-Jatim-124046024615458/?__xts__[0]=68.ARB5MkYcgEtQGpEXtrQyD3UbKP-PcmeJ3P5fX9J9f8bQ3qzrPARnOIwS0XDzW9Ho8ViVI-totwrSATCmuO3M_eDx9nMcL-x8dQRae_iAjbyOAlt-ykgQpif1PZcxVHCoSzwwswOZyogoEJxikfDCT2S4hpcAFef5cNMfdWEywrnmT2JoxP6yHvaPG3L4yjr7XYFV9PwMYySC4DzfEbv2RDPFpgzYn0UwTpUqHUwBxI4fksBhjvkuqx2HCEOs7heVG2Yrtuhe8ESeFaqmdDAYthrOPqoFWT-VKft6Wt-RE0P75Vi28TsjKaUINKh2vkRVjNII4evYi5G9J3xIIp4SRxE&__xts__[1]=68.ARBgkFWYufORl5a73N5yXDofPRHsiSCa0oQvyGXl2EOVQajky-Ica6BB-465Ilxg3Y5Y19HjeM0CDjEgYLpCxqqQbf2VfL-50Kr3Lzpb2a8TeT_XeBZr5TPEgSxGr50uORL-pjltJ1nOz5uN7sVhubDSw96yu4y39yofkZsVhvJY2Mt_Dj0G9qmOLu48XxV988ZqKP7iAlQEPQOryT2ju74q175l_FYoQjjMrjU92Dx21ODNigbCuGHZ04ZLl4WjmWLZEH3SDuaTTUx7T1tkEzAnKuHLEETdsHVq9BDEQLwpVnAWCNjGPf5sfzhSdM9WyFMopXxrHkewS_3tNwUgqhM"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-3" href="https://www.instagram.com/kemenkominfo/?hl=id"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-darkblue small text-center text-white-50"><div class="container">Copyright © DISKOMINFO JAWA TIMUR 2020</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
