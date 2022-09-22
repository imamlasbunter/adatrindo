<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Main Menu</li>
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
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page contains reports on sales.
          </div>
        </div><!-- /.col -->
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              This section contains report on sales
            </div>
            <div class="card-body">
              <p> To view graphs or sales report data dayly, monthly, and yearly click on the following page. </p>
              <a href="<?= base_url('sales-report/product-sales'); ?>">Link</a>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              This section contains report on the most product sales
            </div>
            <div class="card-body">
              <p>To view graphs or sales report data for today, weekly, monthly, and yearly the most product sales click on the following page</p>
              <a href="<?= base_url('sales-report/popular-product'); ?>">Link</a>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              This section contains report of invoice
            </div>
            <div class="card-body">
              <p>To view invoice data click on the following page</p>
              <a href="<?= base_url('sales-report/invoice'); ?>">Link</a>
            </div>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script>
  function printPdf() {
    window.addEventListener("load", window.print());
  }
</script>
<?= $this->endsection(); ?>