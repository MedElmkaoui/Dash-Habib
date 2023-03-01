@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <?php
                    $totalCharge =0;
                ?>
                <div class="card-body mt-4">
                    <div class="col-lg-12 ">
                        <div class="">
                            <h4 class="card-title">Charges</h4>
                            <p class="card-description">
                                Vous avez maintenant {{count($charges)}} Charge(s)
                            </p>
                            <p class="card-description">
                              @foreach ($charges as $charge)
                                <?php
                                  $totalCharge += $charge->montant;
                                ?>
                              @endforeach
                                Total : {{$totalCharge}} MAD
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="d-flex float-right">
                          <div class="filter">
                            <div class="dropdown mr-3 ">
                              <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-filter mr-2"></i>
                              </button>
                              <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                                  <form class="forms-sample p-4" action="{{route('charges.index')}}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <div class="row">
                                      <div class="form-group col-6">
                                      <input type="text" class="form-control" id="label" name="label" placeholder="Désignation">
                                      </div>
                                      <div class="form-group col-6">
                                        <select class="form-control" id="type-produit" name="id_ag">
                                          <option value="" hidden>Sélectionnez L'agence</option>
                                          @foreach ($agencies as $agency)
                                            <option value="{{$agency->id}}">{{$agency->code_ag}}</option>
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
                                        <input type="number" class="form-control" id="montant" name="montant" placeholder="Montant">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6">
                                          <select class="form-control" id="type-produit" name="id_cat">
                                            <option value="" hidden>Sélectionnez Type de Charge</option>
                                            @foreach ($charges_cats as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group col-6">
                                        <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                                  </form>
                              </div>
                            </div>
                            
                          </div>
                          <a class=" btn btn-primary mb-3" href="{{route('charges.create')}}">Nouveau Charge</a>
                        </div>
                    </div>
                  <div class="table-responsive mb-4">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Désignation</th>
                          <th>Code Agence</th>
                          <th>Date</th>
                          <th>Type Charge</th>
                          <th>Monatant</th>
                          <th>Responsable</th>
                          <th>Note</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($charges as $charge)
                            <tr>
                                <td>{{$charge->label}}</td>
                                <td>{{$charge->agency->code_ag}}</td>
                                <td>{{$charge->date}}</td>
                                <td>{{$charge->category->name}}</td>
                                <td>{{$charge->montant}}</td>
                                <td>{{$charge->user->name}}</td>
                                <td>{{$charge->note}}</td>
                                <td>
                                  {{-- <a class="btn btn-outline-warning btn-sm " href="{{route('charges.edit', $charge)}}"><i class="ti-pencil"></i></a> --}}
                                  <form action="{{ route('charges.destroy', $charge) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                      {{ $charges->links('layouts.my-pagination')}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection