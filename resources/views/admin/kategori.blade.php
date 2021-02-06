@extends('layouts/master_layout')


@section('body')
@if (Auth::check())
  @include('layouts.master_navbar')
@endif
<br>
<div class="row justify-content-center">
    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Tambah kategori
    </button>
</div>
<br>
<div class="row">
<div class=" col-lg-6 center-block">
<table class="table table-striped table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kategori</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($kategori as $k)
    <tr>
      <td>{{$loop->index+1}}</td>
      <td>{{$k->nama}}</td>
      <td>
      <a class="btn btn-sm btn-danger" href="" 
                      data-toggle="modal" data-target="#hapus{{$k->id}}">hapus</a>
      <a class="btn btn-sm btn-warning" href="" 
                      data-toggle="modal" data-target="#edit{{$k->id}}">edit</a>                      
        <!-- Modal hapus -->
        <div class="modal fade" id="hapus{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Apakah anda yakin ingin menghapus ? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kategori : {{$k->nama}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{Route('kategori.delete') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$k->id}}">
                    <button type="submit" class="btn btn-Danger">Ya</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- end modal hapus -->
        <div class="modal fade" id="edit{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                Masukkan nama kategori baru !!
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{Route('kategori.update')}}" method="post">
                    @csrf
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="hidden" value="{{$k->id}}" name="id">
                        <input class="form-control" type="text" value="{{$k->nama}}" name="nama">
                    </div>
                        <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
      </td>
    </tr>
    @endforeach
    <tr>
        <form class="form-control" action="{{Route('kategori.create')}}" method="post">
            @csrf
            <td colspan="3">
                <div class="collapse" id="collapseExample">
                    <div class="form-group">
                        <input calss="form-control" type="text" name="nama" id="nama">
                        <button type="submit" class="btn btn-primary btn-sm">Go</button>
                    </div>
                </div>
            </td>
        </form>
    </tr>
  </tbody>
</table>
</div>
</div>
@endsection