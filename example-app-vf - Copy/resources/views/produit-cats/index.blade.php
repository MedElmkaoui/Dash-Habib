@extends('layouts.main');

@section('content')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                    <div class="col-lg-12 ">
                        <h4 class="card-title">Catégories de produit</h4>
                        <div class="col-12 pt-2 d-block">
                          <a class="btn btn-primary float-right mb-4" href="{{route('produit-cats.create')}}">Nouveau Categorie</a>
                        </div>
                        <p class="card-description">
                          Vous avez maintenant {{count($produitCats)}} catégorie(s)
                        </p>
                        
                    </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>In / Out</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($produitCats as $produitcat)
                            <tr>
                                <td>{{$produitcat->name}}</td>
                                <td>{{$produitcat->in_out}}</td>
                                <td>
                                  <a class="btn btn-outline-warning btn-sm " href="{{route('produit-cats.edit', $produitcat)}}"><i class="ti-pencil"></i></a>
                                  <form action="{{ route('produit-cats.destroy', $produitcat) }}" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm " type="submit"><i class="ti-trash"></i></button>
                                  </form>

                                </td>
                            </tr>
                        @endforeach


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- main-panel ends -->
@endsection
