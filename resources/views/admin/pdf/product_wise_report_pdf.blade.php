@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('messages.ProductWiseStockReport') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                            <li class="breadcrumb-item active">{{ __('messages.ProductWiseStockReport') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h3>
                                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="24"/> Shopping Demo
                                    </h3>
                                </div>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-6 mt-4">
                                        <address>
                                            <strong>Shopping Demo:</strong><br>
                                            support@companyname.com
                                        </address>
                                    </div>
                                    <div class="col-6 mt-4 text-end">
                                        <address>
                                        
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        
                                    </div>
                                    
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td class="text-center"><strong>{{ __('messages.Supplier') }}</strong></td>
                                                    <td class="text-center"><strong>{{ __('messages.Units') }}</strong>
                                                    </td>
                                                    <td class="text-center"><strong>{{ __('messages.Category') }}</strong>
                                                    </td>
                                                    <td class="text-center"><strong>{{ __('messages.Product') }}</strong>
                                                    </td>
                                                    <td class="text-center"><strong>{{ __('messages.Stock') }}  </strong>
                                                    </td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"> {{ $product['supplier']['name'] ?? '' }} </td>
                                                        <td class="text-center"> {{ $product['unit']['name'] ?? '' }} </td>
                                                        <td class="text-center"> {{ $product['category']['name'] ?? '' }} </td>
                                                        <td class="text-center"> {{ $product->name ?? '' }} </td>
                                                        <td class="text-center"> {{ $product->quantity ?? '' }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        @php
                                        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
                                        @endphp
                                        <i>{{ __('messages.PrintingTime') }} : {{ $date->format('F j, Y, g:i a') }}</i>

                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection