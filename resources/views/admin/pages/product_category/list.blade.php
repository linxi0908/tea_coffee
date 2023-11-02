@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.product_category.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Danh sách loại sản phẩm</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.product_category.create') }}"><i class="fas fa-plus"></i>   Thêm mới</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <form method="get">
                                        <input type="text" value="{{ $keyword }}" placeholder="Tìm kiếm..."
                                            name="keyword">
                                        <select name="sortBy" style="padding: 3px">
                                            <option value="">---Vui lòng chọn---</option>
                                            <option {{ $sortBy === 'latest' ? 'selected' : '' }} value="latest">
                                                Mới nhất</option>
                                            <option {{ $sortBy === 'oldest' ? 'selected' : '' }} value="oldest">
                                                Cũ nhất</option>
                                        </select>
                                        <select name="status" style="padding: 3px">
                                            <option value="">---Vui lòng chọn ---</option>
                                            <option {{ $sortBy === '1' ? 'selected' : '' }}  value="1">Hiển thị</option>
                                            <option {{ $sortBy === '0' ? 'selected' : '' }} value="0">Ẩn</option>
                                        </select>
                                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                                    </form>
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
                                            <th class="align-middle text-center" style="width: 10%">STT</th>
                                            <th class="align-middle text-center" style="width: 20%">Tên</th>
                                            <th class="align-middle text-center" style="width: 20%">Hình ảnh</th>
                                            <th class="align-middle text-center" style="width: 20%">Số lượng sản phẩm</th>
                                            <th class="align-middle text-center" style="width: 10%">Hiển thị</th>
                                            <th class="align-middle text-center" style="width: 20%" colspan="3">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($productCategories as $productCategory)
                                            <tr>
                                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                <td class="align-middle text-center">{{ $productCategory->name }}</td>
                                                <td class="align-middle text-center">
                                                    @php
                                                    $imagesLink = is_null($productCategory->image) || !file_exists('images/product_categories/' . $productCategory->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                                    : asset('images/product_categories/' . $productCategory->image);
                                                    @endphp
                                                    <img src="{{ $imagesLink }}" alt="{{ $productCategory->name }}" width="150"
                                                        height="150" />
                                                </td>
                                                <td class="align-middle text-center">{{ $productCategory->product_count }}</td>
                                                <td class="align-middle text-center">
                                                    <div style=" padding: 10px; border-radius:10%;color:#fff; {{ $productCategory->status == "1" ? 'border: 1px solid #28a745;background:#28a745' : 'border: 1px solid #dc3545; background:#dc3545' }}">
                                                        {{ $productCategory->status == "1" ? 'Hiện' : 'Ẩn' }}
                                                    </div>
                                                </td>
                                                @if (!$productCategory->trashed())
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('admin.product_category.show',$productCategory->id) }}" class="btn"><i class="fas fa-edit" style="color:blue;"></i></a>

                                                </td>
                                                <td class="align-middle text-center">
                                                    <form action="{{ route('admin.product_category.destroy', $productCategory->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm('Bạn có chắc không ?')" type="submit" class="btn">
                                                            <i class="fas fa-trash-alt" style="color:red;"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endif
                                                @if ($productCategory->trashed())
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('admin.product_category.restore',$productCategory->id) }}" class="btn"><i class="fa fa-refresh" style="color:green;"></i></a>
                                                </td>
                                                @endif
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
                                {{ $productCategories->appends(['keyword' => $keyword, 'sortBy'=>$sortBy, 'status'=> $status])->links() }}
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
