@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <?php
            $totalOp =0;
          ?>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                  <div class="col-lg-12 mb-lg-5">
                      <div class="">
                          <h4 class="card-title">Operations</h4>
                          <p class="card-description">
                              Vous avez maintenant {{count($operations)}} Operation(s)
                          </p>
                          <p class="card-description">
                              @foreach ($operations as $operation)
                                <?php
                                  $totalOp += ($operation->montant + $operation->cost);
                                ?>
                              @endforeach
                              Total : {{$totalOp}} MAD
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
                                <form class="forms-sample p-4" action="{{route('operations.index')}}" method="GET">
                                  @csrf
                                  @method('GET')
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <select class="form-control" id="type-produit" name="id_cat">
                                        <option value="" hidden>Sélectionnez le type d'opération</option>
                                        @foreach ($categories as $cat)
                                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group col-6">
                                      <select class="form-control" id="in_out" name="in_out">
                                        <option value="" hidden>In / Out</option>
                                        <option value="In">In</option>
                                        <option value="Out">Out</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <input type="number" class="form-control" id="montant" name="montant" placeholder="Montant">
                                    </div>
                                    <div class="form-group col-6">
                                      <input type="number" class="form-control" id="cost" name="cost" placeholder="Cost">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <select class="form-control" id="prod_cat">
                                      </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <select class="form-control" id="name_prod" name="id_prod">
                                        </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                    </div>
                                    <div class="form-group col-6">
                                      <select class="form-control" id="id_user" name="id_user">
                                        <option value="">Sélectionnez le responsable</option>
                                        @foreach ($users as $user)
                                          <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                </form>
                            </div>
                          </div>
                        </div>
                        <a class="btn btn-primary float-right mb-3" href="{{route('operations.create')}}"> Nouveau Operation</a>
                      </div>
                  </div>
                  <div class="table-responsive mb-lg-5">
                    <table id="myTable" class="table table-hover">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Nom Produit</th>
                          <th>Categorie Produit</th>
                          <th>Type Operation</th>
                          <th>Date</th>
                          <th>Monatnt</th>
                          <th>Cost</th>
                          <th>In / Out</th>
                          <th>Resopnsable</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($operations as $index=>$operation)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$operation->produit->name}}</td>
                                <td>{{$operation->produit->produitCat->name}}</td>
                                <td>{{$operation->operationcats->name}}</td>
                                <td>{{$operation->date}}</td>
                                <td>{{$operation->montant}}</td>
                                <td>{{$operation->cost}}</td>
                                <td>{{$operation->in_out}}</td>
                                <td>{{$operation->user->name}}</td>
                                <td>
                                  <!--<a class="btn btn-outline-warning btn-sm " href="{{route('operations.edit', $operation)}}"><i class="ti-pencil"></i></a>-->
                                  <form action="{{ route('operations.destroy', $operation) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit" ><i class="ti-trash"></i></button>
                                  </form>

                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                      {{ $operations->links('layouts.my-pagination') }}
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