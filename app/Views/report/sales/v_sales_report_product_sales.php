<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<?php
$request = \Config\Services::request();


if ($request->getGet('date_daily_weekly') != '') {
  $date_daily_weekly = $request->getGet('date_daily_weekly');
} else {
  $date_daily_weekly = date('m-Y');
}

if ($request->getGet('date_start')) {
  $date_start = $request->getGet('date_start');
} else {
  $date_start = date('d-m-Y');
}
if ($request->getGet('date_end')) {
  $date_end = $request->getGet('date_end');
} else {
  $date_end = date('d-m-Y');
}

if ($request->getGet('year_start')) {
  $year_start = $request->getGet('year_start');
} else {
  $year_start = date('Y');
}
if ($request->getGet('year_end')) {
  $year_end = $request->getGet('year_end');
} else {
  $year_end = date('Y');
}

if ($request->getGet('report_type') != '') {
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
                        <option value="daily">Daily</option>
                        <!-- <option value="weekly">Weekly</option> -->
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3" style="display:none" id="dayly_weekly">
                    <div class="form-group">
                      <label>Date :</label>
                      <div class="input-group date" id="date_daily_weekly_picker" data-target-input="nearest">
                        <input type="text" name="date_daily_weekly" id="date_daily_weekly" class="form-control datetimepicker-input" data-target="#date_daily_weekly_picker" />
                        <div class="input-group-append" data-target="#date_daily_weekly_picker" data-toggle="datetimepicker">
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

      $request = \Config\Services::request();
      if ($request->getGet('report_type') != '') {

      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

                <button class="btn btn-default btn-sm pull-right bg-flat-color-1" data-toggle="modal" data-target="#myModal" style="margin-left: 5px;">
                  <i class="fa fa-info-circle"></i>
                </button>
                <a id="download-graph" href="#" class="btn btn-default btn-sm pull-right bg-flat-color-1" title="Ekspor" style="margin-left: 5px;">
                  <i class="fa fa-download"></i>
                </a>
                <!-- <form method="post" class="form-no-horizontal-spacing" id="form-condensed" action="<?php ?>" enctype="multipart/form-data">




                  <button class="btn btn-default btn-sm pull-right bg-flat-color-1" style="margin-left: 5px;" title="Ekspor Excel" type="submit"><i class="fa fa-file-excel-o text-success"></i></button>

                </form> -->


                <div class="grid-body no-border" style="padding-bottom: 10px;">
                  <div id="loading">LOADING...</div>
                  <canvas id="canvas-graph"></canvas>
                </div>
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
    if (report_type == 'daily') {
      document.getElementById('dayly_weekly').style.display = 'block';
      //
      document.getElementById('date_daily_weekly').value = '';
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
      document.getElementById('date_daily_weekly').value = '';
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
        date_daily_weekly: "<?php echo $date_daily_weekly; ?>",
        report_type: "<?php echo $report_type; ?>",
        date_start: "<?php echo $date_start; ?>",
        date_end: "<?php echo $date_end; ?>",
        year_start: "<?php echo $year_start; ?>",
        year_end: "<?php echo $year_end; ?>",
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
        var data = JSON.parse(data);
        console.log(data);

        if (data['title-graph'] != '') {
          $("#title-graph").html(data['title-graph']);
          $("#description-graph").html(data['description-graph']);
          $("#download-graph").attr("download", data['title-graph'] + '.jpg');

          if (data['title-graph'] == 'daily') {
            // users_completion_rate (slow)
            var ctx = document.getElementById('canvas-graph').getContext('2d');
            var config_daily = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: data['day'],
                datasets: [{
                  label: 'Sales',
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: data['arr_jml'],
                  fill: false,
                }]
              },
              options: {
                responsive: true,
                title: {
                  display: true,
                  text: 'Sales Report Daily'
                },
                tooltips: {
                  mode: 'index',
                  intersect: false,
                },
                hover: {
                  mode: 'nearest',
                  intersect: true
                },
                scales: {
                  xAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Indicator'
                    }
                  }],
                  yAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Total (sales)'
                    }
                  }]
                },
                plugins: {
                  zoom: {
                    pan: {
                      enabled: true,
                      mode: 'xy'
                    },
                    zoom: {
                      sensitivity: 0.5,
                      drag: false,
                      enabled: true,
                      mode: 'x'
                    }
                  }
                }
              }
            });
          } else if (data['title-graph'] == 'monthly') {
            var ctx = document.getElementById('canvas-graph').getContext('2d');
            var config_monthly = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: data['monthly'],
                datasets: [{
                  label: 'Sales',
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: data['arr_jml'],
                  fill: false,
                }]
              },
              options: {
                responsive: true,
                title: {
                  display: true,
                  text: 'Sales Report Monthly'
                },
                tooltips: {
                  mode: 'index',
                  intersect: false,
                },
                hover: {
                  mode: 'nearest',
                  intersect: true
                },
                scales: {
                  xAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Indicator'
                    }
                  }],
                  yAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Total (sales)'
                    }
                  }]
                },
                plugins: {
                  zoom: {
                    pan: {
                      enabled: true,
                      mode: 'xy'
                    },
                    zoom: {
                      sensitivity: 0.5,
                      drag: false,
                      enabled: true,
                      mode: 'x'
                    }
                  }
                }
              }
            });
          } else if (data['title-graph'] == 'yearly') {
            var ctx = document.getElementById('canvas-graph').getContext('2d');
            var config_yearly = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: data['yearly'],
                datasets: [{
                  label: 'Sales',
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: data['arr_jml'],
                  fill: false,
                }]
              },
              options: {
                responsive: true,
                title: {
                  display: true,
                  text: 'Sales Report Monthly'
                },
                tooltips: {
                  mode: 'index',
                  intersect: false,
                },
                hover: {
                  mode: 'nearest',
                  intersect: true
                },
                scales: {
                  xAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Indicator'
                    }
                  }],
                  yAxes: [{
                    display: true,
                    scaleLabel: {
                      display: true,
                      labelString: 'Total (sales)'
                    }
                  }]
                },
                plugins: {
                  zoom: {
                    pan: {
                      enabled: true,
                      mode: 'xy'
                    },
                    zoom: {
                      sensitivity: 0.5,
                      drag: false,
                      enabled: true,
                      mode: 'x'
                    }
                  }
                }
              }
            });
          }
        }
      }
    });
  });
</script>
<?= $this->endsection(); ?>