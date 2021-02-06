@extends('layouts/master_layout')


@section('body')
@if (Auth::check())
  @include('layouts.master_navbar')
@endif
<br>
<div class="row justify-content-center">
    <a href="{{Route('create.produk')}}" class="btn btn-primary btn-sm">tambah produk</a>
</div>

<br>
<!-- colomn Searching -->
<div class="col-lg-6 center-block">
  <form action="{{Route('search.produk.admin')}}" method="get">
  <div class="input-group mb-3 ">
      <div class="input-group-prepend ">
          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $k_aktif->nama ?? "...." }}</button>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="{{Route('produk.admin')}}">semua kategori</a>
              @forelse ($kategori as $k)
              <a class="dropdown-item" href="{{Route('produk.kategori.admin', $k->id)}}">{{$k->nama}}</a>
              @empty
              <a class="dropdown-item" href="">Belum ada kategori</a>
              @endforelse
          </div>
      </div>
            <input @if(isset($search)) value="{{$search}}" @endif name="search" type="text" class="form-control" aria-label="Text input with dropdown button">
            <button class="btn btn-primary btn-sm" type="submit">Go</button>
          </div>
        </div>
      </form>
<!-- end colomn searching -->

<!-- list produk -->
<div class="row center-block">
  <div class="card-group col-lg-8 center-block">
      @foreach($produk as $p)
      <a href="{{Route('show.produk', $p->slug)}}">
      <div class="col-lg-4 card-small card-tall">
          <div class="card card-admin">
              <img class="card-img-top" src="{{Asset($p->gambar_produks()->get()->first()->takeImage())}}" alt="Card image cap">
              <hr class="minim">
              <div class="card-body">
                  <h5 class="card-title">{{$p->nama}} </h5>
                  <p class="card-text text-bold">Rp. {{$p->harga}}</p>
                  <a class="btn btn-sm btn-danger" href="" 
                      data-toggle="modal" data-target="#{{$p->slug}}">hapus</a>
                  <a class="btn btn-sm btn-warning" href="{{Route('edit.produk', $p->slug)}}">Edit</a>
                  <button class="btn btn-sm btn-primary" @if( $p->promo()->count() > 0 ) disabled @endif
                      data-toggle="modal" data-target="#promo{{$p->slug}}">tambah promo</button>
              </div>
          </div>
      </div>
      </a>
      <!-- Modal hapus -->
        <div class="modal fade" id="{{$p->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin ingin menghapus ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Judul : {{$p->nama}}</p>
                <p>harga : {{$p->harga}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{Route('delete.produk', $p->slug)}}" type="button" class="btn btn-Danger">Ya</a>
            </div>
            </div>
        </div>
        </div>
      <!-- end modal hapus -->
      <!-- modal promo -->
      <div class="modal fade" id="promo{{$p->slug}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Promo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('promo.create')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="card">
                    <form action="" method="post" enctype="multipart/form-data">
                      @csrf
                      <h5 class = "card-deskripsi align-left" for="gambar">upload gambar </h5>
                      <input class="form-control-file" type="file" name="gambar" id="gambar">
                      <h5 class = "card-deskripsi" for="produk_id">produk </h5>
                      <input class="form-control" type="hidden" name="produk_id" id="produk_id" value="{{$p->id}}">
                      <p class="card-deskripsi-normal" >{{$p->nama}}</p>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button href="{{Route('promo.create')}}" type="submit" class="btn btn-primary">OK</button>
                    </form>
                </div>
            </form>
            </div>
        </div>
      </div>
      <!-- end modal promo -->
      @endforeach
  </div>
</div>
<!-- end list produk -->

<!-- pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm justify-content-center">
    {{$produk->links()}}
  </ul>
</nav>
<!-- end pagination -->

<!-- floating button -->

<!-- end floating button -->
<br>
<br>
@endsection