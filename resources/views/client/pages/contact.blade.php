<!-- CONTACT ADDRESS AREA START -->
<div class="ltn__contact-address-area mb-90">
    <div class="container">
        <div class="row">
            @foreach ($contacts as $contact)
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/client/img/icons/10.png') }}" alt="Icon Image">
                    </div>
                    <h3>Địa chỉ Email</h3>
                    <p>{{ $contact->email }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/client/img/icons/11.png') }}" alt="Icon Image">
                    </div>
                    <h3>Số điện thoại</h3>
                    <p>{{ $contact->hotline }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('assets/client/img/icons/12.png') }} " alt="Icon Image">
                    </div>
                    <h3>Địa chỉ</h3>
                    <p>{{ $contact->address }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- CONTACT ADDRESS AREA END -->

<!-- GOOGLE MAP AREA START -->
<div class="google-map mb-0">
    @foreach ($informations as $information)
    <iframe src="{!! $information->googleiframe !!}" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    @endforeach
</div>
<!-- GOOGLE MAP AREA END -->
