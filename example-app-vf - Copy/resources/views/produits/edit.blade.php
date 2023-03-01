@extends('layouts.main')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier Produit</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('produits.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('produits.update', $produit->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                      <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" value="{{$produit->name}}"  name="name" placeholder="Nom Produit">
                      </div>
                      <div class="form-group">
                        <label for="type-produit">Type Produit</label>
                          <select class="form-control" name="id_cat" id="type-produit">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{($category->id == $produit->id_cat)? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="compte">Compte</label>
                          <select class="form-control" name="id_compte" id="compte">
                            @foreach ($comptes as $compte)
                                <option value="{{$compte->id}}" {{($compte->id == $produit->id_compte)? "selected" : ""}}>{{$compte->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                      <button class="btn btn-light">Annuler</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection