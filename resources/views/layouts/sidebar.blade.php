<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects! -->
        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- <li class="header">Functions</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>Product Category</span></a></li>
            <li><a href="{{ route('products.index') }}"><i class="fa fa-cubes"></i> <span>Products & Stock</span></a></li>
            <li><a href="{{ route('customers.index') }}"><i class="fa fa-users"></i> <span>Customers</span></a></li>
            <li><a href="{{ route('staffs.index') }}"><i class="fa fa-users"></i> <span>Staff/Engineers</span></a></li>
            <!-- <li><a href="{{ route('sales.index') }}"><i class="fa fa-cart-plus"></i> <span>Penjualan</span></a></li> -->
            <li><a href="{{ route('suppliers.index') }}"><i class="fa fa-truck"></i> <span>Suppliers</span></a></li>
            <li><a href="{{ route('productsIn.index') }}"><i class="fa fa-cart-plus"></i> <span>Purchase Products</span></a></li>
            <li><a href="{{ route('productsOut.index') }}"><i class="fa fa-minus"></i> <span>Sales/Products Out</span></a></li>
            <li><a href="{{ route('product_returns.index') }}"><i class="fa fa-cart-plus"></i> <span>Return Products</span></a></li>


            <!-- <li>
                <div class="drop down">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown link
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </li> -->
            <!-- <button class="dropdown-btn sidebar-menu">Biz Products & AMC <i class="fa fa-caret-down"></i> </button>
            <div class="dropdown-container">
                <a href="{{ route('productsIn.index') }}">Biz Products</a>
                <a href="#">Rental</a>
                <a href="#">FSMA</a>
                <a href="#">SSMA</a>

            </div> -->
            <li><a href="{{ route('contract_products.index') }}"><i class="fa fa-tachometer"></i> <span>Contract Products & AMC </span></a></li>
            <li><a href="{{ route('ledgers.index') }}"><i class="fa fa-tachometer"></i> <span>Machine Ledger</span></a></li>
            <li><a href="{{ route('reports.index') }}"><i class="fa fa-tachometer"></i> <span>Reports</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user-secret"></i> <span>System Users</span></a>


            </li>








        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>