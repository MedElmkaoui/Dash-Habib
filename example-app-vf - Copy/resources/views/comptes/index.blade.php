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
                            <h4 class="card-title">Comptes</h4>
                            <p class="card-description">
                                Vous avez maintenant {{count($comptes)}} compte(s)
                            </p>
                        </div>
                        <div class="d-flex float-right">
                          <div class="filter">
                            <div class="dropdown mr-3 ">
                              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-filter mr-2"></i>
                              </button>
                              <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                  <form class="forms-sample p-4" action="{{route('comptes.index')}}" method="GET">
                                    @csrf
                                    <div class="row">
                                      <div class="form-group col-6 ">
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Nom compte">
                                      </div>
                                      <div class="form-group col-6">
                                        <input type="text" class="form-control" id="Nbr_compte" placeholder="N° de Compte" name="n_compte">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6">
                                        <label for="tel">Téléphone</label>
                                        <input type="tel" class="form-control" id="tel" placeholder="Téléphone" name="tel">
                                      </div>
                                      <div class="form-group col-6">
                                          <label for="adresse">Adresse</label>
                                          <input type="text" class="form-control" id="adresse" placeholder="Adresse" name="adresse">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <input type="number" class="form-control" id="sold" placeholder="Sold" name="sold">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                  </form>
                              </div>
                            </div>
                            
                          </div>
                          <a class=" btn btn-primary mb-3" href="{{route('comptes.create')}}"> Nouveau Compte</a>
                        </div>
                        
                    </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>N° de compte</th>
                          <th>Telephone</th>
                          <th>Adresse</th>
                          <th>Sold (DH)</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($comptes as  $compte)
                            <tr>
                                <td>{{$compte->name}}</td>
                                <td>{{$compte->n_compte}}</td>
                                <td>{{$compte->adr}}</td>
                                <td>{{$compte->tel}}</td>
                                <td>{{$compte->sold}}</td>
                                <td>
                                  <a class="btn btn-outline-warning btn-sm " href="{{route('comptes.edit', $compte->id)}}"><i class="ti-pencil"></i></a>
                                  <form action="{{ route('comptes.destroy', $compte->id) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button>
                                  </form>
                                  <a class="btn btn-outline-secondary btn-sm" href="{{route('alimentations.create')}}">Alimentation</a>
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