@extends('layouts/master_layout')


@section('body')
@if (Auth::check())
  @include('layouts.master_navbar')
@endif
<div class="row center-block">
    <div class="card-group col-md-8 center-block">
        <div class="col">
            <div class="card">
                @if(isset($profil))
                <img class="card-img-top" src="{{Asset($profil->takeImage())}}" alt="Card image cap">
                <div class="card-body">
                    <form action="{{Route('profil.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group align-left">
                            <label for="gambar">Upload gambar</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="nama">Nama </label>
                            <input type="text" class="form-control" id="nama" value="{{$profil->nama}}" name="nama">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="alamat">Alamat </label>
                            <input type="text" class="form-control" id="alamat" value="{{$profil->alamat}}" name="alamat">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="no_wa">Nomor Wa </label>
                            <input type="number" class="form-control" id="no_wa" value="{{$profil->no_wa}}" name="no_wa">
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
                @else
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group align-left">
                            <label for="gambar">Upload gambar</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="nama">Nama </label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="alamat">Alamat </label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group align-left">
                            <label class="" for="no_wa">Nomor Wa </label>
                            <input type="number" class="form-control" id="no_wa" name="no_wa">
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection