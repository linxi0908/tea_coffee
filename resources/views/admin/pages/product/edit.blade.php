@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.pages.product.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Thêm sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input name="name" type="text" value="{{ $product->name }}"
                                            class="form-control" id="name" placeholder="Nhập tên">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input name="slug" type="text" value="{{ $product->slug }}"
                                            class="form-control" id="slug" placeholder="Tên-sản-phẩm">
                                        @error('slug')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá</label>
                                        <input name="price" type="number" value="{{ $product->price }}"
                                            class="form-control" id="price" placeholder="Nhập giá">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_price">Giá giảm</label>
                                        <input name="discount_price" type="number" value="{{ $product->discount_price }}"
                                            class="form-control" id="discount_price" placeholder="Nhập giá giảm">
                                        @error('discount_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea placeholder="Nhập mô tả" class="form-control" name="description" id="description">{{ $product->description }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <select name="product_category_id" class="custom-select">
                                            <option value="">---Vui lòng chọn---</option>
                                            @foreach ($productCategories as $productCategory)
                                                <option
                                                {{ $product->product_category_id == $productCategory->id ? 'selected' : '' }}
                                                 value="{{ $productCategory->id }}">{{ $productCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_category_id')
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
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="custom-select">
                                            <option value="">---Vui lòng chọn---</option>
                                            <option {{ $product->status ? 'selected' : '' }} value="1">Hiển thị
                                            </option>
                                            <option {{ !$product->status ? 'selected' : '' }} value="0">Ẩn
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Đặc sắc</label>
                                        <select name="featured" class="custom-select">
                                            <option value="">---Vui lòng chọn---</option>
                                            <option {{ $product->featured ? 'selected' : '' }} value="1">Có
                                            </option>
                                            <option {{ !$product->featured ? 'selected' : '' }} value="0">Không
                                            </option>
                                        </select>
                                        @error('featured')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    // Upload the images to the server using the CKFinder QuickUpload command.
                    uploadUrl: '{{ route('admin.product.upload.image') . '?_token=' . csrf_token() }}'
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $('#name').val();

                $.ajax({
                    method: "POST", //method of form
                    url: "{{ route('admin.product.create.slug') }}", //action of form
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
