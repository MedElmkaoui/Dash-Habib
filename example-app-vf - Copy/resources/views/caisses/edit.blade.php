@extends('layouts.main')
@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier Nouveau Caisse</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('caisses.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('caisses.update', $caisse->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                      <div class="form-group">
                        <label for="code_caisse">Code Caisse</label>
                        <input type="text" class="form-control" id="code_caisse" value="{{$caisse->code_caisse}}"  name="code_caisse" placeholder="Code Caisse">
                      </div>
                      <div class="form-group">
                        <label for="id_user">Responsable</label>
                          <select class="form-control" name="id_user" id="id_user-produit">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{($user->id == $caisse->id_user)? "selected" : ""}}>{{$user->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="id_ag">Agence</label>
                          <select class="form-control" name="id_ag" id="id_ag">
                            @foreach ($agencies as $agency)
                                <option value="{{$agency->id}}" {{($agency->id == $caisse->id_ag)? "selected" : ""}}>{{$agency->code_ag}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="sold_d">Sold départ</label>
                        <input type="number" class="form-control" id="sold_d" value="{{$caisse->sold_d}}" name="sold_d" placeholder="Sold départ">
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