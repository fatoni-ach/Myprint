@extends('layouts/master_layout')


@section('body')

@if (Auth::check())
@include('layouts.master_navbar')
@endif
<br>
<!-- <div class="row justify-content-center">
    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#create" aria-expanded="false" aria-controls="collapseExample">
        Tambah Promo
    </button>
</div> -->
<br>
<!-- list promo -->
<div class="row center-block">
    <div class="card-group col-lg-8 center-block">
        @foreach($promo as $p)
        <div class="col-lg-12">
            <div class="card">
                <a href="{{Route('show.produk', $produk->find($p->produk_id)->slug )}}"><img class="card-img-top" src="{{Asset($p->takeImage())}}" alt="Card image cap"></a>
                <div class="card-body">
                    <h5 class="card-title">{{$produk->find($p->produk_id)->nama}} </h5>
                    <a class="btn btn-sm btn-warning" href="" 
                        data-toggle="modal" data-target="#edit{{$p->id}}">ganti gambar</a>
                    <a class="btn btn-sm btn-danger" href="" 
                        data-toggle="modal" data-target="#hapus{{$p->id}}">hapus</a>
                </div>
            </div>
        </div>
    <!-- Modal hapus -->
        <div class="modal fade" id="hapus{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin ingin menghapus ? </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Promo : {{$produk->find($p->produk_id)->nama}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{Route('promo.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$p->id}}">
                        <button type="submit" class="btn btn-Danger">Ya</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- end modal hapus -->
        <!-- modal edit -->
        <div class="modal fade" id="edit{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Promo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{Route('promo.update')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="card">
                        <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5 class = "card-deskripsi align-left" for="gambar">upload gambar </h5>
                        <input class="form-control-file" type="file" name="gambar" id="gambar">
                        <input class="form-control" type="hidden" name="id" id="id" value="{{$p->id}}">
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
        <!-- end modal edit -->
    @endforeach
</div>
</div>
<!-- end list promo -->

<br>
<div class="col-lg-6 center-block">
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin ingin menghapus ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{Route('promo.create')}}" method="post">
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button href="{{Route('promo.create')}}" type="submit" class="btn btn-Danger">OK</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>


@endsection