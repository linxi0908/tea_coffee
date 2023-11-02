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
                                        <h3 class="card-title">Danh sách đơn hàng</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.invoices.create') }}"><i class="fas fa-plus"></i>   Tạo mới</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('message'))
                                    <div class="col-sm-12 alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <table class="table justify-content-center">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center" style="width: 5%">STT</th>
                                            <th class="align-middle text-center" style="width: 20%">Thời gian</th>
                                            <th class="align-middle text-center" style="width: 20%">Khách hàng</th>
                                            <th class="align-middle text-center" style="width: 10%">Giá trị</th>
                                            <th class="align-middle text-center" style="width: 25%">Địa chỉ</th>
                                            <th class="align-middle text-center" style="width: 15%">Trạng thái</th>
                                            <th class="align-middle text-center" style="width: 5%">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                        <tr>
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">{{ ($order->created_at)->format('d/m/Y') }}</td>
                                            <td class="align-middle text-center">{{ $order->user->name }}</td>
                                            <td class="align-middle text-center">{{ number_format($order->total) }}</td>
                                            <td class="align-middle text-center">{{ $order->address }}</td>
                                            <td class="align-middle text-center">{{ $order->status }}</td>
                                            <td class="align-middle text-center" >
                                                <a href="{{ route('admin.invoices.show',[$order->id])}}" class="btn"><i class="fa fa-eye" style="color:blue;"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $orders->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
