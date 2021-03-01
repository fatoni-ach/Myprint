
<nav class="navbar navbar-expand-md navbar-dark bg-info d-flex justify-content-between">
    <a class="navbar-brand" href="{{Route('produk')}}">MyPrint Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{Route('produk')}}">Home </a>
            <a class="nav-item nav-link" href="{{Route('produk.admin')}}">Produk</a>
            <a class="nav-item nav-link" href="{{Route('profil')}}">Profil</a>
            <a class="nav-item nav-link" href="{{Route('kategori')}}">Kategori</a>
            <a class="nav-item nav-link" href="#">Unggulan</a>
            <a class="nav-item nav-link" href="{{Route('promo')}}">promo</a>
            <a class="btn btn-danger" href="{{Route('logout')}}">Logout</a>
        </div>
    </div>
</nav>