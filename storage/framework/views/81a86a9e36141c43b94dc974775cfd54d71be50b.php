
<?php $__env->startSection('title'); ?> All Product <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.css')); ?>" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/gridjs/gridjs.min.css">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> All Products <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>Products <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">

    <div class="col-xl-12 col-lg-8">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="<?php echo e(route('create_product')); ?>" class="btn btn-success"><i
                                        class="ri-add-line align-bottom me-1"></i> Add Product</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" placeholder="Search Products...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
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
                                        All <span class="badge badge-soft-danger align-middle rounded-pill ms-1"><?php echo e($products->count()); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published"
                                        role="tab">
                                        Published <span class="badge badge-soft-danger align-middle rounded-pill ms-1"><?php echo e($published->count()); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft"
                                        role="tab">
                                        Draft <span class="badge badge-soft-danger align-middle rounded-pill ms-1"><?php echo e($draft->count()); ?></span>
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

                            <?php if($products->count() != 0): ?>
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Product Details</th>
                                  <th scope="col">Item Price</th>
                                  <th scope="col">Stock</th>
                                  <th scope="col" class="text-end">Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                        
                                    
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="<?php echo e(asset('public/product-image/'.$pro->image_url)); ?>" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-16"><a href="<?php echo e(route('show_product', $pro->id)); ?>" class="link-primary"><?php echo e($pro->name); ?></a></h5>
                                                <p class="text-muted mb-0">Date Published: <span class="fw-medium"><?php echo e(date('d-m-Y', strtotime($pro->created_at))); ?></span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>Rp. <?php echo number_format($pro->price,0,',','.'); ?></td>
                                    <td><?php echo e($pro->stock); ?></td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="<?php echo e(route('edit_products', $pro->id)); ?>" class="btn btn-secondary btn-sm"> Edit</a><br>
                                    <form action="<?php echo e(route('destroy_product', $pro->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>   
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                    
                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <?php else: ?>
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

                        <?php endif; ?>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="productnav-published" role="tabpanel">
                            <div id="table-product-list-published" class="table-card gridjs-border-none">
                            <?php if($published->count() != 0): ?>
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Product Details</th>
                                  <th scope="col">Item Price</th>
                                  <th scope="col">Stock</th>
                                  <th scope="col" class="text-end">Action</th>
</tr>   
                              </thead>
                            <tbody>
                                <?php $__currentLoopData = $published; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                        
                                    
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="<?php echo e(asset('public/product-image/'.$pub->image_url)); ?>" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-16"><a href="<?php echo e(route('show_product', $pub->id)); ?>" class="link-primary"><?php echo e($pub->name); ?></a></h5>
                                                <p class="text-muted mb-0">Date Published: <span class="fw-medium"><?php echo e(date('d-m-Y', strtotime($pub->created_at))); ?></span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>Rp. <?php echo number_format($pub->price,0,',','.'); ?></td>
                                    <td><?php echo e($pub->stock); ?></td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="<?php echo e(route('edit_products', $pub->id)); ?>" class="btn btn-secondary btn-sm"> Edit</a><br>
                                    <form action="<?php echo e(route('destroy_product', $pub->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?> 
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                    
                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <?php else: ?>
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

                        <?php endif; ?>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane" id="productnav-draft" role="tabpanel">
                        <?php if($draft->count() != 0): ?>
                            <table id="table-product" class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                  <th scope="col">Product Details</th>
                                  <th scope="col">Item Price</th>
                                  <th scope="col">Stock</th>
                                  <th scope="col" class="text-end">Action</th>
                                </tr>
                              </thead>
                            <tbody>
                                <?php $__currentLoopData = $draft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                        
                                    
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="<?php echo e(asset('public/product-image/'.$dra->image_url)); ?>" alt="" class="img-fluid d-block">
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-16"><a href="<?php echo e(route('show_product', $dra->id)); ?>" class="link-primary"><?php echo e($dra->name); ?></a></h5>
                                                <p class="text-muted mb-0">Date Published: <span class="fw-medium"><?php echo e(date('d-m-Y', strtotime($dra->created_at))); ?></span></p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>Rp. <?php echo number_format($dra->price,0,',','.'); ?></td>
                                    <td><?php echo e($dra->stock); ?></td>
                                    
                                    <td class="fw-medium text-end">
                                    <a href="<?php echo e(route('edit_products', $dra->id)); ?>" class="btn btn-secondary btn-sm"> Edit</a> <br>
                                    <form action="<?php echo e(route('destroy_product', $dra->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?> 
                                    <button class="btn btn-danger btn-sm"> Delete</button>
                                    </form>
                                    
                    
                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <?php else: ?>
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

                        <?php endif; ?>
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


    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('script'); ?>
    <script>
        $(document).ready( function () {
            $('#table-product').DataTable();
        } );
    </script>
    <script src="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/wnumb/wnumb.min.js')); ?>"></script>
    <script src="assets/libs/gridjs/gridjs.min.js"></script>
    <script src="https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js"></script>


    <script src="<?php echo e(URL::asset('assets/js/pages/ecommerce-product-list.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\test-mji\resources\views/products/products.blade.php ENDPATH**/ ?>