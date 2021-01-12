<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul> 
            </li>
        @endcan
        @can('news_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/private-news*") ? "c-show" : "" }} {{ request()->is("admin/public-news*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.news.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('private_news_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.private-news.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/private-news") || request()->is("admin/private-news/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-newspaper c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.privateNews.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('public_news_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.public-news.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/public-news") || request()->is("admin/public-news/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.publicNews.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('test_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/regions*") ? "c-show" : "" }} {{ request()->is("admin/provinces*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.test.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('region_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.regions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/regions") || request()->is("admin/regions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.region.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('province_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.provinces.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.province.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('service_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.services.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/services") || request()->is("admin/services/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.service.title') }}
                </a>
            </li>
        @endcan
        @can('help_case_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.help-cases.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/help-cases") || request()->is("admin/help-cases/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.helpCase.title') }}
                </a>
            </li>
        @endcan
        @can('partenaire_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/province-partners*") ? "c-show" : "" }} {{ request()->is("admin/national-partners*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.partenaire.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('province_partner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.province-partners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/province-partners") || request()->is("admin/province-partners/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.provincePartner.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('national_partner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.national-partners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/national-partners") || request()->is("admin/national-partners/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nationalPartner.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('handbook_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/directorates*") ? "c-show" : "" }} {{ request()->is("admin/units*") ? "c-show" : "" }} {{ request()->is("admin/professions*") ? "c-show" : "" }} {{ request()->is("admin/etablissements*") ? "c-show" : "" }} {{ request()->is("admin/unite-regionals*") ? "c-show" : "" }} {{ request()->is("admin/unit-details*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.handbook.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('directorate_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.directorates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/directorates") || request()->is("admin/directorates/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.directorate.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('unit_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.units.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/units") || request()->is("admin/units/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.unit.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('profession_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.professions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/professions") || request()->is("admin/professions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.profession.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('etablissement_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.etablissements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/etablissements") || request()->is("admin/etablissements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.etablissement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('unite_regional_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.unite-regionals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/unite-regionals") || request()->is("admin/unite-regionals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.uniteRegional.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('unit_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.unit-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/unit-details") || request()->is("admin/unit-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.unitDetail.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('links_request_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/links*") ? "c-show" : "" }} {{ request()->is("admin/questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.linksRequest.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('link_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.links.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/links") || request()->is("admin/links/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-link c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.link.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.question.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
         @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>