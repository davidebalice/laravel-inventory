  <div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu" style="visibility: hidden">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
               
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hotel-fill"></i>
                        <span>{{ __('messages.Suppliers') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('suppliers') }}">{{ __('messages.Suppliers') }}</a></li>
                        <li><a href="{{ route ('supplier.add') }}">Add supplier</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user"></i>
                        <span>{{ __('messages.Customers') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('customers') }}">{{ __('messages.Customers') }}</a></li>
                        <li><a href="{{ route ('customer.add') }}">Add customer</a></li>
                        <li><a href="{{ route('credit.customer') }}">Credit customers</a></li>
                        <li><a href="{{ route('paid.customer') }}">Paid customers</a></li>
                        <li><a href="{{ route('customer.wise.report') }}">Customer Wise Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-delete-back-fill"></i>
                        <span>Units</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('units') }}">Units</a></li>
                        <li><a href="{{ route ('unit.add') }}">Add unit</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-menu"></i>
                        <span>{{ __('messages.Categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('categories') }}">{{ __('messages.Categories') }}</a></li>
                        <li><a href="{{ route ('category.add') }}">Add category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-boxes"></i>
                        <span>{{ __('messages.Products') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('products') }}">{{ __('messages.Products') }}</a></li>
                        <li><a href="{{ route ('product.add') }}">Add product</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>Purchases</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('purchases') }}">Purchase</a></li>
                        <li><a href="{{ route ('purchase.add') }}">Add purchase</a></li>
                        <li><a href="{{ route ('purchase.pending') }}">Approval purchase</a></li>
                        <li><a href="{{ route('daily.purchase.report') }}">Daily purchase </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>Invoices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('invoices') }}">Invoices</a></li>
                        <li><a href="{{ route ('invoice.add') }}">Add invoice</a></li>
                        <li><a href="{{ route ('invoice.pending') }}">Approval invoice</a></li>
                        <li><a href="{{ route ('invoice.daily') }}">Daily report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box"></i>
                        <span>Manage stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report') }}">Stock report</a></li>
                        <li><a href="{{ route('stock.supplier.wise') }}">Supplier / Product Wise </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" >
                        <i class="fas fa-headset"></i>
                        <span>Support</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('sidebar-menu').style.visibility = 'visible';
    });
</script>