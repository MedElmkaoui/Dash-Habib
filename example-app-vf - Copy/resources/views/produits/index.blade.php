~@extends('layouts.main')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body mt-4">
                <div class="col-lg-12 ">
                    <div class="">
                        <h4 class="card-title">Produits</h4>
                        <p class="card-description">
                            Vous avez maintenant {{count($produits)}} Produit (s)
                        </p>
                    </div>
                    <div class=" float-right d-flex  ">
                     
                      <div class="filter">
                        <div class="dropdown mr-3">
                          <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-filter mr-2"></i>
                          </button>
                          <div class="dropdown-menu .dropdown-menu-right " aria-labelledby="dropdownMenuIconButton1">
                              <form class="forms-sample p-4" action="{{route('produits.index')}}" method="GET">
                                <div class="row">
                                  <div class="form-group col-6">
                                    <label for="type-produit">Type Produit</label>
                                      <select class="form-control" id="type-produit" name="id_cat">
                                        <option value="" hidden>Sélictionez le Type de produit</option>
                                        @foreach ($categories as $cat)
                                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="form-group col-6">
                                    <label for="type-produit">Compte</label>
                                      <select class="form-control" id="type-produit" name="id_compte">
                                        <option value="" hidden>Sélictionez Le Compte</option>
                                        @foreach ($comptes as $compte)
                                          <option value="{{$compte->id}}">{{$compte->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Filtré</button>
                              </form>
                          </div>
                        </div>
                        
                      </div>
                      <a class=" btn btn-primary float-right mb-3" href="{{route('produits.create')}}"> Nouveau Produit</a>
                    </div>
                    
                    
                </div>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Catégorie</th>
                      <th>Compte</th>
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{$produit->name}}</td>
                            <td>{{$produit->produitCat->name}}</td>
                            <td>{{$produit->compte->name}}</td>
                            <td class="">
                              <a class="btn btn-outline-warning btn-sm " href="{{route('produits.edit', $produit->id)}}"><i class="ti-pencil"></i></a>
                              <form action="{{ route('produits.destroy', $produit->id) }}" class="d-inline-block"  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
                @if (!request()->has('id_compte'))
                  {{ $produits->links('layouts.my-pagination') }}
                @endif
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection