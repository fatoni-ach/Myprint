@extends('layouts/newmaster_layout')
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/> -->

@section('body')
    @if (Auth::check())
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="col-md-8 d-inline-block text-center" style="">
            @include('layouts.newmaster_navbar')
        </div>      
    </section>
    @else
    <section class="d-flex justify-content-center mb-2 fixed-top" style="background-color: none">
        <div class="width-mobile " style="">
            <nav class="navbar navbar-light bg-light" style="with:100%;">
                <span class="navbar-brand mb-0 h1">Myprint</span>
            </nav>
        </div>      
    </section>
    @endif

    <!-- Slickity Slider  -->
    @if ($promo->count() > 0 )
    <section class="d-flex justify-content-center my-2" style="background-color: none; margin-top:60px !important;">
        <div class="width-mobile" style="">
            <div class="carousel" data-flickity='{ "lazyLoad": true, "autoPlay": true ,  "autoPlay": 3500 , "lazyLoad": 1, "wrapAround": true, "cellSelector": ".carousel-cell" }'>
                @foreach ($promo as $pm)
                <div class="carousel-cell">
                    <a href="{{Route('show', $produk_all->find($pm->produk_id)->slug)}}" >
                        <img class="carousel-cell-image carousel-cell-custom" data-flickity-lazyload="{{Asset($pm->takeImage())}}" />
                    </a>
                </div>
                @endforeach
            </div>      
        </div>
    </section>
    @endif
    <!-- Profil -->
    <!-- <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile d-flex justify-content-center">
            <a href="{{Route('produk')}}">
            @if(isset($profil))
            <img class="rounded-circle profil" src="{{Asset($profil->takeImage())}}" alt="Profil" srcset="">
            @else
            <img class="rounded-circle profil" src="{{Asset('storage/images/profil.png')}}" alt="Belum ada Profil" srcset="">
            @endif
            </a>
        </div>
    </section>
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile">
            <h5 class="text-center my-0 text-nama" >{{$profil->nama ?? "MyPrint Advertising"}}</h5>
            <p class="text-center my-0 text-alamat">{{$profil->alamat ?? "Surabaya"}}</p>
        </div>
    </section> -->
    <!-- end profil -->
    <!-- pencarian -->
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile">
            <form action="{{Route('search.produk')}}" method="get">
                <div class="input-group px-3">
                    <input @if(isset($search)) value="{{$search}}" @endif name="search" type="text" class="form-control form-control-sm" placeholder="cari produk" aria-label="mencari" aria-describedby="basic-addon2">
                    <div class="">
                      <button class="btn btn-primary btn-sm" type="submit">Go</button>
                    </div>
                  </div>
            </form>
        </div>
    </section>
    <!-- end pencarian -->
    <!-- kategori && sort -->
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile px-3">
            <div class="d-flex justify-content-between">
                <section>
                    @forelse ($kategori as $k)
                        @if($loop->index == 0)
                        <a href="{{Route('produk')}}" class="btn btn-category 
                        @if(!isset($k_aktif))
                            btn-category-selected 
                        @endif">All</a>
                        @endif
                        @if($sorted != null)
                        <form action="{{Route('produk.kategori.sort', $k->id)}}" method="get" style="display:inline-block;">
                        <input type="hidden" name="sort" value="{{$sorted}}" id="">
                        <button type="submit" class="btn btn-category 
                            @if(isset($k_aktif)  && $k_aktif->nama == $k->nama) 
                                btn-category-selected 
                            @endif">{{$k->nama}}</button>
                        </form>
                        @else
                        <a href="{{Route('produk.kategori', $k->id)}}" class="btn btn-category 
                            @if(isset($k_aktif)  && $k_aktif->nama == $k->nama) 
                                btn-category-selected 
                            @endif">{{$k->nama}}</a>
                        @endif
                    @empty
                    <a href="{{Route('produk')}}" class="btn btn-category btn-category-selected">All</a>
                    @endforelse
                </section>
                <section>
                    <a class="btn p-0 m-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="btn-sort ml-2" src="{{Asset('storage/images/sort.png')}}" alt="">
                    </a>
                    <div class="dropdown-menu p-2 " style="border-radius: 5px;">
                        <form style="display:inline-block;"
                            @if(isset($k_aktif))
                            action="{{route('produk.kategori.sort', $k_aktif->id)}}"
                            @else
                            action="{{route('produk.sort')}}" 
                            @endif 
                            method="get">
                            <input type="hidden" name="sort" value="terbaru" id="">
                            <button class="btn btn-category btn-sm 
                            @if($sorted != null && $sorted == 'terbaru')
                            btn-category-selected
                            @endif" id="terbaruButton" type="submit">terbaru</button>
                        </form>
                        <form style="display:inline-block;"
                            @if(isset($k_aktif))
                            action="{{route('produk.kategori.sort', $k_aktif->id)}}"
                            @else
                            action="{{route('produk.sort')}}" 
                            @endif 
                            method="get">
                            <input type="hidden" name="sort" value="terlama" id="">
                            <button class="btn btn-category btn-sm 
                            @if($sorted != null && $sorted == 'terlama')
                            btn-category-selected
                            @endif" type="submit">terlama</button>
                        </form>
                        <form style="display:inline-block;"
                            @if(isset($k_aktif))
                            action="{{route('produk.kategori.sort', $k_aktif->id)}}"
                            @else
                            action="{{route('produk.sort')}}" 
                            @endif 
                            method="get">
                            <input type="hidden" name="sort" value="termurah" id="">
                            <button class="btn btn-category btn-sm
                            @if($sorted != null && $sorted == 'termurah')
                            btn-category-selected
                            @endif" type="submit">termurah</button>
                        </form>
                        <form style="display:inline-block;"
                            @if(isset($k_aktif))
                            action="{{route('produk.kategori.sort', $k_aktif->id)}}"
                            @else
                            action="{{route('produk.sort')}}" 
                            @endif 
                            method="get">
                            <input type="hidden" name="sort" value="termahal" id="">
                            <button class="btn btn-category btn-sm 
                            @if($sorted != null && $sorted == 'termahal')
                            btn-category-selected
                            @endif" type="submit">termahal</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- end category && sort -->
    <!-- body produk -->
    <section class="d-flex justify-content-center my-2 pt-2" style="background-color: none">
        <div class="width-mobile">
            <div class="row no-gutters">
                @forelse($produk as $p)
                <div class="col-4 p-1">
                    <div class="card">
                        <a href="{{Route('show', $p->slug)}}">
                            <img class="card-img-top border-bottom" src="{{Asset($p->gambar_produks()->get()->first()->takeImage())}}" alt="Card image cap">
                            <div class="card-body px-3 py-2">
                                <h5 class="card-title mb-0">{{$p->nama}}</h5>
                            </div>
                            <div class="card-footer px-3 py-1 ">
                                <p class="card-price mb-0 text-center">Rp.  {{number_format($p->harga,0,',','.')}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12  p-1 bg-warning rounded">
                    <p class=" text-center text-secondary pt-2">Belum ada produk</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- end body produk -->
    <br>
    <!-- pagination -->
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                {{$produk->links()}}
                </ul>
              </nav>
        </div>
    </section>
    <!-- end pagination -->
    <br>
    <!-- social media -->
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        @if(isset($profil))
        <div class="width-mobile d-flex justify-content-center">
            @if($profil->instagram != "")
            <a href="{{$profil->instagram}}" >
                <img class="social-media mx-3" src="{{asset('storage/images/instagram.png')}}" ></img>
            </a>
            @endif
            @if($profil->facebook != "")
            <a href="{{$profil->facebook}}" >
                <img class="social-media mx-3" src="{{asset('storage/images/facebook.png')}}" ></img>
            </a>
            @endif
        </div>
        @endif
    </section>
    <!-- end social media -->
    <!-- button wa -->
    @if(isset($profil))
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile d-flex justify-content-end pr-4">
            <a href="https://api.whatsapp.com/send?phone={{$profil->no_wa}}" class="float">
                <img src="{{asset('storage/images/wa.png')}}" class="fa fa-plus my-float"></img>
            </a>
        </div>
    </section>
    @endif
    <!-- end button wa -->
    <br>
@endsection

@section('script')
@endsection


