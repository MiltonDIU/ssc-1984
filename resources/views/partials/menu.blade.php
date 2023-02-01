  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li>
                        <select class="searchable-field form-control">

                        </select>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('global.dashboard') }}
                            </p>
                        </a>
                    </li>
                    @can('division_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.divisions.index") }}" class="nav-link {{ request()->is("admin/divisions") || request()->is("admin/divisions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.division.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('district_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.districts.index") }}" class="nav-link {{ request()->is("admin/districts") || request()->is("admin/districts/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.district.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('upazila_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.upazilas.index") }}" class="nav-link {{ request()->is("admin/upazilas") || request()->is("admin/upazilas/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.upazila.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('profession_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.professions.index") }}" class="nav-link {{ request()->is("admin/professions") || request()->is("admin/professions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.profession.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('event_category_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.event-categories.index") }}" class="nav-link {{ request()->is("admin/event-categories") || request()->is("admin/event-categories/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.eventCategory.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('school_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.schools.index") }}" class="nav-link {{ request()->is("admin/schools") || request()->is("admin/schools/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.school.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('user_management_access')
                        <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                            <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}" href="#">
                                <i class="fa-fw nav-icon fas fa-users">

                                </i>
                                <p>
                                    {{ trans('cruds.userManagement.title') }}
                                    <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('permission_access')
                                    <li class="nav-item">
                                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                            <i class="fa-fw nav-icon fas fa-unlock-alt">

                                            </i>
                                            <p>
                                                {{ trans('cruds.permission.title') }}
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('role_access')
                                    <li class="nav-item">
                                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                            <i class="fa-fw nav-icon fas fa-briefcase">

                                            </i>
                                            <p>
                                                {{ trans('cruds.role.title') }}
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_access')
                                    <li class="nav-item">
                                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                            <i class="fa-fw nav-icon fas fa-user">

                                            </i>
                                            <p>
                                                {{ trans('cruds.user.title') }}
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    <!--@can('address_access')-->
                    <!--    <li class="nav-item">-->
                    <!--        <a href="{{ route("admin.addresses.index") }}" class="nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "active" : "" }}">-->
                    <!--            <i class="fa-fw nav-icon fas fa-cogs">-->

                    <!--            </i>-->
                    <!--            <p>-->
                    <!--                {{ trans('cruds.address.title') }}-->
                    <!--            </p>-->
                    <!--        </a>-->
                    <!--    </li>-->
                    <!--@endcan-->
                    @can('event_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.event.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('spouse_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.spouses.index") }}" class="nav-link {{ request()->is("admin/spouses") || request()->is("admin/spouses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs nav-icon">

                                </i>
                                {{ trans('cruds.spouse.title') }}
                            </a>
                        </li>
                    @endcan
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="{{ url("member") }}" class="nav-link }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">

                            </i>
                            <p>
                              Member Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                            <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
