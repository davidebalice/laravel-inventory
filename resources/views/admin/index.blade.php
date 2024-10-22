@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card dashBoxHeight bgDash">
                    <div class="card-body text-center">
                        <div class="d-flex">
                            <div class="avatar-sm">
                                <img src="{{ asset('logo/logo-white.png') }}" class="dashLogo mt-2">
                            </div>
                            <div class="flex-grow-1">
                                <h1 class="mb-2 bold mt-3 white">Demo</h1>
                                <h3 class="mt-2">
                                    <span class="font-size-19 white">
                                        Inventory Management System
                                    </span>
                                </h3>
                                <p class="font-size-16 white">
                                    Demo of an inventory management software, includes basic functionality, 
                                    <br />
                                    such as customer, 
                                    supplier and purchasing management
                                </p>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card dashBoxHeight bgDash2">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1 text-center">
                                <p class="font-size-25 bold red mb-2 mt-4">
                                    Important
                                </p>
                                <p class="mb-0"><span class="font-size-23 me-2">
                                    Software is in <b>demo mode</b>
                                </p>
                                <p class="mb-0"><span class="font-size-21 me-2">
                                    Crud operations is not allowed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">{{ __('messages.Products') }}</p>
                                <h4 class="mb-2">{{$totalProduct}}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">{{ __('messages.Users') }}</p>
                                <h4 class="mb-2">{{$totalUser}}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-user-3-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">{{ __('messages.Suppliers') }}</p>
                                <h4 class="mb-2">{{$totalSupplier}}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-user-3-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">{{ __('messages.Customers') }}</p>
                                <h4 class="mb-2">{{$totalCustomer}}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            Latest purchases
                        </h4>

                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Purchase no.</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">QTY</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Supplier') }}</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Category') }}</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">{{ __('messages.Product') }}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php
                                    $i=1;
                                    $class_row="even";
                                @endphp
                                @foreach ($purchases as $item) 
                                    @php
                                        $i++
                                    @endphp
                                    @if($i % 2 == 0)
                                        @php
                                            $class_row="even";
                                        @endphp
                                    @else
                                        @php
                                            $class_row="odd";
                                        @endphp
                                    @endif
                                    <tr class="{{ $class_row }}">
                                        <td>{{ $item->purchase_no ?? 'None'}}</td>
                                        <td>{{ date('d/m/Y',strtotime($item->date)) ?? 'None'}}</td>
                                        <td>{{ $item->buying_qty ?? 'None'}}</td>
                                        <td>{{ $item->supplier->name ?? 'None'}}</td>
                                        <td>{{ $item->category->name ?? 'None'}}</td>
                                        <td>{{ $item->product->name ?? 'None' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection