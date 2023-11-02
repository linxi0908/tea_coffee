<div class="ltn__about-us-area pt-20 pb-80">
    <div class="container">
        <div class="row">
            @foreach ($abouts as $about)
            <div class="col-lg-7 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    @php
                        $imagesLink = is_null($about->image) || !file_exists('images/about/' . $about->image) ? 'https://phutungnhapkhauchinhhang.com/wp-content/uploads/2020/06/default-thumbnail.jpg' : asset('images/about/' . $about->image);
                    @endphp
                    <img src="{{ $imagesLink }}" alt="{{ $about->title }}">
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">Giới thiệu</h6>
                        <h1 class="section-title">{{ $about->title }}</h1>
                        <p>{!! $about->description !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
