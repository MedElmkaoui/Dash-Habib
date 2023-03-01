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
                          <h4 class="card-title">Alimentations</h4>
                          <p class="card-description">
                              Vous avez maintenant {{count($alimentations)}} alimentation(s)
                          </p>
                      </div>
                      <div class=" float-right d-flex align-content-center">
                        <div class="filter">
                          <div class="dropdown mr-3 ">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ti-filter mr-2"></i>
                            </button>
                            <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                <form class="forms-sample p-4" action="{{route('alimentations.index')}}" method="GET">
                                  @csrf
                                  @method('GET')
                                  
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <input type="number" class="form-control" id="montant" name="montant" placeholder="Montant">
                                    </div>
                                    <div class="form-group col-6">
                                      <select class="form-control" id="id_compte" name="id_compte">
                                        <option value="" hidden>Sélectionnez le Compte</option>
                                        @foreach ($comptes as $compte)
                                          <option value="{{$compte->id}}">{{$compte->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  
                                  
                                    <div class="form-group ">
                                      <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                    </div>
                                    @if (Auth::user()->type == 'Admin')
                                      <div class="form-group ">
                                        <select class="form-control" id="id_user" name="id_user">
                                          <option value="" hidden>Sélectionnez le responsable</option>
                                          @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    @endif
                                    
                                  
                                  
                                  <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                </form>
                            </div>
                          </div>
                        </div>
                        <a class="btn btn-primary float-right mb-3" href="{{route('alimentations.create')}}"> Nouveau alimentation</a>
                      </div>
                  </div>
                  <div class="table-responsive mb-lg-5">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Date Alimentation</th>
                          <th>Compte</th>
                          <th>Responsable</th>
                          <th>Montant</th>
                          <th>Note</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($alimentations as $index=>$alimentation)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$alimentation->date}}</td>
                                <td>{{$alimentation->compte->name}}</td>
                                <td>{{$alimentation->user->name}}</td>
                                <td>{{$alimentation->montant}}</td>
                                <td>{{$alimentation->note}}</td>
                                <td>
                                  {{-- <a class="btn btn-outline-warning btn-sm " href="{{route('alimentations.edit', $alimentation->id)}}"><i class="ti-pencil"></i></a> --}}
                                  <form action="{{ route('alimentations.destroy', $alimentation->id) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button> 
                                  </form>
                                </td> 
                            </tr>
                        @endforeach
                        
                        
                      </tbody>
                    </table>
                    {{ $alimentations->links('layouts.my-pagination')}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection