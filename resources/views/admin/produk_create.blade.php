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
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <a class="btn btn-light btn-back" href="{{Route('produk.admin')}}"><img src="{{Asset('storage/images/back.png')}}" alt=""></a>
                            <!-- <img class="card-img-top" src="img/produk_1.jpg" alt="Card image cap"> -->
                            <div class="card-body">
                                <h5 class = "card-deskripsi" for="gambar">upload gambar </h5>
                                <input class="form-control-file" type="file" name="gambar" id="gambar">
                                <h5 class = "card-deskripsi" for="nama">judul </h5>
                                <input class="form-control" type="text" name="nama" id="nama" >
                                <h5 class = "card-deskripsi" for="harga">harga </h5>
                                <input class="form-control" type="number" name="harga" id="harga" >
                                <br>
                                <h5 class = "card-deskripsi" for="inputGroupSelect01">kategori </h5>
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <!-- <label class="input-group-text" for="inputGroupSelect01">Kategori</label> -->
                                </div>
                                <select name="kategori" class="custom-select" id="inputGroupSelect01">
                                    <option selected disabled value="">...</option>
                                    @forelse( $kategori as $a )
                                    <option value="{{$a->id}}">{{$a->nama}}</option>
                                    @empty                                 
                                    <option disabled value="">belum ada kategori</option>
                                    @endforelse
                                </select>
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modalCreate" aria-expanded="false" aria-controls="collapseExample">
                                    Tambah kategori
                                </button>
                                </div>
                                <hr>
                                <h5 class="card-deskripsi">Produk Deskripsi : </h5>
                                <textarea class="form-control" type="text" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-primary">simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end produk -->

        <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <form class="form-group" action="{{Route('kategori.create')}}" method="post">
                @csrf
                <label for="nama">Masukkan kategori</label>
                <input calss="form-control" type="text" name="nama" id="nama">
                <button type="submit" class="btn btn-primary btn-sm">Go</button>
            </form>
            </div>
            </div>
        </div>
        </div>
        <div class="modal" id="collapseExample">
            
        </div>
@endsection