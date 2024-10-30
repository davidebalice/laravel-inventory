@extends('admin.admin_master')
@section('admin')

 <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('messages.ManageStock') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                            <li class="breadcrumb-item active">{{ __('messages.ManageStock') }}</li>
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
                                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="24"/> {{ env('COMPANY_NAME', 'Company Name') }}
                                    </h3>
                                </div>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-6 mt-4">
                                        <address>
                                            <strong>{{ env('COMPANY_NAME', 'Company Name') }}:</strong><br>
                                            {{ env('COMPANY_EMAIL', 'info@companyname.com') }}
                                        </address>
                                    </div>
                                    <div class="col-6 mt-4 text-end">
                                        <address>
                                            {{ env('COMPANY_ADDRESS', '123 5th Ave, New York, NY 10001') }}
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
                                        <td><strong>Sl </strong></td>
                                        <td class="text-center"><strong>{{ __('messages.Supplier') }} </strong></td>
                                        <td class="text-center"><strong>{{ __('messages.Units') }}  </strong>
                                        </td>
                                        <td class="text-center"><strong>{{ __('messages.Category') }}</strong>
                                        </td>
                                        <td class="text-center"><strong>{{ __('messages.Product') }}</strong>
                                        </td>
                                        <td class="text-center"><strong>{{ __('messages.InQty') }}</strong>
                                        </td>
                                        <td class="text-center"><strong>{{ __('messages.OutQty') }}</strong>
                                        </td>
                                        <td class="text-center"><strong>{{ __('messages.Stock') }}</strong>
                                        </td>
                                    </tr>
                                    </thead>
                                        <tbody>
                                            @foreach($allData as $key => $item)

                                                @php
                                                $buying_total = App\Models\Purchase::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('buying_qty');

                                                $selling_total = App\Models\InvoiceDetail::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('selling_qty');
                                                @endphp


                                                <tr>
                                                    <td class="text-center"> {{ $key+1}} </td>
                                                    <td class="text-center"> {{ $item['supplier']['name'] ?? '' }} </td>
                                                    <td class="text-center"> {{ $item['unit']['name'] ?? '' }} </td>
                                                    <td class="text-center"> {{ $item['category']['name'] ?? '' }} </td>
                                                    <td class="text-center"> {{ $item->name ?? '' }} </td>
                                                    <td class="text-center"> {{ $buying_total ?? '' }} </td>
                                                    <td class="text-center"> {{ $selling_total ?? '' }} </td>
                                                    <td class="text-center"> {{ $item->quantity ?? '' }} </td>
                                                </tr>
                                                
                                            @endforeach
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