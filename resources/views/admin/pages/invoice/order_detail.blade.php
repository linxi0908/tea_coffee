@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.invoice.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Chi tiết đơn hàng</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <section class="content">
                                <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-12">

                                      <!-- Main content -->
                                      <div class="invoice p-3 mb-3">
                                           <!-- title row -->
                                        <div class="row">
                                            <div class="col-12">
                                              <h4>
                                                <small class="float-right">Ngày: {{ ($order->created_at)->format('d/m/Y') }}</small>
                                              </h4>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- info row -->
                                          <div class="row invoice-info">
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                              <address>
                                                <strong>{{ $order->user->name }}</strong><br>
                                                {{ $order->address }}<br>
                                                Số điện thoại: {{ $order->user->phone }}<br>
                                                Email: {{ $order->user->email }}
                                              </address>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->


                                        <!-- Table row -->
                                        <div class="row">
                                          <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                              <thead>
                                              <tr>
                                                <th>STT</th>
                                                <th>Số lượng</th>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Tổng</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                                @foreach ($order_items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ number_format($item->product_price) }}</td>
                                                    <td>{{ number_format($item->qty * $item->product_price) }}</td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                          <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                          <!-- accepted payments column -->
                                          <div class="col-6">

                                          </div>
                                          <!-- /.col -->
                                          <div class="col-6">

                                            <div class="table-responsive">
                                              <table class="table">
                                                <tr>
                                                  <th style="width:50%">Tổng:</th>
                                                  <td>{{ number_format($order->total,0) }}</td>
                                                </tr>
                                                <tr>
                                                  <th>Tổng đơn hàng:</th>
                                                  <td>{{ number_format($order->total,0) }}</td>
                                                </tr>
                                              </table>
                                            </div>
                                          </div>
                                          <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row">
                                          <div class="col-6">
                                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-default float-left"><i class="fas fa-arrow-left"></i> Quay lại</a>
                                          </div>
                                          <div class="col-6">
                                            <a href="{{ route('admin.invoice.print',[$order->id]) }}" class="btn btn-default float-right"><i class="fas fa-print"></i> In</a>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.invoice -->
                                    </div><!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                </div><!-- /.container-fluid -->
                              </section>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
