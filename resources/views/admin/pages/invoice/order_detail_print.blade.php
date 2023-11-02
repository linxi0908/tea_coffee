@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.invoice.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div>
                                <div class="row">
                                    <div class="col-md-12" style=" display:flex; justify-content:center; padding: 10px">
                                        <img style="width:80px; height:80px" src="{{ asset('assets/admin/dist/img/logo.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style=" display:flex; justify-content:center; padding: 10px">
                                        <h4 style="text-align:center">Linxi Tea & Coffee</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align:center; list-style:none;">
                                        @foreach ($contacts as $contact)
                                        <li>{{ $contact->address }}</li>
                                        <li>SĐT: {{ $contact->hotline }}  - Email: {{ $contact->email }}</li>
                                        @endforeach
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
                                                <h3 style="text-align:center">HÓA ĐƠN BÁN HÀNG</h3>
                                              <h4>
                                                <small class="float-left">Ngày: {{ ($order->created_at)->format('d/m/Y') }}</small>
                                                <small class="float-right">Số: {{ ($order->id) }}</small>
                                                <br>
                                                <small class="float-left">Thu ngân: {{ Auth::user()->name }}</small>
                                                <small class="float-right">In lúc: {{ \Carbon\Carbon::now(+7)->format('h:m') }}</small>
                                                <br>
                                            </h4>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- info row -->
                                          <div class="row invoice-info">
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
                                        <div class="row no-print">
                                          <div class="col-12">
                                            {{-- <a href="{{ route('admin.invoice.print') }}" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a> --}}
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
                        <div class="col-md-12" style="text-align:center;">
                            <p>Cảm ơn quý khách. Hẹn gặp lại!</p>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-default float-left"><i class="fas fa-arrow-left"></i> Quay lại</a>
                          </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js-custom')
<script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
@endsection
