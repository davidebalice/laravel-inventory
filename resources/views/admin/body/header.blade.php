<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo-light.png') }}" alt="logo-sm" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo-light.png') }}" alt="logo-dark" height="40">
                    </span>
                </a>

                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo-light.png') }}" alt="logo-sm" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo-light.png') }}" alt="logo-dark" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-globe" style="font-size:20px"></i> 
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('changeLang', ['lang' => 'en']) }}" class="dropdown-item notify-item">
                        <img src="{{ asset('backend/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>
                    <a href="{{ route('changeLang', ['lang' => 'it']) }}" class="dropdown-item notify-item">
                        <img src="{{ asset('backend/assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italiano</span>
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            @php
                $id = Auth::user()->id;
                $data = App\Models\User::find($id);
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   
                    <div class="rounded-circle overflow-hidden d-xl-inline-block header-img-top">
                        <img class="h-100 w-auto justify-content-center" src="{{ (!empty($data->profile_image)) ? url('upload/admin/'.$data->profile_image) : url('upload/no_image.jpg') }}" alt="profile">                                   
                    </div>
                    <div class="d-xl-inline-block" style="verical-align:middle;margin-top:-10px">
                        <span class="d-none d-xl-inline-block ms-2">
                            {{ $data->name }}
                        </span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin.profile')}}">
                        <i class="ri-user-line align-middle me-1"></i> {{ __('messages.Profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('change.password') }}">
                        <i class="ri-wallet-2-line align-middle me-1"></i>
                        {{ __('passwords.ChangePassword') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>