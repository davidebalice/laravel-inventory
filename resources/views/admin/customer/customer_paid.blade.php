@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Paid customers</h4>
                </div>
            </div>
        </div>
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('paid.customer.print.pdf') }}" class="btn btn-dark btn-rounded waves-effect waves-light" target="_black" style="float:right;"><i class="fa fa-print"> Print Paid Customer </i></a> <br>  <br>               

                        <h4 class="card-title">Paid data </h4>
                    
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>{{ __('messages.Customer') }}</th>
                                <th>{{ __('messages.Invoice') }} n. </th>
                                <th>{{ __('messages.Date') }}</th>
                                <th>Due Amount</th>
                                <th>{{ __('messages.Manage') }}</th>
                            </thead>

                            <tbody>
                        	    @foreach($allData as $key => $item)
                                <tr>
                                    <td> {{ $item['customer']['name'] }} </td>
                                    <td> #{{ $item['invoice']['invoice_no'] ?? '' }}   </td>
                                    <td> {{ isset($item['invoice']['date']) ? date('d-m-Y', strtotime($item['invoice']['date'])) : '' }} </td>
                                    <td> {{ $item->due_amount }} </td>
                                    <td>
                                        <a href="{{ route('customer.invoice.details.pdf',$item->invoice_id) }}" class="btn btn-info sm" target="_black" title="Customer Details">  <i class="fa fa-eye"></i> </a>
                                    </td>
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
 
@endsection