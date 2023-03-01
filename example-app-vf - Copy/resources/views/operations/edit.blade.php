@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Modifier Opération N° : {{$operation->id + 1}}</h4>
                    <p class="card-description mb-4">
                      Tous informations sont inportant
                    </p>
                    <form class="forms-sample" action="{{route('operations.update', $operation->id)}}" method="PUT">
                      @csrf
                      @method('PUT')
                      
                      <div class="row">
                        <div class="form-group col-6">
                        <label for="id_cat">Type Opération</label>
                          <select class="form-control" id="id_cat" name="id_cat">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{($category->id == $operation->id_cat)? "Selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                            
                          </select>
                          @error('id_cat')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-6">
                          <label for="in_out">In / Out</label>
                          <select class="form-control" id="in_out" name="in_out">
                            <option value="In" {{("In" == $operation->in_out)? "Selected" : ""}}>In</option>
                            <option value="Out" {{("Out" == $operation->in_out)? "Selected" : ""}}>Out</option>
                          </select>
                          @error('in_out')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group ">
                          <label for="date">Date</label>
                          <input type="date" class="form-control" id="date" value="{{$operation->date}}" name="date" placeholder="Date">
                        @error('date')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="row">
                        <div class="form-group col-6">
                        <label for="prod_cat">Categorie de produit</label>
                          <select class="form-control" id="prod_cat"  >
                            @foreach ($produits_cats as $produits_cat)
                                <option value="{{$produits_cat->id}}" {{($produits_cat->name == $operation->prod_cat)? "Selected" : ""}}>{{$produits_cat->name}}</option>
                            @endforeach
                          </select>
                          @error('prod_cat')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-6">
                          <label for="name_prod">Produit</label>
                            <select class="form-control" id="name_prod" name="id_prod">
                                @foreach ($produits as $produit)
                                  <option value="{{$produit->id}}" {{($produit->name == $operation->name_prod)? "Selected" : ""}}>{{$produit->name}}</option>
                                @endforeach
                            </select>
                            @error('name_prod')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="montant">Monatant</label>
                        <input type="number" class="form-control" id="montant"  value="{{$operation->montant}}" name="montant" placeholder="Monatant">
                        @error('montant')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="cost">Cost <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="cost" value="{{$operation->cost}}" name="cost" placeholder="Cost">
                        @error('cost')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Note <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="exampleTextarea1" name="note" rows="4">{{$operation->note}}</textarea>
                        @error('note')
                                <div class="text-danger">{{ $message }}</div>
                          @enderror 
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                      <button class="btn btn-light">Annuler</button>
                    </form>
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