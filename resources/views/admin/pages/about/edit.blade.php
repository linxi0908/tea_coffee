@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.pages.about.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="col-sm-12 alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa thông tin trang giới thiệu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <form role="form" method="post" action="{{ route('admin.about.update', $about->id) }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $about->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Hiển thị</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tiêu đề:</label>
                                        <input type="text" class="form-control" placeholder="Nhập tiêu đề"
                                        style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; margin-bottom: 20px;"
                                        name="title" value="{{ $about->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Nội dung 1</label>
                                        <textarea placeholder="Nhập nội dung" class="form-control" name="description" id="description">{{ $about->description }}</textarea>
                                        @error('description')
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
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                                    </div>

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

@section('js-custom')
    <script>
            ClassicEditor
            .create(document.querySelector('#description'), {

            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
