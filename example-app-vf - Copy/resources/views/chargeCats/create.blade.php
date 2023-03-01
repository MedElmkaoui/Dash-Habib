@extends('layouts.main')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Type De Charge</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('chargeCats.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('chargeCats.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                          <label for="name">Type de Charge</label>
                          <input type="text" class="form-control" id="name"  name="name" placeholder="Type de Charge">
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                        <button class="btn btn-light" >Annuler</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
@endsection