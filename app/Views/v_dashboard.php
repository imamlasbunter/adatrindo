<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $h1; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">
              <?= $breadcrumb; ?>
            </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info">
            <h5>Welcome:</h5>
            <b><?php echo session()->get('name');  ?></b>
          </div>
        </div><!-- /.col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php foreach ($newOrder as $row) {
                    echo $row['jml'];
                  } ?></h3>

              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-6"> -->
        <!-- small box -->
        <!-- <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bank Cash</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div> -->
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        <!-- </div>
        </div> -->
        <!-- ./col -->
        <!-- <div class="col-lg-3 col-6"> -->
        <!-- small box -->
        <!-- <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>Payment Due Date</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div> -->
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        <!-- </div>
        </div> -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php foreach ($stockRepeat as $row) {
                    echo $row['jml'];
                  } ?></h3>

              <p>Sock Repeat</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sales
              </h3>
              <div class="card-tools">
                <!-- <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                  <i class="far fa-calendar-alt"></i>
                </button> -->
                <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <canvas id="canvas-graph"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sales
              </h3>
              <div class="card-tools">
                <!-- <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                  <i class="far fa-calendar-alt"></i>
                </button> -->
                <button type="button" class="btn btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <canvas id="popular-product"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $.ajax({
      method: "GET",
      data: {},
      url: "<?php echo site_url(); ?>dashboard/graph",
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

        }
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $.ajax({
      method: "GET",
      data: {},
      url: "<?php echo site_url(); ?>dashboard/popular-product",
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
        //console.log(data);
        $("#title-graph").html(data['title-graph']);
        $("#description-graph").html(data['description-graph']);
        $("#download-graph").attr("download", data['title-graph'] + '.jpg');

        var ctx = document.getElementById('popular-product').getContext('2d');
        var config = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data['arr_product_name'],
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
              text: 'Most Product Sales'
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
    });
  });
</script>
<?= $this->endsection(); ?>