<header class="header-area-four fixed-top">
  <!-- Start Top Header Area -->
  <div class="header-style-four">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-5">
          <div class="header-left-content">
            <ul>
              <li>
              <a href="tel:0600000000">
                <i class="bx bx-phone-call"></i>
                0600000000
              </a>
              </li>

              <li>
              <a href="tel:0600000000">
                0600000000
              </a>
              </li>

              <li>
                <a href="mailto:contact@livraison.ma">
                  <i class="bx bx-envelope"></i>
                contact@livraison.ma
                </a>
              </li>

            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-7">
          <div class="header-right-content">
            <ul class="additional-link">
              <li>
                <a href="{{ route('auth.livreur.signIn') }}">Espace Livreur</a>
              </li>
              <li>
                <a href="{{ route('auth.livreur.signUp') }}">Devenir Livreur</a>
              </li>
            </ul>
            <ul class="social-links">
                              
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Top Header Area -->

  
    <!-- Start Prevoz Navbar Area -->
  <div class="prevoz-nav-style prevoz-nav-style-four">
  <div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">

      <a href="" class="logo">

        <img src="{{ asset('storage/images/logo.png') }}" width="40" alt="Logo">
      </a>
    </div>
    <!-- Menu For Desktop Device -->
    <div class="main-nav" style="background-color:var(--main-color)">
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
          <a class="navbar-brand"  href="">
            <img src="{{ asset('storage/images/logo.png') }}" width="70" alt="Logo">
          </a>
          <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                  <a href="{{ route('home') }}" class="nav-link dropdown-toggle ">Accueil</a>
                </li>
                <li class="nav-item">
                  <a href="#services-section" class="nav-link dropdown-toggle">Services</a>
                </li>
                <li class="nav-item">
                  <a href="tarifs" class="nav-link dropdown-toggle"> Tarifs</a>
                </li>
                <li class="nav-item">
                  <a href="#avantages-section" class="nav-link dropdown-toggle">Avantages</a>
                </li>
                <li class="nav-item">
                  <a href="#contact-section" class="nav-link">Contact</a>
                </li>
                
                <li class="nav-item">
                  <a href="{{ route('auth.client.signUp') }}" class="nav-link">Devenir client</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('auth.client.signIn') }}" class="nav-link">Espace client</a>
                </li>
                <!--config_ws_link_direct-->
                
            </ul>
            <!-- Start Other Option -->
            <div class="others-option">
              
              <button type="button" class="sidebar-menu" data-toggle="modal" data-target="#myModal2">
                <i class="flaticon-menu"></i>
              </button>
            </div>
            <!-- End Other Option -->
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>
<!-- End Prevoz Navbar Area -->
  <!-- End Prevoz Navbar Area -->
</header>