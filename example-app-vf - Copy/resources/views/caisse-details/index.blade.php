@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                  <div class="col-lg-12 mb-lg-5">
                      <div class="">
                          <h4 class="card-title">Les Clotures Des Caisse</h4>
                          <p class="card-description">
                              Vous avez maintenant {{count($caisseDetails)}} Caisse Details(s)
                          </p>
                          @if (Session::has('Error'))
                            <div class="alert alert-danger">
                                <p class="text-dark">{{ Session::get('Error') }}</p>
                            </div>
                          @endif
                          @if (Session::has('success'))
                              <div class="alert alert-success">
                                  <p class="text-dark">{{ Session::get('success') }}</p>
                              </div>
                          @endif
                      </div>
                      <div class=" float-right d-flex align-content-center">
                        <div class="filter">
                          <div class="dropdown mr-3 ">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ti-filter mr-2"></i>
                            </button>
                            <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                <form class="forms-sample p-4" action="{{route('caisse-details.index')}}" method="GET">
                                  @csrf
                                  @method('GET')
                                  <div class="form-group">
                                    <select class="form-control"  name="id_caisse">
                                      <option value="" hidden>Filtré par Caisse</option>
                                      @foreach ($caisses as $caisse)
                                        <option value="{{$caisse->id}}">{{$caisse->code_caisse}}</option> 
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group ">
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                </form>
                            </div>
                          </div>
                        </div>
                        <a class="btn btn-primary float-right mb-3" href="{{route('caisse-details.create')}}"> Clôturez la caisse</a>
                      </div>
                  </div>
                  

                  <div class="table-responsive mb-lg-5">
                    <table id="myTable" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Responsable</th>
                          <th>Date</th>
                          <th>Caisse</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($caisseDetails as $index=>$caisseDetail)
                            <tr>
                                <td>{{$caisseDetail->caisse->user->name}}</td>
                                <td>{{$caisseDetail->date}}</td>
                                <td>{{$caisseDetail->caisse->code_caisse}}</td>
                                <td>
                                  <a class="btn btn-outline-warning btn-sm " href="{{route('caisse-details.edit', $caisseDetail)}}"><i class="ti-pencil"></i></a>
                                  <form action="{{ route('caisse-details.destroy', $caisseDetail) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit">Supprimer</button>
                                    <a class="btn btn-outline-success btn-sm " href="{{route('caisse-details.show', $caisseDetail)}}" ><i class="ti-trash"></i></a>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                      {{ $caisseDetails->links('layouts.my-pagination') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        
        <script type="text/javascript">

          $(document).ready(function () {
              $('#in_out').on('change', function () {
                  var in_out = this.value;
                  $('#prod_cat').html('');
                  $.ajax({
                      url: '{{route('get-cats',)}}?in_out='+in_out, 
                      type: 'get',
                      success: function (res) {
                          $('#prod_cat').html('<option value="">Select Categorie de Produit</option>');
                          $.each(res, function (key, value) {
                              $('#prod_cat').append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                          $('#name_prod').html('<option value="">Select Produit</option>');
                      }
                  });
              });
              $('#prod_cat').on('change', function () {
                  var id_cat = this.value;
                  $('#name_prod').html('');
                  $.ajax({
                      url: '{{route('get-prods')}}?id_cat='+id_cat,
                      type: 'get',
                      success: function (data) {
                          $('#name_prod').html('<option value="" hidden>Select Produit</option>');
                          
                          $.each(data, function (key, value) {
                              $('#name_prod').append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                      }
                  });
              });
          });
      </script>
@endsection