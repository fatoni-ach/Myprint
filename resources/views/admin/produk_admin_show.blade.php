@extends('layouts/master_layout')


@section('body')
@if (Auth::check())
  @include('layouts.master_navbar')
@endif
<!-- produk -->
<div class="row center-block">
    <div class="card-group col-md-8 center-block">
        <div class="col">
            <div class="card">
                <a class="btn btn-light btn-back" href="{{Route('produk.admin')}}"><img src="{{Asset('storage/images/back.png')}}" alt=""></a>
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
                <hr>
                <div class="center-mobile">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahgambar">tambah gambar</button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$produk->nama}}</h5>
                    <p class="card-text text-bold">Rp. {{$produk->harga}}</p>
                    <hr>
                    <h5 class="card-deskripsi">Produk Deskripsi : </h5>
                    <p class="card-text">{!! nl2br(e($produk->deskripsi)) !!}
                    </p>

                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>
        <!-- end produk -->

<!-- modal promo -->
<div class="modal fade" id="tambahgambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{Route('gambar.tambah')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class = "card-deskripsi align-left" for="gambar">upload gambar </h5>
                    <input class="form-control-file" type="file" name="gambar" id="gambar">
                    <input type="hidden" name="produk_id" value="{{$produk->id}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </div>
        </form>
        </div>
    </div>
    </div>
    <!-- end modal promo -->

@endsection