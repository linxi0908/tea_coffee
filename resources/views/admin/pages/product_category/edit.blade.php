@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.pages.product_category.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Chỉnh sửa loại sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('admin.product_category.update', $productCategory->id) }}" enctype="multipart/form-data">
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input name="name" type="text" value="{{ $productCategory->name }}"
                                            class="form-control" id="name" placeholder="Nhập tên">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text" value="{{ old('slug') }}"
                                            class="form-control" id="slug" placeholder="Tên-sản-phẩm">
                                        @error('slug')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="custom-select">
                                            <option value="">---Vui lòng chọn---</option>
                                            <option {{ $productCategory->status ? 'selected' : '' }} value="1">Hiển thị
                                            </option>
                                            <option {{ !$productCategory->status ? 'selected' : '' }} value="0">Ẩn
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh</label>
                                        <input name="image" type="file" class="form-control" id="image"
                                        style="width: 100%; font-size: 18px; line-height: 18px; border: 1px solid #dddddd; padding-bottom: 15px;"
                                        onchange="previewImages(event, 'previewImages')">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div id="previewImages" style="display: flex; flex-wrap: wrap;"></div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $('#name').val();

                $.ajax({
                    method: "POST", //method of form
                    url: "{{ route('admin.product_category.create.slug') }}", //action of form
                    data: {
                        'name': name,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#slug').val(response.slug);
                    }
                });
            });
        });
    </script>
@endsection
