@extends('layouts.app')

@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>Caisse Details</h4>
              <h6 class="font-weight-light text-success">---</h6>
              
              <form class="pt-3" >

                <div class="row">
                  <div class="form-group col-6">
                    <input type="number" name="n_200" data-cat="200" value="{{$caisseDetail->n_200}}" readonly class="form-control "  placeholder="Nbr 200 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="number" name="n_100" data-cat="100" value="{{$caisseDetail->n_100}}" readonly class="form-control "  placeholder="Nbr 100 DH">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <input type="number" name="n_50" data-cat="50" value="{{$caisseDetail->n_50}}" readonly class="form-control " placeholder="Nbr 50 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="number" name="n_20" data-cat="20" value="{{$caisseDetail->n_20}}" readonly class="form-control "  placeholder="Nbr 20 DH">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6"> 
                    <input type="number" name="n_10" data-cat="10" value="{{$caisseDetail->n_10}}" readonly class="form-control " placeholder="Nbr 10 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="number" name="n_5" data-cat="5" value="{{$caisseDetail->n_5}}" readonly class="form-control " placeholder="Nbr 05 DH">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <input type="number" name="n_2" data-cat="2" value="{{$caisseDetail->n_2}}" readonly class="form-control " placeholder="Nbr 02 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="number" name="n_1" data-cat="1" value="{{$caisseDetail->n_1}}" readonly class="form-control " placeholder="Nbr 10 DH">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <input type="number" name="n_05" data-cat="0.5" value="{{$caisseDetail->n_05}}" readonly class="form-control "  placeholder="Nbr 0.5 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="number" name="n_04" data-cat="0.2" value="{{$caisseDetail->n_04}}" readonly class="form-control "  placeholder="Nbr 0.4 DH">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <input type="number" name="n_02" data-cat="0.1" value="{{$caisseDetail->n_02}}" readonly class="form-control "  placeholder="Nbr 0.2 DH">
                  </div>
                  <div class="form-group col-6">
                    <input type="text" name="sold_total" class="form-control " value="{{$caisseDetail->sold_total}}" readonly id="sold_total"  placeholder="Sold Total">
                  </div>
                </div>

                <div class="mt-3 row d-flex">
                  <a class="btn btn-block btn-light  font-weight-medium  " href="{{route('caisse-details.index')}}" >RETOUR</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <script>
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

				// Set the sum in the output/input field
				$("#sold_total").val(total);
			});
		});
	</script>


@endsection
