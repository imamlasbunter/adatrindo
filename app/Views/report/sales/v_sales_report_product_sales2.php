<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<?php
$request = \Config\Services::request();

if ($request->getGet('date_dayly_weekly')) {
  $date_dayly_weekly = $request->getGet('date_dayly_weekly');
} else {
  $date_dayly_weekly = date('m-Y');
}

if ($request->getGet('report_type')) {
  $report_type = $request->getGet('report_type');
} else {
  $report_type = '';
}

?>

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
              <form action="<?php echo site_url('sales-report/product-sales'); ?>" method="GET">
                <?= csrf_field(); ?>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Report Type :</label>
                      <select name="report_type" id="report_type" class="form-control select2" style="width: 100%; height:100%;" onchange="typeReport()">
                        <option value="" selected>--Select--</option>
                        <option value="dayly">Dayly</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3" style="display:none" id="dayly_weekly">
                    <div class="form-group">
                      <label>Date :</label>
                      <div class="input-group date" id="date_dayly_weekly_picker" data-target-input="nearest">
                        <input type="text" name="date_dayly_weekly" id="date_dayly_weekly" class="form-control datetimepicker-input" data-target="#date_dayly_weekly_picker" />
                        <div class="input-group-append" data-target="#date_dayly_weekly_picker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3" style="display:none" id="date_start_target">
                    <div class="form-group">
                      <label>Date Start :</label>
                      <div class="input-group date" id="date_start_picker" data-target-input="nearest">
                        <input type="text" name="date_start" id="date_start" class="form-control datetimepicker-input" data-target="#date_start_picker" />
                        <div class="input-group-append" data-target="#date_start_picker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3' style="display:none" id="date_end_target">
                    <div class="form-group">
                      <label>Date End :</label>
                      <div class="input-group date" id="date_end_picker" data-target-input="nearest">
                        <input type="text" name="date_end" id="date_end" class="form-control datetimepicker-input" data-target="#date_end_picker" />
                        <div class="input-group-append" data-target="#date_end_picker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3" style="display:none" id="year_start_target">
                    <div class="form-group">
                      <label>Year Start :</label>
                      <div class="input-group date" id="year_start_picker" data-target-input="nearest">
                        <input type="text" name="year_start" id="year_start" class="form-control datetimepicker-input" data-target="#year_start_picker" />
                        <div class="input-group-append" data-target="#year_start_picker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3' style="display:none" id="year_end_target">
                    <div class="form-group">
                      <label>Year End :</label>
                      <div class="input-group date" id="year_end_picker" data-target-input="nearest">
                        <input type="text" name="year_end" id="year_end" class="form-control datetimepicker-input" data-target="#year_end_picker" />
                        <div class="input-group-append" data-target="#year_end_picker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--row -->
                <div class="clearfix"></div>
                <hr />
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.row -->
      <?php
      if ($report_type != '') {
      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="grid simple">
              <div class="grid-title no-border">
                <button class="btn btn-default btn-sm pull-right bg-flat-color-1" data-toggle="modal" data-target="#myModal" style="margin-left: 5px;">
                  <i class="fa fa-info-circle"></i>
                </button>
                <a id="download-graph" href="#" class="btn btn-default btn-sm pull-right bg-flat-color-1" title="Ekspor" style="margin-left: 5px;">
                  <i class="fa fa-download"></i>
                </a>
                <form method="post" class="form-no-horizontal-spacing" id="form-condensed" action="<?php ?>" enctype="multipart/form-data">



                  <button class="btn btn-default btn-sm pull-right bg-flat-color-1" style="margin-left: 5px;" title="Ekspor Excel" type="submit"><i class="fa fa-file-excel-o text-success"></i></button>

                </form>
              </div>
              <div class="grid-body no-border" style="padding-bottom: 10px;">
                <div id="loading">LOADING...</div>
                <canvas id="canvas-graph"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <center>
                  <p class="text-danger">
                  <h5><i class="fa fa-info-circle modal-icon"></i> <b><span id="title-graph"></span></b></h5>
                  <br />
                  <span id="description-graph"></span>
                  </p>
                  <br />
                  <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                </center>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function typeReport() {
    var report_type = document.getElementById('report_type').value;
    // alert(report_type);
    if (report_type == 'dayly') {
      document.getElementById('dayly_weekly').style.display = 'block';
      //
      document.getElementById('date_dayly_weekly').value = '';
      document.getElementById('date_start_target').style.display = 'none';
      document.getElementById('date_end_target').style.display = 'none';
      document.getElementById('date_start_target').value = '';
      document.getElementById('date_end_target').value = '';
      document.getElementById('year_start_target').style.display = 'none';
      document.getElementById('year_end_target').style.display = 'none';
      document.getElementById('year_start_target').value = '';
      document.getElementById('year_end_target').value = '';
    } else if (report_type == 'weekly') {
      document.getElementById('dayly_weekly').style.display = 'block';
      //
      document.getElementById('date_dayly_weekly').value = '';
      document.getElementById('date_start_target').style.display = 'none';
      document.getElementById('date_end_target').style.display = 'none';
      document.getElementById('date_start_target').value = '';
      document.getElementById('date_end_target').value = '';
      document.getElementById('year_start_target').style.display = 'none';
      document.getElementById('year_end_target').style.display = 'none';
      document.getElementById('year_start_target').value = '';
      document.getElementById('year_end_target').value = '';
    } else if (report_type == 'monthly') {
      document.getElementById('date_start_target').style.display = 'block';
      document.getElementById('date_end_target').style.display = 'block';
      //
      document.getElementById('dayly_weekly').style.display = 'none';
      document.getElementById('dayly_weekly').value = '';
      document.getElementById('year_start_target').style.display = 'none';
      document.getElementById('year_end_target').style.display = 'none';
      document.getElementById('year_start_target').value = '';
      document.getElementById('year_end_target').value = '';

    } else if (report_type == 'yearly') {
      document.getElementById('year_start_target').style.display = 'block';
      document.getElementById('year_end_target').style.display = 'block';
      //
      document.getElementById('date_start_target').style.display = 'none';
      document.getElementById('date_end_target').style.display = 'none';
      document.getElementById('date_start_target').value = '';
      document.getElementById('date_end_target').value = '';
      document.getElementById('dayly_weekly').style.display = 'none';
      document.getElementById('dayly_weekly').value = '';
    }
  }
</script>
<script>
  $(document).ready(function() {
    $.ajax({
      method: "POST",
      data: {
        date_dayly_weekly: "<?php echo $date_dayly_weekly; ?>",
      },
      url: "<?php echo site_url(); ?>sales-report/product-sales/graph",
      cache: false,
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
      },
      beforeSend: function() {
        $('#loading').show();
      },
      complete: function() {
        $("#loading").html(' ');
      },
      success: function(data) {
        // var data = JSON.parse(data);
        // console.log(data);

        if (data['title-graph'] != null) {
          $("#title-graph").html(data['title-graph']);
          $("#description-graph").html(data['description-graph']);
          $("#download-graph").attr("download", data['title-graph'] + '.jpg');

          if (data['graph_type'] == 'dayly') {
            // users_completion_rate (slow)
            var ctx = document.getElementById('canvas-graph').getContext('2d');
            var config_user_completion_rate = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ['day'],
                datasets: [{
                  label: 'Dayly Report',
                  backgroundColor: window.chartColors.yellow,
                  borderColor: window.chartColors.yellow,
                  data: data['arr_jml'],
                  fill: false,
                }]
              },
              options: {
                responsive: true,
                title: {
                  display: true,
                  text: 'Sales Report Dayly'
                },
                tooltips: {
                  mode: 'index',
                  intersect: false,
                },
                hover: {
                  mode: 'nearest',
                  intersect: true
                },
              }
            });
          }
        }
      }
    });
  });
</script>
<?= $this->endsection(); ?>