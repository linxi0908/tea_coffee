@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        @include('admin.pages.product.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Danh sách sản phẩm</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary" href="{{ route('admin.product.create') }}"><i class="fas fa-plus"></i>   Thêm mới</a>
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
                                            <option {{ $status === '1' ? 'selected' : '' }} value="1">Hiển thị</option>
                                            <option {{ $status === '0' ? 'selected' : '' }} value="0">Ẩn</option>
                                        </select>
                                        <select name="featured" style="padding: 3px">
                                            <option value="">---Vui lòng chọn ---</option>
                                            <option {{ $featured === '1' ? 'selected' : '' }} value="1">Đặc sắc</option>
                                            <option {{ $featured === '0' ? 'selected' : '' }} value="0">Không đặc sắc</option>
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
                                            <th class="align-middle text-center" style="width: 10%">Tên</th>
                                            <th class="align-middle text-center" style="width: 15%">Tên loại sản phẩm</th>
                                            <th class="align-middle text-center" style="width: 25%">Hình ảnh</th>
                                            <th class="align-middle text-center" style="width: 10%">Giá</th>
                                            <th class="align-middle text-center" style="width: 10%">Trạng thái</th>
                                            <th class="align-middle text-center" style="width: 10%">Đặc sắc</th>
                                            <th class="align-middle text-center" style="width: 10%" colspan="3">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $product)
                                            <tr>
                                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                <td class="align-middle text-center">{{ $product->name }}</td>
                                                <td class="align-middle text-center">
                                                @if ($product->product_categories)
                                                    {{ $product->product_categories->name }}
                                                @else
                                                    {{ 'Unknown' }}
                                                @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                    $imagesLink = is_null($product->image) || !file_exists('images/products/' . $product->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg'
                                                    : asset('images/products/' . $product->image);
                                                    @endphp
                                                    <img src="{{ $imagesLink }}" alt="{{ $product->name }}" width="150"
                                                        height="150" />
                                                </td>
                                                <td class="align-middle text-center">{{ number_format($product->price, 0) }} </td>
                                                <td class="align-middle text-center">
                                                    <div style=" padding: 10px; border-radius:10%;color:#fff; {{ $product->status == "1" ? 'border: 1px solid #28a745;background:#28a745' : 'border: 1px solid #dc3545; background:#dc3545' }}">
                                                        {{ $product->status == "1" ? 'Hiện' : 'Ẩn' }}
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div  style=" padding: 10px ; border-radius:10%;color:#fff; {{ $product->featured == "1" ? 'border: 1px solid #28a745;background:#28a745' : 'border: 1px solid #dc3545; background:#dc3545' }}">
                                                        {{ $product->featured == "1" ? 'Có' : 'Không' }}
                                                    </div>
                                                </td>
                                                @if (!$product->trashed())
                                                    <td class="align-middle text-center">
                                                        <a href="{{ route('admin.product.show', $product->id) }}" class="btn">
                                                            <i class="fas fa-edit" style="color: blue;"></i>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button onclick="return confirm('Bạn có chắc không ?')" type="submit" class="btn">
                                                                <i class="fas fa-trash-alt" style="color: red;"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                                @if ($product->trashed())
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('admin.product.restore',$product->id) }}" class="btn"><i class="fa fa-refresh" style="color:green;"></i></a>
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
                                {{ $products->appends(['keyword' => $keyword, 'sortBy'=>$sortBy, 'status'=> $status, 'featured' => $featured])->links() }}
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
