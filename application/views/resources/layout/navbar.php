<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Cibaba Jewelry</a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarResponsive" 
            aria-controls="navbarResponsive" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class=
                    "<?php if ($this->uri->segment(1) == "home") echo "nav-item active" ?>"
                >
                    <a class="nav-link" href="<?= base_url('home'); ?>">
                        Home
                    </a>
                </li>
                <li class=
                    "<?php if ($this->uri->segment(1) == "about") echo "nav-item active" ?>"
                >
                    <a class="nav-link" href="<?= base_url('about'); ?>">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>