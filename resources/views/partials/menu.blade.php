<div class="sidebar">
    <nav class="sidebar-nav">
    
        <ul class="nav">
        <li><h3 class="text-center">({{ucfirst(Auth::user()->roles[0]->name)}})</h3></li>
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('users_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                Sub Admin
                            </a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a href="{{ route("admin.seller.index") }}" class="nav-link {{ request()->is('admin/seller') || request()->is('admin/seller/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                Seller
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li>
            @can('inventory')
            <li class="nav-item">
                <a href="{{ route("admin.inventory.index") }}" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt">

                    </i>
                    Inventory
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("request_for_buyer") }}" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt">

                    </i>
                    Request For Buyers
                    <span class="text-right count_class" style="display:none">0</span>
                </a>
            </li>
            @endcan
            @can('company')
            <?php if(Auth::user()->roles[0]->id == 4){ ?>
            <li class="nav-item">
                <a href="{{ route("admin.company.index") }}" class="nav-link">
                    <i class="nav-icon fas fa-building">

                    </i>
                    Company
                </a>
            </li>
            <?php } ?>
            @endcan
            @can('buyer list')
            <li class="nav-item">
                <a href="{{ route('buyer_list') }}" class="nav-link">
                    <i class="nav-icon fas fa-list">

                    </i>
                    Buyer List
                </a>
            </li>
            @endcan

            @can('admin buyer list')
            <li class="nav-item">
                <a href="{{ route('admin_buyer_list') }}" class="nav-link">
                    <i class="nav-icon fas fa-list">
                    </i>
                    Buyer List
                </a>
            </li>
            @endcan
            @can('admin seller list')
            <li class="nav-item">
                <a href="{{ route('admin_seller_list') }}" class="nav-link">
                    <i class="nav-icon fas fa-list">
                    </i>
                    Seller List
                </a>
            </li>
            @endcan
            <?php if(Auth::user()->roles[0]->id == 4){ ?>
            @can('company')
                <li class="nav-item">
                    <a href="{{ route("admin.order.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-sort">

                        </i>
                        My orders
                    </a>
                </li>   
            @endcan

            <?php } ?>
            
            @can('inventory')
            <li class="nav-item">
                <a href="{{ route('sales/agent')}}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    Sales Agent
                </a>
            </li>
            @endcan

            @can('create_buyer')
            <li class="nav-item">
                <a href="{{ route('sales/agent/buyer')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    Buyer
                </a>
            </li>
            @endcan

            @can('create_contract')
                <li class="nav-item">
                    <a href="{{ route('agreement/list')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        Sale Agreement
                    </a>
                </li>
            @endcan
            <?php if(Auth::user()->roles[0]->id == 5 || Auth::user()->roles[0]->id == 3 || Auth::user()->roles[0]->id == 1){ ?>
            <li class="nav-item">
                <a href="{{ route('sales/agent/order')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    Orders
                </a>
            </li>
            <?php } ?>

            <?php if(Auth::user()->roles[0]->id == 3){ ?>

            <li class="nav-item">
                <a href="{{ route('Buyer/register')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    Create Buyer
                </a>
            </li>
            <?php } ?>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>

        </ul>

    </nav>
    @can('company')
    <a href="{{url('company/register/'.auth()->user()->id)}}" style="text-align: center; font-size: 13px; font-weight: bold; color:#fff;"><i class="fa fa-plus" aria-hidden="true"></i> Add multiple companies</a>
    @endcan
    @can('inventory')
   <!-- <a onclick="FieldOfInterest();" style="text-align: center; font-size: 13px; font-weight: bold; color:#fff;"><i class="fa fa-plus" aria-hidden="true"></i> Add field of intrest</a> -->      
    @endcan
    
</div>
