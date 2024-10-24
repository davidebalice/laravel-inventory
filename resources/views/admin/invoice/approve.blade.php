@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
.even{background: #f9f9f9}
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Invoice approve</h4>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('invoice.pending')}}" class="btn btn-dark  waves-effect waves-light mb-3 primary_bg">
                            <i class="fas fa-list"> </i>
                            &nbsp;
                            Invoices pending list
                        </a>
                        
                        @php
                            $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first();
                        @endphp

                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br/>
                                    <h4>Invoice no: {{$invoice->invoice_no}} - {{date('d/m/Y', strtotime($invoice->date))}}</h4>
                                </div>
                                <form method="post" action="{{ route('approval.store',$invoice->id) }}">
                                     @csrf  
                                     <table border="0" class="table table-light" width="100%">
                                        <tr>
                                            <td><strong>{{ __('messages.Customer') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('messages.Name') }}: <strong>{{ $payment['customer']['name']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile: <strong>{{ $payment['customer']['mobile_no']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Email: <strong>{{ $payment['customer']['email']}}</td>
                                            </tr>
                                        <tr>
                                            <td>{{ __('messages.Description') }}: <strong>{{ $invoice->description}}</strong></td>
                                        </tr>
                                    </table>
                                    
                                    <br/>

                                    <table border="0" class="table table-light" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">{{ __('messages.Category') }}</th>
                                                <th class="text-center">{{ __('messages.Product') }}</th>
                                                <th class="text-center">Current stock</th>
                                                <th class="text-center">{{ __('messages.Quantity') }}</th>
                                                <th class="text-center">Unit Price </th>
                                                <th class="text-center">Total Price</th>
                                            </tr>
                            
                                        </thead>
                                        <tbody>
                                            @php
                                            $total_sum = 0;
                                            @endphp
                                            
                                            @foreach($invoice['invoice_details'] as $key => $details)
                                            <tr>
                                                <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                                <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                                <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{ $details->selling_qty }}">
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
                                                <td colspan="6"> Sub Total </td>
                                                <td > {{ $total_sum }} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"> Discount </td>
                                                <td > {{ $payment->discount_amount }} </td>
                                            </tr>
                                    
                                            <tr>
                                                <td colspan="6"> Paid Amount </td>
                                                <td >{{ $payment->paid_amount }} </td>
                                            </tr>
                                    
                                            <tr>
                                                <td colspan="6"> {{ __('messages.DueAmount') }} </td>
                                                <td > {{ $payment->due_amount }} </td>
                                            </tr>
                                    
                                            <tr>
                                                <td colspan="6"> {{ __('messages.GrandAmount') }} </td>
                                                <td >{{ $payment->total_amount }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-info">Invoice Approve </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection