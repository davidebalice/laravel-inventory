@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<style>
.even{background: #f9f9f9}
</style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Invoices approval list</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">



                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Invoice') }} n.</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Date') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Customer') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Description') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Amount') }}</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 50px;" aria-label="Position: activate to sort column ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">{{ __('messages.Manage') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                            $i=1;
                                            $class_row="even";
                                        @endphp
                                        @foreach ($invoices as $item) 
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
                                                <td>{{ $item->invoice_no ?? 'None'}}</td>
                                                <td>{{ date('d/m/Y',strtotime($item->date)) ?? 'None'}}</td>
                                                <td>{{ $item['payment']['customer']['name'] ?? 'None'}}</td>
                                                <td>{{ $item->description ?? 'None'}}</td>
                                                <td>€ {{ $item['payment']['total_amount'] ?? 'None'}}</td>
                                                
                                                <td>
                                                    @if ($item->status == 0)
                                                    <span class="btn btn-warning">Pending</span> 
                                                    @elseif ($item->status == 1)
                                                    <span class="btn btn-success">Approved</span>
                                                    @endif
                                                </td>
                                                                                                                                 
                                                <td>
                                                    {{--
                                                    <a href="{{ route('invoice.edit',$item->id) }}" class="btn btn-info sm" title="Edit">
                                                        <i class="fas fa-edit"></i> {{ __('messages.Edit') }}
                                                    </a>
                                                    --}}
                                                    @if ($item->status == 0)
                                                    <a href="{{ route('invoice.approve',$item->id) }}" id="approve" class="btn btn-dark sm" title="Approve">
                                                        <i class="fas fa-check-circle"></i> Approve
                                                    </a>
                                                    <a href="{{ route('invoice.delete',$item->id) }}" id="delete" class="btn btn-danger sm" title="{{ __('messages.Delete') }}">
                                                        <i class="fas fa-trash"></i> {{ __('messages.Delete') }}
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="row">
                            {{ $invoices->links() }}
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>


@endsection