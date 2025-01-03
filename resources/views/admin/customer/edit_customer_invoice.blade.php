@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('messages.CustomerInvoice') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                            <li class="breadcrumb-item active">{{ __('messages.CustomerInvoice') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('credit.customer') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">
                            <i class="fa fa-list"> {{ __('messages.Back') }} </i>
                        </a>
                        <br><br>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>{{ __('messages.CustomerInvoice') }} ( Invoice n.: #{{ $payment['invoice']['invoice_no'] }} ) </strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><strong>{{ __('messages.Customer') }}</strong></td>
                                                    <td class="text-center"><strong>mobile</strong></td>
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
                                <form method="post" action="{{ route('customer.update.invoice',$payment->invoice_id)}}">
                                    @csrf
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
                                                                <strong>{{ __('messages.Subtotal') }}</strong>
                                                            </td>
                                                            <td class="thick-line text-end">€ {{ $total_sum }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center">
                                                                <strong>{{ __('messages.DiscountAmount') }}</strong>
                                                            </td>
                                                            <td class="no-line text-end">€ {{ $payment->discount_amount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center">
                                                                <strong>{{ __('messages.PaidAmount') }}</strong>
                                                            </td>
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
                                                            <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
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
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label> {{ __('messages.PaidStatus') }} </label>
                                                    <select name="paid_status" id="paid_status" class="form-select">
                                                        <option value=""> Status </option>
                                                        <option value="full_paid">{{ __('messages.FullPaid') }}</option>
                                                        <option value="partial_paid">{{ __('messages.PartialPaid') }}</option>
                                                    </select>
                                                    <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="{{ __('messages.PaidAmount') }}" style="display:none;">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">{{ __('messages.Date') }}</label>
                                                        <input class="form-control example-date-input" placeholder="YYYY-MM-DD"  name="date" type="date"  id="date">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <div class="md-3" style="padding-top: 30px;">
                                                        <button type="submit" class="btn btn-info">{{ __('messages.Save') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<script type="text/javascript">
    $(document).on('change','#paid_status', function(){
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
    }); 
</script>

@endsection