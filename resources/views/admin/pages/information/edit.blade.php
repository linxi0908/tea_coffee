@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.pages.information.content_header')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- general form elements -->
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa thông tin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('admin.information.update', $information->id) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email"
                                        placeholder="Email" name="email" value="{{ $information->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hotline">Hotline</label>
                                        <input type="text" class="form-control" id="hotline"
                                        placeholder="Hotline" name="hotline" value="{{ $information->hotline }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone"
                                        placeholder="Số điện thoại" name="phone" value="{{ $information->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zalo">Zalo</label>
                                        <input type="text" class="form-control" id="zalo"
                                        placeholder="Zalo" name="zalo" value="{{ $information->zalo }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="chatzalo">Link chat Zalo</label>
                                        <input type="text" class="form-control" id="chatzalo"
                                        placeholder="Link chat Zalo" name="chatzalo" value="{{ $information->chatzalo }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control" id="website"
                                        placeholder="Website" name="website" value="{{ $information->website }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fanpage">Fanpage</label>
                                        <input type="text" class="form-control" id="fanpage"
                                        placeholder="Fanpage" name="fanpage" value="{{ $information->fanpage }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="chatfacebook">Link chat facebook</label>
                                        <input type="text" class="form-control" id="chatfacebook"
                                        placeholder="Link chat facebook" name="chatfacebook" value="{{ $information->chatfacebook }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="googlemap">Link google map</label>
                                        <input type="text" class="form-control" id="googlemap"
                                        placeholder="Link google map" name="googlemap" value="{{ $information->googlemap }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="googleiframe">Tọa độ google map iframe</label>
                                        <textarea class="form-control" id="googleiframe"
                                        style="height: 100p; padding:10px;"
                                        placeholder="Tọa độ google map iframe" name="googleiframe">{{ $information->googleiframe }}</textarea>
                                    </div>
                                </div>
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
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
</div>
@endsection
