@extends('layouts.main')

@section('content')
     <!-- partial -->
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Agence</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('agencies.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
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
                    <form class="forms-sample" action="{{route('agencies.store')}}" method="POST">
                        @csrf
                        @method('POST')
                      <div class="form-group ">
                        <label for="code_ag">Code agence</label>
                        <input type="text" class="form-control" id="code_ag" name="code_ag" placeholder="Code d'agence">
                      </div>
                      <div class="form-group ">
                        <label for="adr">Adresse</label>
                        <input type="text" class="form-control" id="adr" name="adr" placeholder="Adresse">
                      </div>
                      
                      <div class="form-group ">
                          <label for="fix">Fix</label>
                          <input type="tel" class="form-control" id="fix" name="fix" placeholder="Fix">
                      </div>
                      <div class="form-group ">
                        <label for="id_user">Responsable</label>
                          <select class="form-control" id="id_user" name="id_user">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                          </select>
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