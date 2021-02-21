@extends('layouts/master_layout')
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/> -->

@section('body')

@if (Auth::check())
  @include('layouts.master_navbar')
@endif
@if ($promo->count() > 0 )
    <!--<div class="">-->
    <div class="carousel col-lg-8 center-block" data-flickity='{ "lazyLoad": true, "autoPlay": true,"wrapAround": true, "autoPlay": 3500 , "pauseAutoPlayOnHover": false, "resize": false}'>
    @foreach ($promo as $pm)
    <div class="carousel-cell">
        <a href="{{Route('show', $produk_all->find($pm->produk_id)->slug)}}" type="submit">
            <img class="carousel-cell-image" data-flickity-lazyload="{{Asset($pm->takeImage())}}" alt="First slide">
        </a>
    </div>
    @endforeach
    </div>
    <!--</div>-->
@endif
<!-- slider -->
<div class="carousel-full">
<div id="carouselExampleIndicators" class="col-lg-8 center-block" data-interval="3500" data-ride="carousel">
    @if ($promo->count() > 0 )
    <!--<ol class="carousel-indicators">-->
    <!--  @foreach ($promo as $pm)-->
    <!--  <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" -->
    <!--    @if($loop->index == 0) class="active" @endif >-->
    <!--  </li>-->
    <!--  @endforeach-->
    <!--</ol>-->
    <!--<div class="inner-custom">-->
    <!--  @foreach ($promo as $pm)-->
    <!--  <div -->
    <!--    @if($loop->index == 0) class="carousel-item active" @else class="carousel-item" @endif>-->
    <!--    <a href="{{Route('show', $produk_all->find($pm->produk_id)->slug)}}" type="submit">-->
    <!--      <img class="center-block  w-100" src="{{Asset($pm->takeImage())}}" alt="First slide">-->
    <!--    </a>-->
    <!--  </div>-->
    <!--  @endforeach-->
    <!--</div>-->
    <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
    <!--  <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
    <!--  <span class="sr-only">Previous</span>-->
    <!--</a>-->
    <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
    <!--  <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
    <!--  <span class="sr-only">Next</span>-->
    <!--</a>-->
    

    @else
    <!-- <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="center-block w-100" src="img/slider_1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="center-block w-100" src="img/slider_2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="center-block w-100" src="img/slider_3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> -->
    <br>
  @endif
  
</div>
<!-- end slider -->
<!-- profil -->
<div class="row profil">
  <div class="col-5">
      @if(isset($profil))
      <img class="circle img-fluid" src="{{Asset($profil->takeImage())}}" alt="">
      @else
      <img class="circle img-fluid" src="{{Asset('storage/images/profil.png')}}" alt="">
      @endif
  </div>
  <div class="col-7">
      <h5 class="">{{$profil->nama ?? "MyPrint Advertising"}}</h5>
      <p class="">{{$profil->alamat ?? "Jl Kapasan Gubeng, Surabaya"}}</p>
  </div>
</div>
</div>
<!-- end profil -->
<hr>
<!-- colomn Searching -->
<div class="col-lg-6 center-block">
  <form action="{{Route('search.produk')}}" method="get">
  <div class="input-group mb-3 ">
      <div class="input-group-prepend ">
          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $k_aktif->nama ?? "...." }}</button>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="{{Route('produk')}}">semua kategori</a>
              @forelse ($kategori as $k)
              <a class="dropdown-item" href="{{Route('produk.kategori', $k->id)}}">{{$k->nama}}</a>
              @empty
              <a class="dropdown-item" href="">Belum ada kategori</a>
              @endforelse
          </div>
      </div>
        <input @if(isset($search)) value="{{$search}}" @endif name="search" type="text" class="form-control" aria-label="Text input with dropdown button">
        <button class="btn btn-primary btn-sm" type="submit">Go</button>
  </div>
  </form>
</div>
<!-- end colomn searching -->

