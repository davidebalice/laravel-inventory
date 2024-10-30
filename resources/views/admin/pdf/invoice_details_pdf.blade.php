@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> Customer Payment Report </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                            <li class="breadcrumb-item active">Customer Payment Report</li>
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
                                    <h4 class="float-end font-size-16"><strong>{{ __('messages.Invoice') }} n. # {{ $payment['invoice']['invoice_no'] }}</strong></h4>
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
                                        <h3 class="font-size-16"><strong>{{ __('messages.CustomerInvoice') }}</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><strong>{{ __('messages.Customer') }}</strong></td>
                                                    <td class="text-center"><strong>{{ __('messages.Customer') }} mobile</strong></td>
                                                    <td class="text-center"><strong>{{ __('messages.Address') }}</strong>
                                                    </td>
                                                    
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td> {{ $payment['customer']['name'] }}</td>
                                                    <td class="text-center">{{ $payment['customer']['mobile_no']  }}</td>
                                                    <td class="text-center">{{ $payment['customer']['email']  }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                                            <td class="text-center"><strong>{{ __('messages.Category') }}</strong></td>
                                            <td class="text-center"><strong>{{ __('messages.Product') }}</strong>
                                            </td>
                                            <td class="text-center"><strong>{{ __('messages.Stock') }}</strong>
                                            </td>
                                            <td class="text-center"><strong>{{ __('messages.Quantity') }}</strong>
                                            </td>
                                            <td class="text-center"><strong>{{ __('messages.UnitPrice') }}</strong>
                                            </td>
                                            <td class="text-center"><strong>{{ __('messages.TotalPrice') }}</strong>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                                $invoice_details = App\Models\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                            @endphp

                                            @foreach($invoice_details as $key => $details)
                                            <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                                <td class="text-center">{{ $details['category']['name'] }}</td>
                                                <td class="text-center">{{ $details['product']['name'] }}</td>
                                                <td class="text-center">{{ $details['product']['quantity'] }}</td>
                                                <td class="text-center">{{ $details->selling_qty }}</td>
                                                <td class="text-center">{{ $details->unit_price }}</td>
                                                <td class="text-center">{{ $details->selling_price }}</td>
                                            </tr>
                                            @php
                                            $total_sum += $details->selling_price;
                                            @endphp
                                            @endforeach
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center">
                                                        <strong>{{ __('messages.Subtotal') }}</strong></td>
                                                    <td class="thick-line text-end">€ {{ $total_sum }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>{{ __('messages.DiscountAmount') }}</strong></td>
                                                    <td class="no-line text-end">€ {{ $payment->discount_amount }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>{{ __('messages.PaidAmount') }}</strong></td>
                                                    <td class="no-line text-end">€ {{ $payment->paid_amount }}</td>
                                                </tr>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>{{ __('messages.DueAmount') }}</strong>
                                                    </td>
                                                    <td class="no-line text-end">€ {{ $payment->due_amount }}</td>
                                                </tr>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>{{ __('messages.GrandAmount') }}</strong>
                                                    </td>
                                                    <td class="no-line text-end"><h4 class="m-0">€ {{ $payment->total_amount }}</h4></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="7" style="text-align: center;font-weight: bold;">Paid Summary</td>
                                                    
                                                </tr>

                                                <tr>
                                                    <td colspan="4" style="text-align: center;font-weight: bold;">{{ __('messages.Date') }}</td>
                                                    <td colspan="3" style="text-align: center;font-weight: bold;">{{ __('messages.Amount') }}</td>
                                                </tr>
                                                
                                                    @php
                                                    $payment_details = App\Models\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                                                    @endphp

                                                    @foreach($payment_details as $item)
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;font-weight: bold;">{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                                        <td colspan="3" style="text-align: center;font-weight: bold;">{{ $item->current_paid_amount }}</td>
                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

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