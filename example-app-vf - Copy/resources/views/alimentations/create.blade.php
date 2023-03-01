@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Créer Nouveau Alimentation</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('alimentations.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('alimentations.store')}}" method="POST">
                      @csrf
                      @method('POST')
                      
                      
                      <div class="form-group ">
                          <label for="date">Date</label>
                          <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                          @error('date')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <div class="row">
                        <div class="form-group col-6">
                        <label for="id_user">Responsable</label>
                          <select class="form-control" id="id_user" name="id_user" >
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                          </select>
                          @error('id_user')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-6">
                          <label for="id_compte">Compte</label>
                            <select class="form-control" id="id_compte" name="id_compte">
                                @foreach ($comptes as $compte)
                                  <option value="{{$compte->id}}">{{$compte->name}}</option>
                                @endforeach
                            </select>
                            @error('id_compte')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="montant">Monatant</label>
                        <input type="number" class="form-control" id="montant" name="montant" placeholder="Monatant">
                        @error('montant')
                                <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" name="note" id="note" rows="4"></textarea>
                        @error('note')
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