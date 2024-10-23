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
                    <h4 class="mb-sm-0">{{ __('messages.Products') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('product.add')}}" class="btn btn-dark  waves-effect waves-light mb-3 primary_bg">
                            <i class="fas fa-plus-circle"> </i>
                            &nbsp;
                            {{ __('messages.Product') }}
                        </a>

                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 80px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Image') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 250px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Name') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Category') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">{{ __('messages.Supplier') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">{{ __('messages.Units') }}</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">{{ __('messages.Manage') }}</th>
                                        </thead>

                                        <tbody>
                                        @php
                                            $i=1;
                                            $class_row="even";
                                        @endphp
                                        @foreach ($products as $item) 
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
                                                <td>
                                                    @if (file_exists($item->image))
                                                    <img src="{{ asset($item->image)}}" alt="" style="width:100px">
                                                    @else
                                                    <img src="{{ asset('upload/no_image_blog.jpg')}}" alt="" style="width:100px">
                                                    @endif
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category->name ?? 'None'}}</td>
                                                <td>{{ $item->supplier->name ?? 'None'}}</td>
                                                <td>{{ $item->unit->name ?? 'None' }}</td>
                                                <td>
                                                    <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info sm" title="{{ __('messages.Edit') }}">
                                                        <i class="fas fa-edit"></i> {{ __('messages.Edit') }}
                                                    </a>
                                                    <a href="{{ route('product.delete',$item->id) }}" id="delete" class="btn btn-danger sm" title="{{ __('messages.Delete') }}">
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
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>


@endsection