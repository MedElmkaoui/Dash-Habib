@extends('layouts.main')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Produit</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('produits.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('produits.store')}}" method="POST">
                        @csrf
                        @method('POST')
                      @if (count($categories)!=0 && count($comptes)!=0 )
                          <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name"  name="name" placeholder="Nom Produit">
                          </div>
                          <div class="form-group">
                            <label for="type-produit">Type Produit</label>
                              <select class="form-control" name="id_cat" id="type-produit">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="compte">Compte</label>
                              <select class="form-control" name="id_compte" id="compte">
                                @foreach ($comptes as $compte)
                                    <option value="{{$compte->id}}">{{$compte->name}}</option>
                                @endforeach
                              </select>
                          </div>

                          <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                          <button class="btn btn-light">Annuler</button>
                      @else
                        <div class="alert alert-danger mb-3">
                          @if (Auth::user()->type != 'Admin')
                              <p class="text-dark"> Contactez L'admin</p>
                          @else
                              <p class="text-dark"> Vous devez d'abord avoir les <a class="text-primary" href="{{route('produit-cats.index')}}"> Types de Produit' </a> OU  <a class="text-primary" href="{{route('comptes.index')}}"> Comptes </a>  disponibles afin de pouvoir ajouter un Produit    </a></p>
                          @endif
                        </div>
                      @endif
                      
                      
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection