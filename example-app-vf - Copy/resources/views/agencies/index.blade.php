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
                            <h4 class="card-title">Agences</h4>
                            <p class="card-description">
                                Vous avez maintenant {{count($agencies)}} agence(s)
                            </p>
                        </div>
                        <div class="d-flex float-right">
                          <div class="filter">
                            <div class="dropdown mr-3 ">
                              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-filter mr-2"></i>
                              </button>
                              <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                  <form class="forms-sample p-4" action="{{route('agencies.index')}}" method="GET">
                                    @csrf
                                    <div class="row">
                                      <div class="form-group col-6">
                                        <input type="text" class="form-control" id="code_ag" name="code_ag" placeholder="Code Agence">
                                      </div>
                                      <div class="form-group col-6">
                                        <input type="text" class="form-control" id="adr" name="adr" placeholder="Adresse">
                                      </div>
                                    </div>
                                    <div class="form-group ">
                                      <input type="text" class="form-control" id="fix" name="fix" placeholder="Adresse">
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
                                          <input type="text" class="form-control" id="sold" name="sold_d" placeholder="Sold">
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                  </form>
                              </div>
                            </div>
                            
                          </div>
                          <a class=" btn btn-primary mb-3" href="{{route('agencies.create')}}"> Nouveau Agence</a>
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Code Agence</th>
                          <th>Adresse</th>
                          <th>Fix</th>
                          <th>Responsable</th>
                          <th>Sold Départ</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($agencies as $agency)
                            <tr>
                                <td>{{$agency->code_ag}}</td>
                                <td>{{$agency->adr}}</td>
                                <td>{{$agency->fix}}</td>
                                <td>{{$agency->user->name}}</td>
                                <td>{{$agency->sold_d}}</td>
                                <td>
                                  <a class="btn btn-outline-warning btn-sm mr-2" href="{{route('agencies.edit', $agency)}}"><i class="ti-pencil"></i></a>
                                  <form action="{{ route('agencies.destroy', $agency) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm mr-2" type="submit"><i class="ti-trash"></i></button>
                                  </form>
                                  <a class="btn btn-outline-info btn-sm mr-2" href="{{route('agencies.show', $agency->id)}}"><i class="ti-receipt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection