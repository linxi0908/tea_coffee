@extends('client.layout.master')

@section('page_header')
@include('client.pages.checkout.page_header')
@endsection

@section('cart')
@include('client.pages.checkout')
@endsection

@section('js-custom')
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
    method: "GET",
    responseType: "application/json",
    };

    var promise = axios(Parameter);

    promise.then(function (result) {
    renderCity(result.data);
    });

    function renderCity(data) {
    for (const x of data) {
        if (x.Id === "79") {
        citis.options[citis.options.length] = new Option(x.Name, x.Id);
        citis.value = x.Id;
        citis.disabled = true; // Vô hiệu hóa chọn thay đổi thành phố
        break;
        }
    }

    // Hiển thị dropdown của huyện khi thành phố được chọn
    var selectedCity = data.find((city) => city.Id === "79");
    if (selectedCity) {
        for (const district of selectedCity.Districts) {
        districts.options[districts.options.length] = new Option(
            district.Name,
            district.Id
        );
        }
    }

    // Xử lý khi thay đổi quận huyện thì sẽ hiển thị ra phường xã thuộc quận huyện đó
    districts.onchange = function () {
        ward.length = 1;
        const selectedDistrict = selectedCity.Districts.find(
        (dist) => dist.Id === this.value
        );
    };
    }

    renderCity(); // Gọi hàm renderCity để hiển thị danh sách thành phố và chọn thành phố có ID là 79 mặc định.
</script>
@endsection
