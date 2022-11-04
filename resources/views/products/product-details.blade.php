@extends('layouts.master')
@section('title') Detail Product @endsection
@section('css')
    <link href="assets/libs/swiper/swiper.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Products @endslot
        @slot('title')Product Detail @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gx-lg-5">
                        <div class="col-xl-4 col-md-8 mx-auto">
                            <div class="product-img-slider sticky-side-div">
                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{ asset('public/product-image/'.$product->image_url) }}" alt=""
                                                class="img-fluid d-block" />
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-8">
                            <div class="mt-xl-0 mt-5">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h4>{{ $product->name }}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div class="text-muted">Published : <span
                                                    class="text-body fw-medium">{{ date('j F Y', strtotime($product->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{route('edit_products', $product->id)}}"
                                                class="btn btn-light" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div
                                                        class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Price :</p>
                                                    <h5 class="mb-0">@rupiah($product->price)</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div
                                                        class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-stack-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Available Stocks :</p>
                                                    <h5 class="mb-0">{{$product->stock}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>

                                <div class="mt-4 text-muted">
                                    <h5 class="fs-15">Description :</h5>
                                    <p>{{ str_replace(['<p>', '</p>'], '', $product->description) }}</p>
                                </div>
                                <!-- product-content -->
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="assets/libs/swiper/swiper.min.js"></script>
    <script src="assets/js/pages/ecommerce-product-details.init.js"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
