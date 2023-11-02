@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Đơn hàng</span>
                <span class="info-box-number">
                  {{ $orderCount }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sản phẩm</span>
                <span class="info-box-number">{{ $productCount }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Doanh thu</span>
                <span class="info-box-number">{{ number_format($orderTotal) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Khách hàng</span>
                <span class="info-box-number">{{ $userCount }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Báo cáo doanh thu</h5>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="chart">
                          <!-- Sales Chart Canvas -->
                          <div id="columnchart_material" style="width: 100%; height: 250px"></div>
                        </div>
                        <!-- /.chart-responsive -->
                      </div>

                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>

                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Tình trạng đơn hàng</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                    <div id="order-summary" style="width: 100%; height: 250px"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>

                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>

              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>


          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('js-custom')
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(@json($arrayDatas));
            var options = {
                // title: 'Trạng thái đơn hàng',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('order-summary'));
            chart.draw(data, options);

            //
            var data2 = google.visualization.arrayToDataTable(<?php echo json_encode($arrayDatas2); ?>);

            var options2 = {
                legend: { position: 'none' },
                hAxis: {
                    title: 'Ngày'
                },
                vAxis: {
                    title: 'Doanh thu (VNĐ)'
                }
            };

            var chart2 = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
            chart2.draw(data2, options2);
        }

    </script>

@endsection
