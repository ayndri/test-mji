@extends('layouts.master')
@section('title') All Transaction @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/nouislider/nouislider.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/gridjs/gridjs.min.css">

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') All Transaction @endslot
@slot('title')Transaction @endslot
@endcomponent
<div class="row">

    <div class="col-xl-12 col-lg-8">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{route('create_trans')}}" class="btn btn-success"><i
                                        class="ri-add-line align-bottom me-1"></i> Add Transaction</a>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all"
                                        role="tab">
                                        All <span class="badge badge-soft-danger align-middle rounded-pill ms-1">{{ $transactions->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published"
                                        role="tab">
                                        Penambahan <span class="badge badge-soft-danger align-middle rounded-pill ms-1">{{ $penambahan->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft"
                                        role="tab">
                                        Pengurangan <span class="badge badge-soft-danger align-middle rounded-pill ms-1">{{ $pengurangan->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div id="selection-element">
                                <div class="my-n1 d-flex align-items-center text-muted">
                                    Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card header -->
                <div class="card-body">

                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="productnav-all" role="tabpanel">
                            <div id="table-product-list-all" class="table-card gridjs-border-none">

                            @if($transactions->count() != 0)
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Transaction Number</th>
                                  <th scope="col">Type</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Date Published</th>
                                  <th scope="col" class="text-end">Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                @foreach ($transactions as $tra)
                                <tr>
                                    
                                        
                                    
                                    <td>{{$tra->transaction_number}}</td>
                                    <td>{{$tra->type}}</td>
                                    <td>{{$tra->amount}}</td>
                                    <td>@rupiah($tra->price)</td>
                                    <td>{{ date('d-m-Y', strtotime($tra->date)) }}</td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="{{ route('edit_trans', $tra->id) }}" class="btn btn-secondary btn-sm"> Edit</a><br>
                                    <form action="{{ route('destroy_trans', $tra->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                    
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @else
                        <div class="py-4 text-center">
                                <div>
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                        style="width:72px;height:72px">
                                    </lord-icon>
                                </div>

                                <div class="mt-4">
                                    <h5>Sorry! No Result Found</h5>
                                </div>
                            </div>

                        @endif
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="productnav-published" role="tabpanel">
                            <div id="table-product-list-published" class="table-card gridjs-border-none">
                            @if($penambahan->count() != 0)
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Transaction Number</th>
                                  <th scope="col">Type</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Date Published</th>
                                  <th scope="col" class="text-end">Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                @foreach ($penambahan as $tambah)
                                <tr>
                                    
                                        
                                    
                                    <td>{{$tambah->transaction_number}}</td>
                                    <td>{{$tambah->type}}</td>
                                    <td>{{$tambah->amount}}</td>
                                    <td>@rupiah($tambah->price)</td>
                                    <td>{{ date('d-m-Y', strtotime($tambah->date)) }}</td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="{{ route('edit_trans', $tambah->id) }}" class="btn btn-secondary btn-sm"> Edit</a><br>
                                    <form action="{{ route('destroy_trans', $tambah->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                    
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @else
                        <div class="py-4 text-center">
                                <div>
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                        style="width:72px;height:72px">
                                    </lord-icon>
                                </div>

                                <div class="mt-4">
                                    <h5>Sorry! No Result Found</h5>
                                </div>
                            </div>

                        @endif
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="productnav-draft" role="tabpanel">
                        @if($pengurangan->count() != 0)
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Transaction Number</th>
                                  <th scope="col">Type</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Date Published</th>
                                  <th scope="col" class="text-end">Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                @foreach ($pengurangan as $kurang)
                                <tr>
                                    
                                        
                                    
                                    <td>{{$kurang->transaction_number}}</td>
                                    <td>{{$kurang->type}}</td>
                                    <td>{{$kurang->amount}}</td>
                                    <td>@rupiah($kurang->price)</td>
                                    <td>{{ date('d-m-Y', strtotime($kurang->date)) }}</td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="{{ route('edit_trans', $kurang->id) }}" class="btn btn-secondary btn-sm"> Edit</a><br>
                                    <form action="{{ route('destroy_trans', $kurang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')   
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                    
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @else
                        <div class="py-4 text-center">
                                <div>
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                        style="width:72px;height:72px">
                                    </lord-icon>
                                </div>

                                <div class="mt-4">
                                    <h5>Sorry! No Result Found</h5>
                                </div>
                            </div>

                        @endif
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->

    <!-- END layout-wrapper -->

   <!-- removeItemModal -->
   <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
           </div>
           <div class="modal-body">
               <div class="mt-2 text-center">
                   <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                       colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                   <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                       <h4>Are you Sure ?</h4>
                       <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Product ?</p>
                   </div>
               </div>
               <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                   <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn w-sm btn-danger " id="delete-product">Yes, Delete It!</button>
               </div>
           </div>

       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    @endsection
    @section('script')
    <script>
        $(document).ready( function () {
            $('#table-product').DataTable();
        } );
    </script>
    <script src="{{ URL::asset('assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/wnumb/wnumb.min.js') }}"></script>
    <script src="assets/libs/gridjs/gridjs.min.js"></script>
    <script src="https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js"></script>


    <script src="{{ URL::asset('assets/js/pages/ecommerce-product-list.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    @endsection
