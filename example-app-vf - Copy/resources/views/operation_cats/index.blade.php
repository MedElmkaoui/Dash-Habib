@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                  <div class="col-lg-12 mb-lg-5">
                      <div class="">
                          <h4 class="card-title">Types d'Operation</h4>
                          <p class="card-description">
                              Vous avez maintenant {{count($cats)}} Type d'Operation(s)
                          </p>
                      </div>
                      <div class=" float-right d-flex align-content-center">
                        <a class="btn btn-primary float-right mb-3" href="{{route('operation-cats.create')}}"> Nouveau Type Operation</a>
                      </div>
                  </div>
                  <div class="table-responsive mb-lg-5">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Type d'operation</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cats as $index=>$cat)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$cat->name}}</td>
                                <td>
                                  <a class="btn btn-outline-warning btn-sm " href="{{route('operation-cats.edit', $cat->id)}}"><i class="ti-pencil"></i></a>
                                  <form action="{{ route('operation-cats.destroy', $cat->id) }}" class="d-inline-block"  method="POST">
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
@endsection