<!-- sort -->
<div class="col-lg-8 row center-block">
  <div class="col">
    <h4 class="text-sort">&middot {{ $k_aktif->nama ?? "All" }} </h4>
  </div>
  <div class="col">
    <!-- <a class="btn-sort" id="meddelanden" data-toggle="clickover" 
            data-placement="bottom"> 
      <img class="img-sort" src="{{asset('storage/images/sort.png')}}" alt=""> -->
      <a class="btn-sort" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="img-sort" src="{{asset('storage/images/sort.png')}}" alt="">
      </a>
      <div class="dropdown-menu">
        <form 
          @if(isset($k_aktif))
          action="{{route('produk.kategori.sort', $k_aktif->id)}}"
          @else
          action="{{route('produk.sort')}}" 
          @endif 
          method="get">
          <input type="hidden" name="sort" value="terbaru" id="">
          <button role="button" type="submit" class="dropdown-item">Terbaru</button>
        </form>
        <form 
          @if(isset($k_aktif))
          action="{{route('produk.kategori.sort', $k_aktif->id)}}"
          @else
          action="{{route('produk.sort')}}" 
          @endif 
          method="get">
          <input type="hidden" name="sort" value="terlama" id="">
          <button role="button" type="submit" class="dropdown-item">Terlama</button>
        </form>
        <form  @if(isset($k_aktif))
          action="{{route('produk.kategori.sort', $k_aktif->id)}}"
          @else
          action="{{route('produk.sort')}}" 
          @endif  method="get">
          <input type="hidden" name="sort" value="termurah" id="">
          <button role="button" type="submit" class="dropdown-item">Termurah</button>
        </form>
        <form  @if(isset($k_aktif))
          action="{{route('produk.kategori.sort', $k_aktif->id)}}"
          @else
          action="{{route('produk.sort')}}" 
          @endif 
          method="get">
          <input type="hidden" name="sort" value="termahal" id="">
          <button role="button" type="submit" class="dropdown-item">Termahal</button>
        </form>
      </div>
    </a>
  </div>
</div>
<!-- endsort -->

<!-- list produk -->
<div class="row center-block">
  <div class="card-group col-lg-8 center-block">
    @forelse($produk as $p)
    <div class="col-lg-4 card-small card-tall">
          <a class="btn-custom" href="{{Route('show', $p->slug)}}">
            <div class="card">
                <img class="card-img-top" src="{{Asset($p->gambar_produks()->get()->first()->takeImage())}}" alt="Card image cap">
                <hr class="minim">
                <div class="card-body">
                    <h5 class="card-title">{{$p->nama}} </h5>
                    <p class="card-text text-bold">Rp. {{$p->harga}}</p>
                </div>
            </div>
            </a>
        </div>
      @empty
      <div class="container profil">
        <br>
        <p>
          belum ada produk
        </p> 
      </div>
      @endforelse
  </div>
</div>
<!-- end list produk -->
<br>
<!-- pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-sm justify-content-center">
      {{$produk->links()}}
  </ul>
</nav>
<hr>
<!-- end pagination -->

<!-- floating button -->
@if(isset($profil))
<a href="https://api.whatsapp.com/send?phone={{$profil->no_wa}}" class="float">
  <img src="{{asset('storage/images/wa.png')}}" class="fa fa-plus my-float"></img>
</a>
@endif
<!-- end floating button -->

@if(isset($profil))
  <div class="d-flex justify-content-center">
    @if($profil->instagram != "")
    <a href="{{$profil->instagram}}" >
      <img class="social-media" src="{{asset('storage/images/instagram.png')}}" ></img>
    </a>
    @endif
    @if($profil->facebook != "")
    <a href="{{$profil->facebook}}" class="social-media">
      <img class="social-media" src="{{asset('storage/images/facebook.png')}}" ></img>
    </a>
    @endif
  </div>
@endif
<br>
@endsection


@section('script')
<script>
var elem = '<div class="well"><form action="" method="get"><input type="hidden" name="sort" value="terbaru"><a role="button" type="submit" class="btn btn-sm btn-light btn-popover">Terbaru</a></form></div>'+
    '<button id="close-popover" data-toggle="clickover" class="btn btn-small btn-primary pull-right" onclick="$(&quot;#meddelanden&quot;).popover(&quot;hide&quot;);">Close please!</button>';

    // <div>
    //   <form action="" method="get">
    //     <input type="hidden" name="sort" value="terbaru">
    //     <a role="button" type="submit" class="btn btn-sm btn-light btn-popover">Terbaru</a>
    //   </form>
    //   <a href="" class="btn btn-sm btn-light btn-popover">Terlama</a>
    // </div>
    // <div>
    //   <a href="" class="btn btn-sm btn-light btn-popover">Termurah</a>
    //   <a href="" class="btn btn-sm btn-light btn-popover">Termahal</a>
    // </div>

$('#meddelanden').popover({animation:true, content:elem, html:true});
</script>
@endsection