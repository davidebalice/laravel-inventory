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
                    <h4 class="mb-sm-0">Units</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('unit.add')}}" class="btn btn-dark  waves-effect waves-light mb-3 primary_bg">
                            <i class="fas fa-plus-circle"> </i>
                            &nbsp;
                            Unit
                        </a>

                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                           
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 400px;" aria-label="Position: activate to sort column ascending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Actions</th>
                                        </thead>

                                        <tbody>
                                        @php
                                            $i=1;
                                            $class_row="even";
                                        @endphp
                                        @foreach ($units as $item) 
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
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <a href="{{ route('unit.edit',$item->id) }}" class="btn btn-info sm" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('unit.delete',$item->id) }}" id="delete" class="btn btn-danger sm" title="Delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="row">
                            {{ $units->links() }}
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>


@endsection