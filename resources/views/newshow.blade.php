@extends('layouts/newmaster_layout')

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
<section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile" style="">
            <div class="card">
                <div class="card-header py-2 card-back">
                    <a class="" href="{{Route('produk')}}" >
                        <i class="fa fa-chevron-left mr-2"></i>
                    </a>
                    Detail
                </div>
                <div class="carousel carousel-main" data-flickity='{ "lazyLoad": true, "lazyLoad": 1, "wrapAround": true, "cellSelector": ".carousel-cell", "fullscreen": true}'>
                    @foreach ($produk->gambar_produks()->get() as $g)
                    <div class="carousel-cell">
                        <img class="carousel-cell-image img-box" id="" data-flickity-lazyload="{{Asset($g->takeImage())}}" />
                    </div>
                    @endforeach
                </div>
                <div class="carousel carousel-nav py-2 px-2" data-flickity='{ "asNavFor": ".carousel-main", "lazyLoad": true, "lazyLoad": 1, "cellSelector": ".carousel-cell", "hash": true, "cellAlign": "left" , "contain": true, "pageDots": false, "prevNextButtons": false}'>
                    @foreach ($produk->gambar_produks()->get() as $g)
                    <div class="carousel-cell mr-1">
                        <img class="carousel-cell-image img-box" id="" data-flickity-lazyload="{{Asset($g->takeImage())}}" />
                    </div>
                    @endforeach
                </div>
                <div class="card-body px-3 py-2">
                    <h5 class="card-title mb-0">{{$produk->nama}}</h5>
                    <p class="card-price mt-1"> Rp. 2.000 - Rp. 2.500 </p>
                    <p class="my-1" style="font-size: 9pt; font-weight: bold;" >Deskripsi</p>
                    <hr class="my-1">
                    <p class="card-deskripsi">{!! nl2br(e($produk->deskripsi)) !!}</p>
                </div>
                <div class="card-footer px-3 py-1 ">
                    @if(isset($profil))
                    <div class="d-flex justify-content-center">
                        <a class="btn-wa px-2 rounded btn btn-sm " href="{{$url_wa}}">
                            Pesan via Whatsapp
                            <img src="{{Asset('storage/images/wa.png')}}" alt="">
                        </a>
                    </div>
                    @else
                    <div class="d-flex justify-content-center">
                        <a class="disabled btn-wa px-2 rounded btn btn-sm " href="">
                            Pesan via Whatsapp
                            <img src="{{Asset('storage/images/wa.png')}}" alt="">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection