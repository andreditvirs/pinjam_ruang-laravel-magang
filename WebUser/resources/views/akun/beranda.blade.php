@extends('layouts.app')

@section('content')
@include('inc.navberanda')
        <!-- Masthead-->
        <br>
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="container">
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6">
                        <img class="img-fluid" src="assets/img/profilpolos.jpeg" alt="" /></div>
                        <div class="col-lg-6">
                        <div class="bg-darkblue text-center h-100">
                            <!-- <button type="button" class="bg-transparent text-white-50 text-lg-right ">Edit</button> -->
                            <div class="d-flex h-100">
                                <div class="w-100 my-auto text-center text-lg-left">
                                    
                                    <h4 class="pl-5 text-white mx-auto">{{ Cookie::get('nama') }}</h4>
                                    <h4 class="pl-5 text-white">{{ Cookie::get('nip') }}</h4>
                                    <p class="pl-5 mb-0 text-white-50">{{ Cookie::get('jabatan') }}</p>
                                    <p class="pl-5 mb-0 text-white-50">{{ Cookie::get('bidang') }}</p>
                                    <hr class="d-none d-lg-block mb-5 ml-0" />
                                        <button type="button" class="btn  btn-info bg-birumuda text-center col-lg-5 ml-5">Pinjam Ruangan</button>
                                        <button type="button" class="btn  btn-info bg-toska text-center col-lg-5">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </header>

        <section class="projects-section bg-light pt-5 pb-5" id="projects">
            <div class="container">
                <!-- Featured Project Row-->
                <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/building 2.png" alt="" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Dinas Komunikasi dan Informatika Jawa Timur</h4>
                            <p class="text-black-50 mb-0">Dinas Komunikasi dan Informatika Jawa Timur</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="Jadwal-section bg-light" id="Jadwal">
            <br><br><label for="" style="align-items: center; font-size: 32px"> Jadwal</label><br><br>
            <div class="container">
                <div class="row align-content-center">
                    <div class="col-sm-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Nama Ruangan: </h5>
                          <p class="card-text">Tanggal Peminjaman: </p>
                          <a href="#" class="btn btn-outline-info">Unduh Surat Izin</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Nama Ruangan: </h5>
                            <p class="card-text">Tanggal Peminjaman: </p>
                            <a href="#" class="btn btn-outline-info">Unduh Surat Izin</a>
                          </div>
                        </div>
                      </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nama Ruangan: </h5>
                            <p class="card-text">Tanggal Peminjaman: </p>
                            <a href="#" class="btn btn-outline-info">Unduh Surat Izin</a>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <br>
        </section>

        <!-- Projects-->
        <section class="projects-section bg-light pt-5 pb-5" id="projects">
            <div class="container">
                <!-- Project One Row-->
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/building 7.png" alt="" /></div>
                    <div class="col-lg-6">
                        <div class="bg-darkblue text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Ruang Aula</h4>
                                    <p class="mb-0 text-white-50">Kapasitas : </p>
                                    <!-- <a href="Akun/indexLogin.html" class="text-white-50" >Selengkapnya &rarr;</a>  -->
                                    <a href="#" class="text-white-50"  data-toggle="modal" data-target=".bd-example-modal-lg1" >Selengkapnya &rarr;</a> 
                                    <hr class="d-none d-lg-block mb-0 ml-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="row">
                                <div class="d-lg-block">
                                    <h1 class="text-center">Detail ruangan</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 p-5">
                                            <div><img src="assets/img/building 6.png" alt="Image" class="img-fluid"></div>
                                        
                                        </div>
                                        <div class="col-lg-7 pl-lg-10 ml-3">
                                            <div class="mb-5 text-lg-left">
                                                <h3 class="text-black mb-4">Ruang Aula</h3>
                                                <p>Lokasi : lantai 2</p>
                                                <p>Fasilitas :</p>
                                                <li>AC</li>
                                                <li>Proyektor</li>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Project Two Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/building 7.png" alt="" /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-darkblue text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Ruang Smart Province</h4>
                                    <p class="mb-0 text-white-50">Kapasitas : </p>
                                    <!-- <a href="Akun/indexLogin.html" class="text-white-50" >Selengkapnya &rarr;</a>  -->
                                    <a href="#" class="text-white-50"  data-toggle="modal" data-target=".bd-example-modal-lg2" >Selengkapnya &rarr;</a> 
                                    <hr class="d-none d-lg-block mb-0 mr-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="row">
                                <div class="d-lg-block">
                                    <h1 class="text-center">Detail ruangan</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 p-5">
                                            <div><img src="assets/img/building 6.png" alt="Image" class="img-fluid"></div>
                                        
                                        </div>
                                        <div class="col-lg-7 pl-lg-5 ml-3">
                                            <div class="mb-5 text-lg-left">
                                                <h3 class="text-black mb-4">Ruang Smart Province</h3>
                                                <p>Lokasi : lantai 2</p>
                                                <p>Fasilitas :</p>
                                                <li>AC</li>
                                                <li>Proyektor</li>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Project Three Row-->
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/building 7.png" alt="" /></div>
                    <div class="col-lg-6">
                        <div class="bg-darkblue text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Ruang Rapat Kadis</h4>
                                    <p class="mb-0 text-white-50">Kapasitas : </p>
                                    <!-- <a href="Akun/indexLogin.html" class="text-white-50" >Selengkapnya &rarr;</a>  -->
                                    <a href="#" class="text-white-50"  data-toggle="modal" data-target=".bd-example-modal-lg3" >Selengkapnya &rarr;</a> 
                                    <hr class="d-none d-lg-block mb-0 ml-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="row">
                                <div class="d-lg-block">
                                    <h1 class="text-center">Detail ruangan</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 p-5">
                                            <div><img src="assets/img/building 6.png" alt="Image" class="img-fluid"></div>
                                        
                                        </div>
                                        <div class="col-lg-7 pl-lg-5 ml-3">
                                            <div class="mb-5 text-lg-left">
                                                <h3 class="text-black mb-4">Ruang Rapat Kadis</h3>
                                                <p>Lokasi : lantai 2</p>
                                                <p>Fasilitas :</p>
                                                <li>AC</li>
                                                <li>Proyektor</li>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Project four Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/building 7.png" alt="" /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-darkblue text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Ruang Komando</h4>
                                    <p class="mb-0 text-white-50">Kapasitas : </p>
                                    <a href="#" class="text-white-50"  data-toggle="modal" data-target=".bd-example-modal-lg4" >Selengkapnya &rarr;</a> 
                                    
                                    <hr class="d-none d-lg-block mb-0 mr-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="row">
                                <div class="d-lg-block">
                                    <h1 class="text-center">Detail ruangan</h1>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-4 p-5">
                                            <div><img src="assets/img/building 6.png" alt="Image" class="img-fluid"></div>
                                        
                                        </div>
                                        <div class="col-lg-7 pl-lg-5 ml-3">
                                            <div class="mb-5 text-lg-left">
                                                <h3 class="text-black mb-4">Ruang Komando</h3>
                                                <p>Lokasi : lantai 2</p>
                                                <p>Fasilitas :</p>
                                                <li>AC</li>
                                                <li>Proyektor</li>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project Five Row-->
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6"><img class="img-fluid" src="assets/img/building 7.png" alt="" /></div>
                    <div class="col-lg-6">
                        <div class="bg-darkblue text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Ruang Workshop</h4>
                                    <p class="mb-0 text-white-50">Kapasitas : </p>
                                    <!-- <a href="Akun/indexLogin.html" class="text-white-50" >Selengkapnya &rarr;</a>  -->
                                    <a href="#" class="text-white-50"  data-toggle="modal" data-target=".bd-example-modal-lg5" >Selengkapnya &rarr;</a> 
                                    <hr class="d-none d-lg-block mb-0 ml-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="row">
                            <div class="d-lg-block">
                                <h1 class="text-center">Detail ruangan</h1>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 p-5">
                                        <div><img src="assets/img/building 6.png" alt="Image" class="img-fluid"></div>
                                        
                                    </div>
                                    <div class="col-lg-7 pl-lg-5 ml-3">
                                        <div class="mb-5 text-lg-left">
                                            <h3 class="text-black mb-4 text-lg-left">Ruang Workshop</h3>
                                            <p class="text-lg-left">Lokasi : lantai 2</p>
                                            <p class="text-lg-left"> Fasilitas :</p>
                                            <li class="text-lg-left">AC</li>
                                            <li class="text-lg-left">Proyektor</li>
                                            
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@include('inc.contactsection')
        
@endsection