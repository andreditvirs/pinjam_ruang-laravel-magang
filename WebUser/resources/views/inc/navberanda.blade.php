        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light" id="mainNav">
            <!-- <nav class="navbar fixed-top navbar-light bg-light"></nav> -->
            <div class="container">
                <a class="navbar-brand js-scroll-trigger text-black" href="#page-top">PROFILE</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#profil">Profil</a></li> -->
                        <li class="nav-item"><a class="nav-link js-scroll-trigger text-black" href="#projects">Ruangan</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger text-black" href="#Jadwal">Jadwal</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger text-black" href="#contact">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger text-black" href="#" onclick="document.getElementById('logout').submit();">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav> 