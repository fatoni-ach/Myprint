@extends('layouts/master_layout')

@section('head')
    <meta property="og:type" content="website" />
    <meta property="og:image" itemprop="image" content="{{Asset($produk->gambar_produks()->get()->first()->takeImage())}}" >
    <meta property="og:image:secure" itemprop="image" content="{{Asset($produk->gambar_produks()->get()->first()->takeImage())}}" >
    <meta property="og:title" content="{{$produk->nama}}" >
    <meta property="og:description" content="{{$produk->deskripsi}}" >
    <meta property="og:url" content="{{url()->current()}}" >
    <title>{{$produk->nama}}</title>

@endsection

@section('body')
<!-- produk -->
<div class="row d-flex justify-content-center">
    <div class="card-group col-md-6 center-block">
        <!--<div class="col">-->
            <div class="card card-custom">
                <a class="btn btn-light btn-back" href="{{Route('produk')}}"><img src="{{Asset('storage/images/back.png')}}" alt=""></a>
                <!-- carousel  -->
                <!--<div id="carouselExampleIndicators" class="carousel slide" data-interval="3500" data-ride="carousel">-->
                <!--    <ol class="carousel-indicators">-->
                <!--    @foreach ($produk->gambar_produks()->get() as $g)-->
                <!--    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" -->
                <!--        @if($loop->index == 0) class="active" @endif >-->
                <!--    </li>-->
                <!--    @endforeach-->
                <!--    </ol>-->
                <!--    <div class="carousel-inner">-->
                <!--    @foreach ($produk->gambar_produks()->get() as $g)-->
                <!--    <div -->
                <!--        @if($loop->index == 0) class="carousel-item active" @else class="carousel-item" @endif>-->
                <!--        <img class="center-block w-100" src="{{Asset($g->takeImage())}}" alt="First slide">-->
                <!--    </div>-->
                <!--    @endforeach-->
                <!--    </div>-->
                <!--    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                <!--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                <!--    <span class="sr-only">Previous</span>-->
                <!--    </a>-->
                <!--    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                <!--    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                <!--    <span class="sr-only">Next</span>-->
                <!--    </a>-->
                <!--</div>-->
                <!-- end carousel -->
                <div class="carousel" data-flickity='{ "lazyLoad": true, "autoPlay": true,"wrapAround": true, "autoPlay": 3500 , "pauseAutoPlayOnHover": false, "resize": false,"fullscreen": true}'>
                    @foreach ($produk->gambar_produks()->get() as $g)
                    <div class="carousel-cell">
                        <img class="carousel-image" data-flickity-lazyload="{{Asset($g->takeImage())}}" alt="Gambar">
                    </div>
                    @endforeach
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$produk->nama}}</h5>
                    <p class="card-title text-bold">Rp. {{$produk->harga}}</p>
                    <hr>
                    <h5 class="card-deskripsi">Produk Deskripsi : </h5>
                    <p class="card-text">{!! nl2br(e($produk->deskripsi)) !!}
                    </p>
                    <hr>
                    @if(isset($profil))
                        <a href="{{$url_wa}}" class="btn btn-success btn-sm">Pesan via Wa 
                            <img src="{{Asset('storage/images/wa.png')}}" alt=""></a>
                    @else
                        <a class="disabled btn btn-success btn-sm">Pesan via Wa 
                                <img src="{{Asset('storage/images/wa.png')}}" alt=""></a>
                    @endif
                    <br>

                </div>
            </div>
        <!--</div>-->
    </div>
</div>
        <!-- end produk -->
@endsection

@section('script')

@endsection