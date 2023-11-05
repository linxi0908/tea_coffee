@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.pages.user.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Danh sách khách hàng</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                    </div>
                                    @if (session('message'))
                                        <div class="col-sm-12 alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            {{-- <th class="align-middle text-center" style="width: 10%">STT</th>
                                            <th class="align-middle text-center" style="width: 20%">Tên</th>
                                            <th class="align-middle text-center" style="width: 20%">Email</th>
                                            <th class="align-middle text-center" style="width: 20%">SĐT</th>
                                            <th class="align-middle text-center" style="width: 20%">Hạng</th> --}}
                                            <th class="text-center" >STT</th>
                                            <th class="text-center" >Tên</th>
                                            <th class="text-center" >Email</th>
                                            <th class="text-center" >SĐT</th>
                                            <th class="text-center" >Hạng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->phone }}</td>
                                                @php
                                                    $rank = $user->calculateTotalAmount();
                                                    if($rank >= 1000000){
                                                        $rankName = 'VIP';
                                                    }
                                                    elseif ($rank < 1000000) {
                                                        $rankName = 'Thành viên';
                                                    }
                                                @endphp
                                                <td class="text-center">
                                                    {{ $rankName }}
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
                                {{ $users->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



