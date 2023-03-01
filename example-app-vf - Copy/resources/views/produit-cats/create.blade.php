@extends('layouts.main');

@section("content")
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('produit-cats.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <h4 class="card-title">Créer Nouveau Categorie</h4>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    
                    
                    
                    <form class="forms-sample mt-4" action="{{route('produit-cats.store')}}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="name">Nom Categorie</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom Categorie">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="in-out">In / Out</label>
                            <select class="form-control" id="in-out" name="in_out">
                                <option>In</option>
                                <option>Out</option>
                            </select>
                            @error('in_out')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                        <button class="btn btn-light">Annuler</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection
