@extends('layouts.main')

@section('content')
     <!-- partial -->
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Compte</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('comptes.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('comptes.store')}}" method="POST">
                        @csrf
                        @method('POST')
                      <div class="form-group ">
                        <label for="name">Nom de compte</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom compte">
                      </div>
                      <div class="form-group ">
                        <label for="Nbr_compte">N° de compte</label>
                        <input type="text" class="form-control" id="Nbr_compte" name="n_compte" placeholder="N° de Compte">
                      </div>
                      
                      <div class="form-group ">
                          <label for="tel">Téléphone</label>
                          <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone">
                      </div>
                      <div class="form-group ">
                          <label for="adresse">Adresse</label>
                          <input type="text" class="form-control" id="adresse" name="adr" placeholder="Adresse">
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="sold">Sold</label>
                        <input type="number" class="form-control" id="sold" name="sold" placeholder="Sold">
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