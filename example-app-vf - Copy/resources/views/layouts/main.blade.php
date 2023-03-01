<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dash_Habib</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('FrontEnd/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('FrontEnd/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('FrontEnd/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('FrontEnd\css\vertical-layout-light\style.css')}}">
    <!-- endinject -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="sidebar-icon-only">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{route('dash')}}"><img src="{{asset('FrontEnd/images/logo.svg')}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('dash')}}"><img src="{{asset('FrontEnd/images/logo-mini.svg')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
              @guest
                      
              @else
                <img src="{{ asset(Auth::user()->photo) }}" alt="profile"/>
                <p class="ml-2 mt-2 text-dark">{{ asset(Auth::user()->name) }}</p>
              @endguest
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              
                @guest
                      
                  @else
                    
                        <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <i class="ti-power-off text-primary"></i>
                              {{ __('Logout') }}
                         </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('caisse-details.create') }}">
                              <i class="ti-receipt text-primary"></i>
                              Clôturez la caisse
                         </a>
                    
                @endguest
              
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          @guest   
          @else
                    
             @if ( Auth::user()->type == 'Admin')
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash')}}">
                  <i class="icon-grid menu-icon"></i>
                  <span class="menu-title">Tableau de bord</span>
                </a>
              </li>
             @endif
                    
          @endguest
          
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('operations.index')}}">
              <i class="ti-bar-chart-alt menu-icon"></i>
              <span class="menu-title">Operations</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('charges.index')}}">
              <i class="ti-view-list menu-icon"></i>
              <span class="menu-title">Charges</span>
            </a>
          </li>
          @guest
                      
          @else
                    
          @if ( Auth::user()->type == 'Admin')
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="ti-package menu-icon"></i>
                <span class="menu-title">Produits</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('produit-cats.index')}}">Categories</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('produits.index')}}">Produits</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#compte" aria-expanded="false" aria-controls="charts">
                <i class="ti-wallet menu-icon"></i>
                <span class="menu-title">Compte</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="compte">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('comptes.index')}}">Comptes</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('alimentations.index')}}">Alimentaions</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Caisse" aria-expanded="false" aria-controls="Caisse">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Caisse</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="Caisse">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('caisses.index')}}">Caisses</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('caisse-details.index')}}">Clotures</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('alimentations_caisse.index')}}">Alimentation </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#param" aria-expanded="false" aria-controls="param">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Parameters</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="param">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{route('agencies.index')}}">Agences</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Utilisateurs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('operation-cats.index')}}">Types d'operation</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('chargeCats.index')}}">Types charge</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
              </a>
            </li>
          @endif
                    
          @endguest
        </ul>
      </nav>

    @yield('content')

       <!-- content-wrapper ends -->
        <!-- partial:FrontEnd/partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.  <a href="https://www.bootstrapdash.com/" target="_blank">Med Elmkaoui</a> From Med Elmkaoui. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
     <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->


  <!-- plugins:js -->
  <script src="{{asset('FrontEnd/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('FrontEnd/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('FrontEnd/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('FrontEnd/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('FrontEnd/js/dataTables.select.min.js')}}"></script>
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('FrontEnd/js/off-canvas.js')}}"></script>
  <script src="{{asset('FrontEnd/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('FrontEnd/js/template.js')}}"></script>
  <script src="{{asset('FrontEnd/js/settings.js')}}"></script>
  <script src="{{asset('FrontEnd/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('FrontEnd/js/dashboard.js')}}"></script>
  <script src="{{asset('FrontEnd/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->

  

</body>

</html>
