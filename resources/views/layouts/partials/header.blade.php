<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard')}}" class="logo d-flex align-items-center">
            <!-- <img src="{{asset('/backend_assets/img/logo.png')}}" alt="{{ config('settings.website_name',config('app.name')) }}"> -->
            <img src="{{asset('/images/nbfc_logo.png')}}" alt="{{ config('settings.website_name',config('app.name')) }}">
            
{{--            <span class="d-none d-lg-block">{{ config('settings.website_name',config('app.name')) }}</span>--}}
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
                            <i class="bi bi-person"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('api-tokens.index') }}">
                                <i class="bi bi-gear"></i>
                                <span> {{ __('API Tokens') }}</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form id="adminLogoutForm" method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="document.getElementById('adminLogoutForm').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>{{ __('Log Out') }}</span>
                            </a>
                        </form>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>
</header>
@push('scripts')
<script type="module">
$(function () {
    $('#change_locale').change(function(){
        var langCode = $(this).val();
        redirectToUrl("{{ route('changeLanguage') }}","/"+langCode);
    });
});
</script>
@endpush