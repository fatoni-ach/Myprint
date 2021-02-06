@extends('layouts/master_layout')

@section('head')
    <meta property="og:title" content="{{$produk->nama}}" >
    <meta property="og:description" content="{{$produk->deskripsi}}" >
    <meta property="og:url" content="{{url()->current()}}" >
    @foreach($produk->gambar_produks()->get() as $g)
    <meta property="og:image:url" content="{{Asset($g->takeImage())}}" >
    @endforeach
    <title>{{$produk->nama}}</title>

@endsection

@section('body')
<!-- produk -->
<div class="row center-block">
    <div class="card-group col-md-8 center-block">
        <div class="col">
            <div class="card">
                <a class="btn btn-light btn-back" href="{{url()->previous()}}"><img src="{{Asset('storage/images/back.png')}}" alt=""></a>
                <!-- carousel  -->
                <div id="carouselExampleIndicators" class="carousel slide" data-interval="3500" data-ride="carousel">
                    <ol class="carousel-indicators">
                    @foreach ($produk->gambar_produks()->get() as $g)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" 
                        @if($loop->index == 0) class="active" @endif >
                    </li>
                    @endforeach
                    </ol>
                    <div class="carousel-inner">
                    @foreach ($produk->gambar_produks()->get() as $g)
                    <div 
                        @if($loop->index == 0) class="carousel-item active" @else class="carousel-item" @endif>
                        <img class="center-block w-100" src="{{Asset($g->takeImage())}}" alt="First slide">
                    </div>
                    @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- end carousel -->
                <div class="card-body">
                    <h5 class="card-title">{{$produk->nama}}</h5>
                    <p class="card-text text-bold">Rp. {{$produk->harga}}</p>
                    <hr>
                    <h5 class="card-deskripsi">Produk Deskripsi : </h5>
                    <p class="card-text">{!! nl2br(e($produk->deskripsi)) !!}
                    </p>
                    <hr>
                            <a href="{{$url_wa}}" class="btn btn-success btn-sm">Pesan via Wa 
                                <img src="{{Asset('storage/images/wa.png')}}" alt=""></a>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
        <!-- end produk -->
@endsection