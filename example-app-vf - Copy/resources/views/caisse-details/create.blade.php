@extends('layouts.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="row d-flex justify-content-between col-12 mb-4 mb-xl-0">
                <div class="">
                  <h3 class="font-weight-bold ">Rapport de Jour</h3>
                  
                </div>
                <div class=" float-right d-flex align-content-center">
                  <div class="col-12 pt-2 d-block">
                    <a class="btn btn-primary float-right mb-4" href="{{route('caisse-details.index')}}"><i class="ti-home mr-4 "></i>Retour</a>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-6  stretch-card grid-margin">
            <div class="card">
              <div class="card-body">
                <p class="card-title m-4">Les Operations d'aujourd'huit</p>
                <div class="table-responsive  d-flex justify-content-center">
                  <table class="table col-11 table-striped ">
                    <thead>
                      <tr>
                        <th class="border-bottom pb-2">Type Operation</th>
                        <th class="border-bottom pb-2">Produit </th>
                        <th class="border-bottom pb-2">Montant </th>
                        <th class="border-bottom pb-2">Cost </th>
                        <th class="border-bottom pb-2">Total </th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($operations as $operation)
                        @if ($operation->in_out == 'In')
                          <tr class="alert text-dark">
                            <td class="ml-2" >{{$operation->in_out}}</td>
                            <td class="ml-2">{{$operation->produit->name}}</td>
                            <td class="ml-2">{{$operation->montant}}</td>
                            <td class="ml-2">{{$operation->cost}}</td>
                            <td ><p class="mb-0"><span class="font-weight-bold mr-2">{{$operation->montant + $operation->cost}}</span></p></td>
                          </tr>
                        @endif
                      @endforeach
                      <tr class="alert text-dark ">
                        <td class="ml-2 border-right font-weight-bold" colspan="4">Total Operations In</td>
                        <td >{{$TotalOperationIn}}</td>
                      </tr>
                     @foreach ($operations as $operation)
                        @if ($operation->in_out == 'Out')
                          <tr class="alert  text-dark">
                            <td class="ml-2" >{{$operation->in_out}}</td>
                            <td class="ml-2">{{$operation->produit->name}}</td>
                            <td class="ml-2">{{$operation->montant}}</td>
                            <td class="ml-2">{{$operation->cost}}</td>
                            <td ><p class="mb-0"><span class="font-weight-bold mr-2">{{$operation->montant + $operation->cost}}</span></p></td>
                          </tr>
                        @endif
                      @endforeach
                      <tr class="alert text-dark">
                        <td class="ml-2 border-right font-weight-bold" colspan="4">Total Operations Out</td>
                        <td >{{$TotalOperationOut}}</td>
                      </tr>
                      <tr class="alert text-dark ">
                        <td class="ml-2 border-right font-weight-bold" colspan="4">Total Operations</td>
                        <td >{{$TotalOperationIn - $TotalOperationOut}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-body">
                <p class="card-title m-4">Les Charges d'aujourd'huit</p>
                <div class="table-responsive  d-flex justify-content-center">
                  <table class="table col-11 table-striped ">
                    <thead>
                      <tr>
                        <th class="border-bottom  pb-2">Désignation</th>
                        <th class="border-bottom pb-2" colspan="3">Charge Categorie </th>
                        <th class="border-bottom pb-2">Montant </th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach ($charges as $charge)
                          <tr class="alert  text-dark">
                            <td class="ml-2" >{{$charge->label}}</td>
                            <td class="ml-2" colspan="3">{{$charge->category->name}}</td>
                            <td >{{$charge->montant}}</td>
                          </tr>
                      @endforeach
                      <tr class="alert text-dark">
                        <td class="ml-2 border-right font-weight-bold" colspan="4">Total charge</td>
                        <td >{{$TotalCharges}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title m-4 mb-0">Details de Caisse</p>
                <div class="table-responsive d-flex flex-column align-items-center">
                  <form class="pt-3 col-11" method="POST" action="{{ route('caisse-details.store') }}" method="POST">
                    @csrf
                    @method('POST')
    
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 200 DH</label>
                        <input type="number" name="n_200" data-cat="200" class="form-control "  placeholder="Nbr 200 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Nbr 100 DH</label>
                        <input type="number" name="n_100" data-cat="100" class="form-control "  placeholder="Nbr 100 DH">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 50 DH</label>
                        <input type="number" name="n_50" data-cat="50" class="form-control " placeholder="Nbr 50 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Nbr 20 DH</label>
                        <input type="number" name="n_20" data-cat="20" class="form-control "  placeholder="Nbr 20 DH">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 10 DH</label>
                        <input type="number" name="n_10" data-cat="10" class="form-control " placeholder="Nbr 10 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Nbr 05 DH</label>
                        <input type="number" name="n_5" data-cat="5" class="form-control " placeholder="Nbr 05 DH">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 02 DH</label>
                        <input type="number" name="n_2" data-cat="2" class="form-control " placeholder="Nbr 02 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Nbr 01 DH</label>
                        <input type="number" name="n_1" data-cat="1" class="form-control " placeholder="Nbr 01 DH">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 0.5 DH</label>
                        <input type="number" name="n_05" data-cat="0.5" class="form-control "  placeholder="Nbr 0.5 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Nbr 0.2 DH</label>
                        <input type="number" name="n_04" data-cat="0.2" class="form-control "  placeholder="Nbr 0.4 DH">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="number">Nbr 0.1 DH</label>
                        <input type="number" name="n_02" data-cat="0.1" class="form-control "  placeholder="Nbr 0.2 DH">
                      </div>
                      <div class="form-group col-6">
                        <label for="number">Sold Total</label>
                        <input type="text" name="sold_total" class="form-control " readonly id="sold_total"  placeholder="Sold Total">
                      </div>
                    </div>
                    
                    
                  </form>

                  <div class="col-md-10  stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive d-flex justify-content-center">
                          <table class="table col-11 table-striped ">
                            <tbody>
                              <tr class="alert text-dark">
                                <td class="ml-2 text-center border-right font-weight-bold" colspan="">Sold Départ</td>
                                <td >{{$sold_final - ($TotalOperationIn - $TotalOperationOut) + $TotalCharges}}</td>
                              </tr>
                              <tr class="alert text-dark">
                                <td class="ml-2 text-center border-right font-weight-bold" colspan="">Sold Final</td>
                                <td id="sold_final" >{{$sold_final}}</td>
                              </tr>
                              <tr class="alert text-dark">
                                <td class="ml-2 text-center border-right font-weight-bold"  colspan="">Ecart</td>
                                <td id="ecart"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-3 row ">
                    <button class="btn ml-3 btn-block btn-primary  font-weight-medium" type="submit">CLÖTUREZ LA CAISSE</button>
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
          
        </div>

        <div class="row d-flex justify-content-center">
          

         
          
        </div>

    </div>    

        
        <script type="text/javascript">

          $(document).ready(function () {
            $(document).ready(function() {
            // Listen for changes in the input fields
            
            $("input[type='number']").on("change", function() {
              // Get the values of all 11 input fields and sum them up
              var total = 0;
              $("input[type='number']").each(function() {
                  var valeu = $(this).val();
                  var data = $(this).data('cat');
                  if (valeu !='' && data !='') {
                    total += parseFloat(valeu) * parseFloat(data);
                  }
              });

              
              $("#sold_total").val(total);

              $("#ecart").html(({{$sold_final}} - total)* (-1));
              if(({{$sold_final}} - total) === 0){
                $("#ecart").removeClass("alert-danger");
                $("#ecart").addClass("alert-success");
              }else{
                $("#ecart").removeClass("alert-success");
                $("#ecart").addClass("alert-danger");
              }
              
            });
          });
          });
      </script>
@endsection