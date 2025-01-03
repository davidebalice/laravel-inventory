@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('messages.ManageStock') }}</h4>
                </div>
            </div>
        </div>
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">
                            <i class="fa fa-print"> {{ __('messages.StockReportPrint') }} </i>
                        </a>
                        <br><br>
                        <h4 class="card-title">{{ __('messages.ManageStock') }}</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>{{ __('messages.Supplier') }}</th>
                                <th>{{ __('messages.Units') }}</th>
                                <th>{{ __('messages.Category') }}</th>
                                <th>{{ __('messages.Product') }}</th>
                                <th>{{ __('messages.InQty') }}</th>
                                <th>{{ __('messages.OutQty') }}</th>
                                <th>{{ __('messages.Stock') }}</th>
                            </thead>
    
                            @foreach($allData as $key => $item)
                                @php
                                    $buying_total = App\Models\Purchase::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('buying_qty');
                                    $selling_total = App\Models\InvoiceDetail::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('selling_qty');
                                @endphp

                                <tr>
                                    <td> {{ $item['supplier']['name'] ?? ''}} </td>
                                    <td> {{ $item['unit']['name'] ?? '' }} </td>
                                    <td> {{ $item['category']['name'] ?? ''}} </td>
                                    <td> {{ $item->name ?? '' }} </td>
                                    <td> <span class="btn btn-success"> {{ $buying_total  }}</span></td>
                                    <td> <span class="btn btn-danger"> {{ $selling_total  }}</span></td>
                                    <td> <span class="btn btn-info"> {{ $item->quantity }}</span></td>
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