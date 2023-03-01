@extends('layouts.main')

@section('content')
     <!-- partial -->
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier Nouveau Agence</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('agencies.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('agencies.update', $agency)}}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="form-group ">
                        <label for="code_ag">Code agence</label>
                        <input type="text" class="form-control" id="code_ag" value="{{$agency->code_ag}}" name="code_ag" placeholder="Code d'agence">
                      </div>
                      <div class="form-group ">
                        <label for="adr">Adresse</label>
                        <input type="text" class="form-control" id="adr" name="adr" value="{{$agency->adr}}" placeholder="Adresse">
                      </div>
                      
                      <div class="form-group ">
                          <label for="fix">Fix</label>
                          <input type="tel" class="form-control" id="fix" name="fix" value="{{$agency->fix}}" placeholder="Fix">
                      </div>
                      <div class="form-group ">
                        <label for="id_user">Responsable</label>
                          <select class="form-control" id="id_user" name="id_user">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{($user->id == $agency->id_user)? "selected" : ""}}>{{$user->name}}</option>
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