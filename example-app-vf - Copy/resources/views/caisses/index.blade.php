@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                    <div class="col-lg-12 ">
                        <div class="">
                            <h4 class="card-title">Caisses</h4>
                            <p class="card-description">
                                Vous avez maintenant {{count($caisses)}} caisse(s)
                            </p>
                        </div>
                        <div class="d-flex float-right">
                          <div class="filter">
                            <div class="dropdown mr-3 ">
                              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-filter mr-2"></i>
                              </button>
                              <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                  <form class="forms-sample p-4" action="{{route('caisses.index')}}" method="GET">
                                    @csrf
                                    <div class="row">
                                      <div class="form-group col-6 ">
                                      <input type="text" class="form-control" id="code_c" name="code_caisse" placeholder="Code de Caisse">
                                      </div>
                                      <div class="form-group col-6">
                                        <select class="form-control" id="type-produit" name="id_ag">
                                          <option value="" hidden>Sélectionnez l'Agence</option>
                                          @foreach ($agencies as $agency)
                                            <option value="{{$agency->id}}">{{$agency->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6">
                                          <select class="form-control" id="type-produit" name="id_user">
                                            <option value="" hidden>Sélectionnez le responsable</option>
                                            @foreach ($users as $user)
                                              <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group col-6">
                                        <input type="text" class="form-control" id="code_c" name="sold_d" placeholder="Sold">
                                      </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                  </form>
                              </div>
                            </div>
                            
                          </div>
                          <a class=" btn btn-primary mb-3" href="{{route('caisses.create')}}"> Nouveau Caisse</a>
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Code Caisse</th>
                          <th>Responsable</th>
                          <th>Code Agence</th>
                          <th>Sold Départ</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($caisses as $caisse)
                          <tr>
                            <td>{{$caisse->code_caisse}}</td>
                            <td>{{$caisse->user->name}}</td>
                            <td>{{$caisse->agency->code_ag}}</td>
                            <td>{{$caisse->sold_d}}</td>
                            <td>
                              <a class="btn btn-outline-warning btn-sm " href="{{route('caisses.edit', $caisse->id)}}"><i class="ti-pencil"></i></a>
                              <form action="{{ route('caisses.destroy', $caisse->id) }}" class="d-inline-block"  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button> 
                              </form>
                            </td>
                          </tr>
                        @endforeach
                        
                      </tbody>
                    </table>

                    {{ $caisses->links('layouts.my-pagination')}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection