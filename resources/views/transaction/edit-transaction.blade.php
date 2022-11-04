@extends('layouts.master')
@section('title') Edit Transaction @endsection
@section('css')
<style>
    .select2-container {
    width: 100% !important;
}
</style>
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Transaction @endslot
@slot('title') Edit Transaction @endslot
@endcomponent

<form action="{{ route('update_trans', $transactions->t_id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
<div class="row">
    <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="product-title-input">Product</label>
                        <select class="livesearch form-select form-control" value="{{ $transactions->id_product }}" name="id_product" id="choices-publish-status-input" disabled>
                        <option value="{{ $transactions->id_product }}" selected> {{ $transactions->p_name }} </option>
            
                        </select>
                        
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div>
                        <label>Date Transaction</label>

                        <input class="date form-control" value="{{ $transactions->date->format('d-m-Y') }}" name="date" type="text">

                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                role="tab">
                                General Info
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                    <label class="form-label" for="product-price-input">Price</label>
                                          
                                            <div class="input-group mb-3">
                                                    <span class="input-group-text" id="product-price-addon">Rp</span>
                                                    <input type="text" name="price" value="@rupiahedit($transactions->t_price)" class="form-control" id="product-price-input"
                                                        placeholder="Enter price" aria-label="Price"
                                                        aria-describedby="product-price-addon">
                                                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                                                </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-amount-input">Amount</label>
                                            
                                        
                                                    <input type="number" name="amount" class="form-control" id="product-amount-input"
                                                        placeholder="Enter amount" value="{{ $transactions->amount }}" aria-label="amount"
                                                        aria-describedby="product-amount-addon">
                                                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                              
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="product-amount-input">Type</label>
                                            
                                        
                                    <div class="form-check">
  <input class="form-check-input" type="radio" name="type" value="penambahan"id="flexRadioDefault1"  @if ($transactions->type == 'penambahan') checked @endif >
  <label class="form-check-label" for="flexRadioDefault1">
    Penambahan
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="type" value="pengurangan" id="flexRadioDefault2"  @if ($transactions->type == 'pengurangan') checked @endif >
  <label class="form-check-label" for="flexRadioDefault2">
    Pengurangan
  </label>
</div>
                                                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                              
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end tab-pane -->
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
            
        </form>


    </div>
    <!-- end col -->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Publish</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="choices-publish-status-input" class="form-label">Status</label>

                    <select class="form-select" name="status" id="choices-publish-status-input" data-choices data-choices-search-false>
                        <option value="published" selected>Published</option>
                    </select>
                </div>
            </div>
            
            <!-- end card body -->
        </div>

        <div class="text-end mb-3">
                <button type="submit" class="btn btn-success w-sm">Submit</button>
            </div>
        <!-- end card -->

    </div>
</div>
</form>
<!-- end row -->
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy',
       autoclose: true,
        todayHighlight: true
     });  
</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $('.livesearch').select2({
        placeholder: 'Select product',
        ajax: {
            url: '/ajax-autocomplete-search',
            dataType: 'json',
            width:'resolve',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            // cache: true
        }
    });
</script>

<script type="text/javascript">
		
		var rupiah = document.getElementById('product-price-input');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value);
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>

<script src="assets/libs/@ckeditor/@ckeditor.min.js"></script>

<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="assets/js/pages/ecommerce-product-create.init.js"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

