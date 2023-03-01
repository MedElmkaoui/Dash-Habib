@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="">
                        <h4 class="card-title ml-3">Créer Nouveau Opération</h4>
                        <p class="card-description mb-4 ml-3">
                          Tous informations sont inportant
                        </p>
                      </div>
                    
                    <div class="col-12  d-block">
                      <a class="btn btn-primary float-right mb-4" href="{{route('operations.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                    </div>
                  </div>

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
                    @if (count($categories)!=0 && count($produits)!=0 && count($produits_cats)!=0)
                      <form class="forms-sample" action="{{route('operations.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <div class="row">
                          <div class="form-group col-6">
                          <label for="id_cat">Type Opération</label>
                            <select class="form-control" id="id_cat" name="id_cat">
                              <option value="" hidden>Type d'operation</option>
                              @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                              
                            </select>
                            @error('id_cat')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-6">
                            <label for="in_out">In / Out</label>
                            <select class="form-control" id="in_out" name="in_out">
                              <option value="" hidden>In / Out</option>
                              <option value="In">In</option>
                              <option value="Out">Out</option>
                            </select>
                            @error('in_out')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        @if (Auth::user()->type == 'Admin')
                          <div class="form-group ">
                              <label for="date">Date</label>
                              <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                            @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group ">
                              <label for="id_user">Responsable</label>
                              <select class="form-control" id="id_user" name="id_user">
                                <option value="" hidden>Responsable</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                
                              </select>
                              @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                        @endif
                        <div class="row">
                          <div class="form-group col-6">
                          <label for="prod_cat">Categorie de produit</label>
                            <select class="form-control" id="prod_cat" >
                              
                            </select>
                            @error('prod_cat')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-6">
                            <label for="name_prod">Produit</label>
                              <select class="form-control" id="name_prod" name="id_prod">
                                  
                              </select>
                              @error('name_prod')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label for="montant">Monatant </label>
                          <input type="number" class="form-control" id="montant" name="montant" placeholder="Monatant">
                          @error('montant')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="cost">Cost <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="cost" name="cost" placeholder="Cost">
                          @error('cost')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleTextarea1">Note <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="exampleTextarea1" name="note" rows="4"></textarea>
                          @error('note')
                                  <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                        <button class="btn btn-light">Annuler</button>
                      </form>
                    @else
                        <div class="alert alert-danger">
                          @if (Auth::user()->type != 'Admin')
                              <p class="text-dark"> Contactez L'admin</p>
                          @else
                              <p class="text-dark"> Vous devez d'abord avoir les <a class="text-primary" href="{{route('operation-cats.index')}}"> Types d'Operation' </a> OU  <a class="text-primary" href="{{route('produits.index')}}"> Produits </a> OU <a class="text-primary" href="{{route('produit-cats.index')}}"> Types des Produit </a> disponibles afin de pouvoir ajouter une Charge    </a></p>
                          @endif
                        </div>
                    @endif
                  </div>
                </div>
              </div>
          </div>
        </div>


      <script type="text/javascript">

         
          $(document).ready(function () {
              $('#in_out').on('change', function () {
                  var in_out = this.value;
                  $('#prod_cat').html('');
                  $.ajax({
                      url: '{{route('get-cats',)}}?in_out='+in_out,
                      type: 'get',
                      success: function (res) {
                          $('#prod_cat').html('<option value="" hidden>Select Categorie de Produit</option>');
                          $.each(res, function (key, value) {
                              $('#prod_cat').append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                          $('#name_prod').html('<option value="" hidden>Select Produit</option>');
                      }
                  });
              });
              $('#prod_cat').on('change', function () {
                  var id_cat = this.value;
                  $('#name_prod').html('');
                  $.ajax({
                      url: '{{route('get-prods')}}?id_cat='+id_cat,
                      type: 'get',
                      success: function (data) {
                          $('#name_prod').html('<option value="" hidden>Select Produit</option>');
                          
                          $.each(data, function (key, value) {
                              $('#name_prod').append('<option value="' + value
                                  .id + '">' + value.name + '</option>');
                          });
                      }
                  });
              });
          });
      </script>
@endsection