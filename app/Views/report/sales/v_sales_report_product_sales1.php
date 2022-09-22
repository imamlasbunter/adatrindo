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
            <li class="breadcrumb-item"><?= $h1; ?></li>
            <li class="breadcrumb-item active"><?= $h2; ?></li>
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
          <div class="card">
            <div class="card-header">
              Report on Sales
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Type Report :</label>
                    <select class="form-control select2" style="width: 100%; height:100%;">
                      <option value="">--Select--</option>
                      <option value="dayly">Dayly</option>
                      <option value="weekly">Weekly</option>
                      <option value="monthly">Monthly</option>
                      <option value="yearly">Yearly</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Date -->
                  <div class="form-group">
                    <label>Month :</label>
                    <select name="month" class="form-control select2" style="width: 100%; height:100%;">
                      <option value="">--Select--</option>
                      <option value="01">January</option>
                      <option value="02">Feburary</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Date -->
                  <div class="form-group">
                    <label>Year :</label>
                    <select name="year" class="form-control select2" style="width: 100%; height:100%;">
                      <option value="">--Select--</option>
                      <?php
                      for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                        echo "<option value='$i'> $i </option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- Date -->
                  <div class="form-group">
                    <label>Date End :</label>
                    <div class="input-group date">
                      <input class="form-control" id="date_timepicker_end" type="text" value="">

                    </div>
                  </div>
                </div>
                <!--row-->


              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endsection(); ?>