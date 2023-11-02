@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.pages.contact.content_header')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Thêm thông tin trang Liên hệ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <form method="post" action="{{ route('admin.contact.store') }}">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" placeholder="Nhập email"
                                    style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; margin-bottom: 20px;"
                                    name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="hotline">Hotline:</label>
                                    <input type="text" class="form-control" placeholder="Nhập hotline"
                                    style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; margin-bottom: 20px;"
                                    name="hotline" value="{{ old('hotline') }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ"
                                    style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; margin-bottom: 20px;"
                                    name="address" value="{{ old('address') }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
@endsection
