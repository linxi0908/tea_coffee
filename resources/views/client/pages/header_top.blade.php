<div class="ltn__header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="ltn__top-bar-menu">
                    <ul>
                        @foreach ($contacts as $contact)
                        <li><a href="{{ route('contact') }}"><i class="icon-placeholder"></i>{{ $contact->address }}</a></li>
                        <li><a href="mailto:{{ $contact->address }}"><i class="icon-mail"></i>{{ $contact->email }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="top-bar-right text-right">
                    <div class="ltn__top-bar-menu">
                        <ul>
                            <li>
                                <!-- ltn__social-media -->
                                <div class="ltn__social-media">
                                    <ul>
                                        @foreach ($informations as $information)
                                        <li><a href="{{ $information->fanpage }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#" title="Youte"><i class="fab fa-youtube"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
