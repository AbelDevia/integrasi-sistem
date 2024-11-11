<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <h1>SIPAKAM</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('homepage') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('informasi') }}"
                                class="{{ Request::is('informasi') ? 'active' : '' }}">Informasi</a></li>
                        <li><a href="{{ route('metode') }}"
                                class="{{ Request::is('metode') ? 'active' : '' }}">Metode</a></li>
                        <li><a href="{{ route('kontak') }}"
                                class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a></li>
                        <li><a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}"><i
                                    class="fa fa-key"></i> Login</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
