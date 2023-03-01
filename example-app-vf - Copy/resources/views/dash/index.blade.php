@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Bienvenue {{ Auth::user()->name}}</h3>
                  <h6 class="font-weight-normal mb-0">Tous les systèmes fonctionnent correctement ! Tu as <span class="text-primary">3 alertes non lues !</span></h6>
                </div>
                
                
              </div>
              @if (Session::has('Error'))
                  <div class="alert alert-danger mt-4">
                    <p class="text-dark">{{ Session::get('Error') }}</p>
                  </div>
                @endif
                @if (Session::has('success'))
                  <div class="alert alert-success mt-4">
                    <p class="text-dark">{{ Session::get('success') }}</p>
                  </div>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{asset('FrontEnd/images\dashboard\people.svg')}}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i> 21<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Agadir</h4>
                        <h6 class="font-weight-normal">Maroc</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <div class="row  justify-content-between pl-3">
                        <p class="mb-4 mt-2">Solde d'agence : </p>
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                          <button class="btn btn-sm btn-light bg-white dropdown-toggle mr-2 mb-sm-4" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="mdi mdi-calendar"></i> <a class="dropdown-item d-inline" id="title-1" href="#">Tous</a>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" id="eles-1" aria-labelledby="dropdownMenuDate2">
                            <button class="dropdown-item"  id="btn-agency" data-foo=" ">Tous</button>
                              @foreach ($agencies as $agency)
                                <button class="dropdown-item " id="btn-agency" data-foo="{{$agency->code_ag}}">{{$agency->code_ag}}</button>
                              @endforeach
                            
                          </div>
                        </div>
                      </div>
                      <p class="fs-30 mb-2" id="input-sold">{{$soldAgencies}}</p>
                      <p>--.--% (-- Jours)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <div class="row  justify-content-between pl-3">
                        <p class="mb-4 mt-2">Sold de Compte :</p>
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                          <button class="btn btn-sm btn-light bg-white dropdown-toggle mr-2 mb-sm-4" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="mdi mdi-calendar"></i> <a class="dropdown-item d-inline" id="title-2" href="#">Tous</a>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" id="eles-2" aria-labelledby="dropdownMenuDate2">
                            <button class="dropdown-item"  id="btn-compte" data-foo=" ">Tous</button>
                            @foreach ($comptes as $compte)
                              <button class="dropdown-item " id="btn-compte" data-foo="{{$compte->id}}">{{$compte->name}}</button>
                              @endforeach
                          </div>
                        </div>
                      </div>
                      <p class="fs-30 mb-2" id="input-compte">{{$totalCompte}}</p>
                      <p>--.--% (-- Jours)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <div class="row  justify-content-between pl-3">
                        <p class="mb-4 mt-2">Operation aujourd'hui </p>
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                          <button class="btn btn-sm btn-light bg-white dropdown-toggle mr-2 mb-sm-4" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="mdi mdi-calendar"></i> <a class="dropdown-item d-inline" id="title-3" href="#">Tous</a>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" id="eles-3" aria-labelledby="dropdownMenuDate2">
                            <button class="dropdown-item " id="btn-in_out" data-foo="In">In</button>
                            <button class="dropdown-item " id="btn-in_out" data-foo="Out">Out</button>
                          </div>
                        </div>
                      </div>
                      <p class="fs-30 mb-2" id="input-in_out">{{$totalBenefit}}</p>
                      <p>--.--% (-- Jours)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <div class="row  justify-content-between pl-3">
                        <p class="mb-4 mt-2">Charges  </p>
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                          <button class="btn btn-sm btn-light bg-white dropdown-toggle mr-2 mb-sm-4" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="mdi mdi-calendar"></i> <a class="dropdown-item d-inline" id="title-4" href="#">Tous</a>
                          </button> 
                          <div class="dropdown-menu dropdown-menu-right" id="eles-4"  aria-labelledby="dropdownMenuDate2">
                            <button class="dropdown-item"  id="btn-charge" data-foo=" ">Tous</button>
                              @foreach ($agencies as $agency)
                                <button class="dropdown-item " id="btn-charge" data-foo="{{$agency->id}}">{{$agency->code_ag}}</button>
                              @endforeach
                          </div>
                        </div>
                      </div>
                      <p class="fs-30 mb-2" id="input-charge">{{$totalCharge}}</p>
                      <p>--.--% (-- Jours)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-lg-flex justify-content-between flex-wrap">
                    <p class="card-title">Rapport des ventes</p>
                    <div class="dropdown mr-3">
                      <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" id="title-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tous
                      </button>
                      <div class="dropdown-menu" id="eles-5" aria-labelledby="title-5">
                        @foreach ($agencies as $agency)
                          <button class="dropdown-item " id="btn-agency-graph" data-foo="{{$agency->id}}">{{$agency->code_ag}}</button>
                        @endforeach
                      </div>
                    </div>
                 </div>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>

                  <input type="text" id="data-out" class="d-none">
                  <input type="text" id="data-in" class="d-none">
                  
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-4">Meilleurs produits</p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nom Produit</th>
                          <th>Total des ventes</th>
                          <th>Nombre d'unité</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @foreach ($topProducts as $topProduct)
                          <tr>
                            <td>{{$topProduct->name}}</td>
                            <td class="font-weight-normal">{{$topProduct->total_montant}}</td>
                            <td>{{$topProduct->count}}</td>
                          </tr>
                        @endforeach
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-4">Analyse des utilisateurs</p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Utilisateur</th>
                          <th class="border-bottom pb-2">Total </th>
                          <th class="border-bottom pb-2">Nbr d'operations </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($topUsers as $topUser)
                          <tr>
                            <td class="pl-0">{{$topUser->name}}</td>
                            <td><p class="mb-0"><span class="font-weight-bold mr-2">{{$topUser->total_montant}}</span>(--.--%)</p></td>
                            <td class="text-muted">{{$topUser->count}}</td>
                          </tr>
                        @endforeach
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

              <div class="row">
                <div class="col-md-6 stretch-card grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Notifications</p>
                      <ul class="icon-data-list">
                        <li>
                          <div class="d-flex">
                            <img src="images/faces/face1.jpg" alt="user">
                            <div>
                              <p class="text-info mb-1">Isabella Becker</p>
                              <p class="mb-0">Sales dashboard have been created</p>
                              <small>9:30 am</small>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="d-flex">
                            <img src="images/faces/face2.jpg" alt="user">
                            <div>
                              <p class="text-info mb-1">Adam Warren</p>
                              <p class="mb-0">You have done a great job #TW111</p>
                              <small>10:30 am</small>
                            </div>
                          </div>
                        </li>
                        
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card grid-margin grid-margin-md-0">
                  <div class="card data-icon-card-primary">
                    <div class="card-body">
                      <p class="card-title">PVs</p>                      
                      <p class="card-description text-white">Séléctioné utilisateur et/ou Agence</p>                      
                      <div class="row">
                        <div class="col-12 text-white">
                          <form class="forms-sample p-4">
                              <div class="form-group ">
                                <label for="type-produit">Utilisateur</label>
                                  <select class="form-control" id="type-produit">
                                    <option>User</option>
                                    <option>User 2</option>
                                  </select>
                              </div>
                              <div class="form-group ">
                                <label for="type-produit">Agence</label>
                                  <select class="form-control" id="type-produit">
                                    <option>Ag 1</option>
                                    <option>Ag 2</option>
                                  </select>
                              </div>
                            <a type="submit" class="btn btn-light mr-2" href="{{route('export')}}" >Imprimer</a>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
        </div>

        <script type="text/javascript">

          $(document).ready(function () {
      
              $("#btn-agency").click();
              $('#eles-1').on('click','#btn-agency', function () {
                  var code_ag = $(this).data('foo');
                  if(code_ag ===' '){
                    $('#title-1').html('Tous')
                  }else{
                    $('#title-1').html(code_ag)
                  }
                  $.ajax({
                      url: '{{route('benefits')}}?code_ag='+code_ag,
                      type: 'get',
                      success: function (res) {
                        $('#input-sold').html(res);
                        }
                      })
              });
      
              $('#eles-4').on('click','#btn-charge', function () {
      
                  var code_ag = $(this).data('foo');
                  if(code_ag ===' '){
                    $('#title-4').html('Tous')
                  }else{
                    $('#title-4').html(code_ag)
                  }
      
                  $.ajax({
                      url: '{{route('charges')}}?code_ag='+code_ag,
                      type: 'get',
                      success: function (res) {
                        $('#input-charge').html(res);
                      }
                  })
              });
      
              $('#eles-2').on('click','#btn-compte', function () {
      
                  var id_compte = $(this).data('foo');
                  if(id_compte ===' '){
                    $('#title-2').html('Tous')
                  }else{
                    $('#title-2').html(id_compte)
                  }
      
                  $.ajax({
                      url: '{{route('comptes-sold')}}?id_compte='+id_compte,
                      type: 'get',
                      success: function (res) {
                        $('#input-compte').html(res);
                      }
                  })
              });
      
              $('#eles-3').on('click','#btn-in_out', function () {
      
                  var in_out = $(this).data('foo');
      
                  if(in_out ===' '){
                    $('#title-3').html('In/Out')
                  }else{
                    $('#title-3').html(in_out)
                  }
      
                  $.ajax({
                      url: '{{route('op_in_out')}}?in_out='+in_out,
                      type: 'get',
                      success: function (res) {
                        $('#input-in_out').html(res);
                      }
                  })
              });
      
      
              $('#eles-5').on('click','#btn-agency-graph', function () {
      
                  var id_ag = $(this).data('foo');
                  
                  if(id_ag ===' '){
                    $('#title-5').html('Tous')
                  }else{
                    $('#title-5').html(id_ag)
                  }
                  $.ajax({
                      url: '{{route('getDateForGraph')}}?id_ag='+id_ag,
                      type: 'get',
                      success: function (data) {
                         
                          var outOperations = Object.keys(data.outOperations).map(function(key) {
                                                  return data.outOperations[key];
                                                });
                          var inOperations = Object.keys(data.inOperations).map(function(key) {
                                                  return data.inOperations[key];
                                                });
                                                
                          var maxTotal = data.maxTotal;

                          generateSalesChart(inOperations, outOperations, maxTotal)
        
                      }
                      
                  })
              });
      
      
            });
      
      
      </script>
@endsection