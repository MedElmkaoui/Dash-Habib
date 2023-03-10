@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier Utilisateur</h4>
                    <div class="col-12 pt-2 d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('users.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      
                        <div class="form-group">
                          <label for="name">Nom d'utilisateur</label>
                          <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="Nom d'utilisateur">
                        </div>
                        <div class="form-group">
                          <label for="cin">CIN</label>
                          <input type="text" class="form-control" id="cin" value="{{$user->cin}}" name="cin" placeholder="CIN">
                        </div>
                        <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email" placeholder="E-mail">
                        </div>

                        <div class="form-group">
                          <label for="type">Type</label>
                          <select class="form-control" id="type" name="type">
                              <option value="Admin" {{($user->type =="Admin")? "Selected" : ""}}>Admin</option>
                              <option value="User" {{($user->type =="User")? "Selected" : ""}}>User</option>
                          </select>
                        </div>
                        <div class="form-group ">
                            <label for="date_rec">Date de recretement</label>
                            <input type="date" class="form-control" name="date_rec" value="{{$user->date_rec}}" id="date_rec" placeholder="Date de recretement ">
                        </div>

                        <div class="form-group">
                          <label>Photo</label>
                          <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="form-group">
                          <label for="password">Mot de passe</label>
                          <input type="password" class="form-control" id="password"  name="password" placeholder="Mot de passe">
                        </div>

                        <div class="form-group">
                          <label for="confirm_password">Confirm?? mot de passe</label>
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" Confirm?? Mot de passe">
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