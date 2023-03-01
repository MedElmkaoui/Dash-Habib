@extends('layouts.main')

@section('content')
     <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Charge</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('charges.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    @if (Session::has('error'))
                      <div class="alert alert-danger">
                        <p class="text-dark">{{ Session::get('error') }}</p>
                      </div>
                    @endif
                    @if (Session::has('success'))
                      <div class="alert alert-success">
                        <p class="text-dark">{{ Session::get('success') }}</p>
                      </div>
                    @endif

                    @if (count($agencies)!=0 && count($charges_cats)!=0)
                      <form class="forms-sample" action="{{route('charges.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <div class="form-group ">
                          <label for="label">Désignation</label>
                          <input type="text" class="form-control" id="label" name="label" placeholder="Désignation">
                        </div>
                          @if (Auth::user()->type == 'Admin')
                            <div class="form-group ">
                              <label for="id_ag">Agence</label>
                              <select class="form-control" id="id_ag" name="id_ag">
                                @foreach ($agencies as $agency)
                                    <option value="{{$agency->id}}">{{$agency->code_ag}}</option>
                                @endforeach
                              </select>
                            </div>
                          @endif
                          
                          <div class="form-group ">
                              <label for="id_cat">Type de Charge</label>
                              <select class="form-control" id="id_cat" name="id_cat">
                                  @foreach ($charges_cats as $cat)
                                      <option value="{{$cat->id}}">{{$cat->name}}</option>
                                  @endforeach
                                </select>
                          </div>
                        @if (Auth::user()->type == 'Admin')
                          <div class="form-group ">
                              <label for="date">Date </label>
                              <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                          </div>
                        @endif
                        <div class="form-group">
                          <label for="montant">Monatant</label>
                          <input type="number" class="form-control" id="montant" name="montant" placeholder="Monatant">
                        </div>
                        @if (Auth::user()->type == 'Admin')
                          <div class="form-group">
                            <label for="id_user">Responsable</label>
                            <select class="form-control" id="id_user" name="id_user">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        @endif
                        
                        <div class="form-group">
                          <label for="exampleTextarea1">Note <span class="text-danger">*</span></label>
                          <textarea class="form-control" name="note" id="exampleTextarea1" rows="4"></textarea>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                        <button class="btn btn-light">Annuler</button>
                      </form>
                    @else
                        <div class="alert alert-danger"> 
                            @if (Auth::user()->type != 'Admin')
                              <p class="text-dark"> Contactez L'admin</p>
                            @else
                              <p class="text-dark"> Vous devez d'abord avoir les <a class="text-primary" href="{{route('chargeCats.index')}}"> Types des Charge </a> OU  <a class="text-primary" href="{{route('agencies.index')}}">Les Agences </a> disponibles afin de pouvoir ajouter une Charge    </a></p>
                            @endif
                          </div>
                    @endif
                    
                  </div>
                </div>
              </div>
          </div>
        </div>    
@endsection