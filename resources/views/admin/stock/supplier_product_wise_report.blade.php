@extends('admin.admin_master')
@section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('messages.SupplierandProductWiseReport') }}</h4>
                </div>
            </div>
        </div>
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong>{{ __('messages.SupplierWiseReport') }}</strong>
                                <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;
                                <strong>{{ __('messages.ProductWiseReport') }}</strong>
                                <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                            </div>
                        </div>

                        <div class="show_supplier" style="display:none">
                            <form method="GET" action="{{ route('supplier.wise.pdf') }}" id="myForm" target="_blank" >
                                <div class="row">
                                    <div class="col-sm-8 form-group">
                                        <label>{{ __('messages.Supplier') }}</label>
                                <select name="supplier_id" class="form-select select2"  >
                                    <option value="">Select Supplier</option>
                                    @foreach($supppliers as $supp)
                                    <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                @endforeach
                                    </select>
                                    </div>

                                    <div class="col-sm-4" style="padding-top: 28px;">
                                        <button type="submit" class="btn btn-primary">{{ __('messages.Search') }}</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>

                        <div class="show_product" style="display:none; ">
                            <form method="GET" action="{{ route('product.wise.pdf') }}" id="myForm" target="_blank" >
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">{{ __('messages.Category') }}</label>
                                            <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">{{ __('messages.Product') }}</label>
                                            <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4" style="padding-top: 28px;">
                                        <button type="submit" class="btn btn-primary">{{ __('messages.Search') }}</button>
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

<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });

    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'supplier_wise') {
            $('.show_supplier').show();
        }else{
            $('.show_supplier').hide();
        }
    });

    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'product_wise') {
            $('.show_product').show();
        }else{
            $('.show_product').hide();
        }
    });

    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                supplier_id: {
                    required : true,
                },
            },
            messages :{
                supplier_id: {
                    required : 'Please Select Supplier ',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

@endsection