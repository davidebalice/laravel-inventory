@extends('admin.admin_master')
@section('admin')
 <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Print Invoice</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('invoice.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">
                            <i class="fas fa-plus-circle"> Add Invoice </i></a> 
                            <br><br>

                        <h4 class="card-title">Invoice Data </h4>


                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>{{ __('messages.Customer') }}</th> 
                                <th>{{ __('messages.Invoice') }} n.</th>
                                <th>{{ __('messages.Date') }}</th>
                                <th>{{ __('messages.Description') }}</th>
                                <th>Amount</th>
                                <th>{{ __('messages.Manage') }}</th>
                            </thead>

                            <tbody>

                                @foreach($invoices as $key => $item)
                                <tr>
                                    <td> {{ $item['payment']['customer']['name'] }} </td> 
                                    <td> #{{ $item->invoice_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($item->date))  }} </td> 
                                    <td>  {{ $item->description }} </td> 
                                    <td>  € {{ $item['payment']['total_amount'] }} </td>
                                    <td>
                                        <a href="{{ route('invoice.pdf',$item->id) }}" class="btn btn-success sm" title="Print Invoice" >  <i class="fa fa-print"></i> &nbsp;Print </a>
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