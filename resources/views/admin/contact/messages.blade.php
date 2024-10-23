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
                    <h4 class="mb-sm-0">Messages</h4>
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
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 90px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Date') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 154px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Name') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 154px;" aria-label="Position: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 154px;" aria-label="Position: activate to sort column ascending">Tel</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 154px;" aria-label="Position: activate to sort column ascending">Subject</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 125px;" aria-label="Office: activate to sort column ascending">{{ __('messages.Manage') }}</th>
                                        </thead>

                                        <tbody>
                                        @php
                                            $i=1;
                                            $class_row="even";
                                        @endphp
                                        @foreach ($messages as $message) 
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
                                                <td class="sorting_1 dtr-control">{{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
                                                <td class="sorting_1 dtr-control">{{ $message->name }}</td>
                                                <td class="sorting_1 dtr-control">{{ $message->email }}</td>
                                                <td class="sorting_1 dtr-control">{{ $message->tel }}</td>
                                                <td class="sorting_1 dtr-control">{{ $message->subject }}</td>
                                                <td>
                                                    {{--
                                                    <a href="{{ route('edit.multi.image',$message->id) }}" class="btn btn-info sm" title="Edit data">
                                                        <i class="fas fa-edit"></i> {{ __('messages.Edit') }}
                                                    </a>
                                                    --}}
                                                    <a href="{{ route('delete.message',$message->id) }}" id="delete" class="btn btn-danger sm" title="{{ __('messages.Delete') }}">
                                                        <i class="fas fa-trash"></i> {{ __('messages.Delete') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="datatable_info" role="status" ariaf-live="polite">
                                        
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    
                                </div>
                            </div>
                        
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>


@endsection