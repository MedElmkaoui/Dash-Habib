@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Demande d'Alimentation</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('alimentations_caisse.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    @if (Session::has('Error'))
                        <div class="alert alert-danger">
                            <p class="text-dark">{{ Session::get('Error') }}</p>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p class="text-dark">{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{route('alimentations_caisse.store')}}" method="POST">
                      @csrf
                      @method('POST')

                      <div class="form-group">
                        <label for="id_user_donneur">Donneur</label>
                          <select class="form-control" id="id_user_donneur" name="id_user_donneur">
                              @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                          </select>    
                      </div>

                      <div class="form-group">
                        <label for="montant">Monatant</label>
                        <input type="number" class="form-control" id="montant" name="montant" placeholder="Monatant">
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