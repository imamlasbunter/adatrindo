<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Setting</li>
                        <li class="breadcrumb-item active"><?= $h1; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <?php /// $breadcrumb; 
                            ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-6">
                            <!-- TABLE: Caategory -->
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Product Categories</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive table-striped table-sm table-hover">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!$productCategories) : ?>
                                                    <tr>

                                                        <td colspan="5">No data display</td>


                                                    </tr>
                                                <?php else : ?>
                                                    <?php $no = 1 + (10 * ($currentPage - 1));
                                                    foreach ($productCategories as $row) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $row['category']; ?></td>

                                                        </tr>


                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <a href="<?= base_url('products/category/add') ?>" class="btn btn-sm btn-primary float-left">Add Product Category</a>
                                    <a href="<?= base_url('products/category') ?>" class="btn btn-sm btn-info float-right">View All</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <!-- Right col-->
                        <div class="col-md-6">
                            <!-- TABLE: Caategory -->
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Product Units</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive table-striped table-sm table-hover">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!$productUnits) : ?>
                                                    <tr>

                                                        <td colspan="5">No data display</td>


                                                    </tr>
                                                <?php else : ?>
                                                    <?php $no = 1 + (10 * ($currentPage - 1));
                                                    foreach ($productUnits as $row) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $row['unit']; ?></td>

                                                        </tr>


                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <a href="<?= base_url('products/units/add') ?>" class="btn btn-sm btn-primary float-left">Add Product Unit</a>
                                    <a href="<?= base_url('products/units') ?>" class="btn btn-sm btn-info float-right">View All</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <!-- Right col-->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Products</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('products/items/add') ?>">Add Product Items</a></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Qty Minimum</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Puchase Price</th>
                                        <th scope="col">Last Purchase Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['product_code']; ?></td>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?= $row['quantity']; ?></td>
                                            <td><?= $row['minimum_quantity']; ?></td>
                                            <td><?= $row['unit']; ?></td>
                                            <td><?= $row['purchase_price']; ?></td>
                                            <td><?= $row['last_purchase_price']; ?></td>
                                            <td><?= $row['selling_price']; ?></td>
                                            <td><?= $row['category']; ?></td>
                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('products/items/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                <a class="btn btn-danger btn-xs" href="<?= base_url('products/items/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>