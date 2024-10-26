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
                        <li><a href="{{ route ('supplier.add') }}">{{ __('messages.AddSupplier') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user"></i>
                        <span>{{ __('messages.Customers') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('customers') }}">{{ __('messages.Customers') }}</a></li>
                        <li><a href="{{ route ('customer.add') }}">{{ __('messages.AddCustomer') }}</a></li>
                        <li><a href="{{ route('credit.customer') }}">{{ __('messages.CreditCustomers') }}</a></li>
                        <li><a href="{{ route('paid.customer') }}">{{ __('messages.PaidCustomers') }}</a></li>
                        <li><a href="{{ route('customer.wise.report') }}">{{ __('messages.CustomerWiseReport') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-delete-back-fill"></i>
                        <span>{{ __('messages.Units') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('units') }}">{{ __('messages.Units') }}</a></li>
                        <li><a href="{{ route ('unit.add') }}">{{ __('messages.AddUnit') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-menu"></i>
                        <span>{{ __('messages.Categories') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('categories') }}">{{ __('messages.Categories') }}</a></li>
                        <li><a href="{{ route ('category.add') }}">{{ __('messages.AddCategory') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-boxes"></i>
                        <span>{{ __('messages.Products') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('products') }}">{{ __('messages.Products') }}</a></li>
                        <li><a href="{{ route ('product.add') }}">{{ __('messages.AddProduct') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>{{ __('messages.Purchases') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('purchases') }}">{{ __('messages.Purchases') }}</a></li>
                        <li><a href="{{ route ('purchase.add') }}">{{ __('messages.AddPurchase') }}</a></li>
                        <li><a href="{{ route ('purchase.pending') }}">{{ __('messages.ApprovalPurchase') }}</a></li>
                        <li><a href="{{ route('daily.purchase.report') }}">{{ __('messages.DailyPurchase') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-document"></i>
                        <span>{{ __('messages.Invoices') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route ('invoices') }}">{{ __('messages.Invoices') }}</a></li>
                        <li><a href="{{ route ('invoice.add') }}">{{ __('messages.AddInvoice') }}</a></li>
                        <li><a href="{{ route ('invoice.pending') }}">{{ __('messages.ApprovalInvoice') }}</a></li>
                        <li><a href="{{ route ('invoice.daily') }}">{{ __('messages.DailyReport') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box"></i>
                        <span>{{ __('messages.ManageStock') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report') }}">{{ __('messages.ManageStock') }}</a></li>
                        <li><a href="{{ route('stock.supplier.wise') }}">{{ __('messages.Supplier') }} / {{ __('messages.Product') }} </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" >
                        <i class="fas fa-headset"></i>
                        <span>{{ __('messages.Support') }}</span>
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