@extends('layouts.master')
@section('title') Add New Products @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Products @endslot
@slot('title') Create Product @endslot
@endcomponent

<form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
    <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="product-title-input">Product Title</label>
                        <input type="text" class="form-control" id="product-title-input" name="name"
                            placeholder="Enter product title">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div>
                        <label>Product Description</label>

                        <textarea name="description" id="ckeditor-classic" cols="30" rows="10"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Product Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="fs-15 mb-1">Product Image</h5>
                        <p class="text-muted">Add Product main Image.</p>
                        <input class="form-control" id="product-image-input" type="file" name="image" accept="image/png, image/gif, image/jpeg">
                        @error('image_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                                            Brand</label>
                                            <div class="input-group mb-3">
                                                    <span class="input-group-text" id="product-price-addon">Rp</span>
                                                    <input type="text" name="price" class="form-control" id="product-price-input"
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
                                    <label class="form-label" for="product-stock-input">Stock</label>
                                            
                                        
                                                    <input type="number" name="stock" class="form-control" id="product-stock-input"
                                                        placeholder="Enter stock" aria-label="stock"
                                                        aria-describedby="product-stock-addon">
                                                        @error('stock')
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
                        <option value="Published" selected>Published</option>
                        <option value="Draft">Draft</option>
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

