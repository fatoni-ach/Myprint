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
                        <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach($produk->gambar_produks()->get() as $g)
                        <img class="img-thumbail small rounded" src="{{Asset($g->takeImage())}}" alt="Card image cap">
                        <a class="btn btn-sm btn-danger img-mid-img"
                        data-toggle="modal" data-target="#hapus{{$g->id}}">hapus</a>
                        @endforeach
                            <hr>
                            <div class="card-body">
                                <!-- <h5 class = "card-deskripsi" for="gambar">upload gambar </h5>
                                <input class="form-control-file" type="file" name="gambar" id="gambar" value=""> -->
                                <h5 class = "card-deskripsi" for="nama">judul </h5>
                                <input class="form-control" type="text" name="nama" id="nama" value="{{old('nama') ?? $produk->nama}}">
                                <h5 class = "card-deskripsi" for="harga">harga </h5>
                                <input class="form-control" type="number" name="harga" id="harga" value="{{old('harga') ?? $produk->harga}}" >
                                <br>
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                </div>
                                <select name="kategori_id" class="custom-select" id="inputGroupSelect01">
                                    @forelse( $kategori as $a )
                                    @if($produk->kategori_id == $a->id)
                                    <option selected value="{{$a->id}}">{{$a->nama}}</option>
                                    @else
                                    <option value="{{$a->id}}">{{$a->nama}}</option>
                                    @endif
                                    @empty
                                    <option disabled value="">belum ada kategori</option>
                                    @endforelse

                                </select>
                                </div>
                                <hr>
                                <h5 class="card-deskripsi">Produk Deskripsi : </h5>
                                <textarea value="" class="form-control" type="text" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi">{{old('deskripsi') ?? $produk->deskripsi}}</textarea>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end produk -->
        @foreach($produk->gambar_produks()->get() as $g)
        <!-- Modal hapus -->
        <div class="modal fade" id="hapus{{$g->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin ingin menghapus ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="small rounded" src="{{Asset($g->takeImage())}}" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{Route('gambar.delete') }}" method="get">
                    <input type="hidden" name="id" value="{{$g->id}}">
                    <button type="submit" class="btn btn-Danger">Ya</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- end modal hapus gambar -->
        @endforeach
@endsection