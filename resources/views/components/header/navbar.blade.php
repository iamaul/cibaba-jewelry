<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Cibaba Jewelry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	            <li class="nav-item {{ isNavActive(['/']) }}"><a href="/" class="nav-link">Home</a></li>
	            <li class="nav-item {{ isNavActive(['/catalog']) }} dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="dropdown04"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        Catalog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        {{-- <a class="dropdown-item" href="#">See All</a> --}}
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                    </div>
                </li>
                {{-- <li class="nav-item {{ isNavActive(['/catalog']) }}"><a href="/catalog" class="nav-link">Catalog</a></li> --}}
                <li class="nav-item {{ isNavActive(['/promo']) }}"><a href="/promo" class="nav-link">Promo</a></li>
                {{-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> --}}
                {{-- <li class="nav-item {{ isNavActive(['/contact']) }}"><a href="/contact" class="nav-link">Contact</a></li> --}}
                {{-- <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li> --}}
	        </ul>
        </div>
    </div>
</nav>
