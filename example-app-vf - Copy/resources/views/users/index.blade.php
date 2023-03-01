@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body mt-4">
                    <div class="col-lg-12 ">
                        <div class="">
                            <h4 class="card-title">Utilisateurs</h4>
                            <p class="card-description">
                                Vous avez maintenant {{count($users)}} Utilisateur(s)
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
                        </div>
                        <a class=" btn btn-primary float-right mb-3" href="{{route('users.create')}}"> Nouveau Utilisateur</a>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>----</th>
                          <th>Nom</th>
                          <th>Date Recrutement</th>
                          <th>CIN</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Agence</th>
                          <th>Operations</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{asset($user->photo) }}" class="" alt=""></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->date_rec}}</td>
                                <td>{{$user->cin}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->type}}</td>
                                @if ($user->agency)
                                  <td>{{ $user->agency->code_ag }}</td>
                                @else
                                  <td>None</td>
                                @endif
                                <td>
                                  <a class="btn btn-outline-warning btn-sm " href="{{route('users.edit', $user)}}"><i class="ti-pencil"></i></a>
                                  {{-- <form action="{{route('users.destroy', $user)}}" id="delete-form" class="d-inline-block"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm delete-item"  type="submit"><i class="ti-trash"></i></button>
                                  </form> --}}

                                  <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal"><i class="ti-trash"></i></button>

                                  <div class="modal fade" id="confirm-delete-modal" tabindex="-1" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <div class="modal-header">
                                            <h5 class="modal-title " id="confirm-delete-modal-label">Confirmer la suppression</h5>
                                            <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
                                          </div>
                                          <div class="modal-body border-none">
                                            <p class="text-secondary">Saisir votre mot de passe pour confirmer la suppression</p>
                                            <div class="mb-3 form-group">
                                              <label for="password" class="form-label ">Mot de passe</label>
                                              <input type="password" name="password" id="password" class="form-control" required>
                                              @error('password')
                                                <div class="invalid-feedback alert alert-danger">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> 

                                  
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

        <script>
          $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            
            if (confirm('Are you sure you want to delete this item? Please enter your password to confirm.')) {
                var password = prompt('Please enter your password:');
                if (password != null && password != '') {
                    // Submit the form with the password as a parameter using Ajax
                    $.ajax({
                        url: $('#delete-form').attr('action'),
                        method: "POST"
                        data: {
                            _method: 'DELETE',
                            password: password,
                        },
                        success: function(response) {
                            
                        },
                        error: function(response) {
                            // Handle the error response
                        }
                    });
                }
            }
          });

        </script>
          
@endsection