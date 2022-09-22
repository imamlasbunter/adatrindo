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
            This page contains reports stock in out.
          </div>
        </div><!-- /.col -->
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              This section contains report stock in
            </div>
            <div class="card-body">
              <p> To view graphs stock in report click on the following page. </p>
              <a href="<?= base_url('stock-in-out-report/stock-in'); ?>">Link</a>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              This section contains report stock out
            </div>
            <div class="card-body">
              <p>To view graphs stock out click on the following page</p>
              <a href="<?= base_url('stock-in-out-report/stock-out'); ?>">Link</a>
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