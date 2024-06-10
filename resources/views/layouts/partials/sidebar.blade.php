<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard')?'':'collapsed' }}" href="{{ route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>{{__('Dashboard')}}</span>
            </a>
        </li>

        @canany(['user list', 'role list', 'permission list'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['user.*','role.*','permission.*'])?'':'collapsed' }}"
                   data-bs-target="#authentication-components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>{{__('Authentication')}}</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="authentication-components-nav"
                    class="nav-content collapse {{ request()->routeIs(['user.*','role.*','permission.*'])?'show':'' }} "
                    data-bs-parent="#sidebar-nav">
                    @can('user list')
                        <li>
                            <a class="{{ request()->routeIs('user.*')?'active':'' }}" href="{{ route('user.index')}}">
                                <i class="bi bi-circle"></i><span>{{__('Users')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('role list')
                        <li>
                            <a class="{{ request()->routeIs('role.*')?'active':'' }}" href="{{ route('role.index')}}">
                                <i class="bi bi-circle"></i><span>{{__('Roles')}}</span>
                            </a>
                        </li>
                    @endcan
                    @can('permission list')
                        <li>
                            <a class="{{ request()->routeIs('permission.*')?'active':'' }}"
                               href="{{ route('permission.index')}}">
                                <i class="bi bi-circle"></i><span>{{__('Permissions')}}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['region::region.*','master::branch.*','master::designation.*','master::department.*','master::loan_type.*', 'master::document.*','master::sub_document.*','master::banner.*'])?'':'collapsed' }}"
               data-bs-target="#master-components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection"></i><span>{{__('Master Modules')}}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-components-nav"
                class="nav-content collapse {{ request()->routeIs(['region::region.*','master::branch.*','master::designation.*','master::department.*','master::loan_type.*','master::document.*','master::sub_document.*','master::banner.*'])?'show':'' }} "
                data-bs-parent="#sidebar-nav">
                    @if(Route::has('region::region.index'))
                        @can('region::region list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('region::region.*')?'':'collapsed' }}"
                                   href="{{ route('region::region.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Regions')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::branch.index'))
                        @can('master::branch list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::branch.*')?'':'collapsed' }}"
                                   href="{{ route('master::branch.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Branches')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::designation.index'))
                        @can('master::designation list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::designation.*')?'':'collapsed' }}"
                                   href="{{ route('master::designation.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Designations')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::department.index'))
                        @can('master::department list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::department.*')?'':'collapsed' }}"
                                   href="{{ route('master::department.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Departments')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::loan_type.index'))
                        @can('master::loan_type list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::loan_type.*')?'':'collapsed' }}"
                                   href="{{ route('master::loan_type.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Loan Types')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::document.index'))
                        @can('master::document list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::document.*')?'':'collapsed' }}"
                                   href="{{ route('master::document.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Documents')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::sub_document.index'))
                        @can('master::sub_document list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::sub_document.*')?'':'collapsed' }}"
                                   href="{{ route('master::sub_document.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Sub Documents')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                    @if(Route::has('master::banner.index'))
                        @can('master::banner list')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('master::banner.*')?'':'collapsed' }}"
                                   href="{{ route('master::banner.index')}}">
                                    <i class="bi bi-circle"></i>
                                    <span>{{__('Banners')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['advanced::settings.*', 'advanced::enums.*'])?'':'collapsed' }}"
               data-bs-target="#advanced-components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection"></i><span>{{__('Advanced')}}</span><i
                        class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="advanced-components-nav"
                class="nav-content collapse {{ request()->routeIs(['advanced::settings.*', 'advanced::enums.*'])?'show':'' }} "
                data-bs-parent="#sidebar-nav">
                @if(Route::has('advanced::settings.index'))
                    @can('advanced::settings list')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('advanced::settings.*')?'':'collapsed' }}"
                               href="{{ route('advanced::settings.index')}}">
                                <i class="bi bi-circle"></i>
                                <span>{{__('Settings')}}</span>
                            </a>
                        </li>
                    @endcan
                @endif

                @if(Route::has('advanced::enums.index'))
                    @can('advanced::enums list')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('advanced::enums.*')?'':'collapsed' }}"
                               href="{{ route('advanced::enums.index')}}">
                                <i class="bi bi-circle"></i>
                                <span>{{__('Enums')}}</span>
                            </a>
                        </li>
                    @endcan
                @endif
            </ul>
        </li>
    </ul>
</aside>
