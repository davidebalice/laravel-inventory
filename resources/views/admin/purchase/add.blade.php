@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('purchases')}}" class="btn btn-primary waves-effect waves-light primary_bg">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            &nbsp;{{ __('messages.Back') }}
                        </a>

                        <hr />

                        <h4 class="card-title mb-5">{{ __('messages.AddPurchase') }}</h4>
                                        
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <label for="date" class="col-form-label">
                                    {{ __('messages.Date') }}
                                </label>
                                <input name="date" class="form-control example-text-input" type="date" id="date"> 
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <label for="purchase_no" class="col-form-label">
                                    {{ __('messages.Purchase') }} n.
                                </label>
                                <input name="purchase_no" class="form-control example-text-input" type="text" id="purchase_no"> 
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <label for="supplier_id" class="col-form-label">
                                    {{ __('messages.Supplier') }}
                                </label>
                                <select class="form-select select2" name="supplier_id" id="supplier_id" >
                                    <option value=""> - Supplier - </option>
                                    @foreach ($suppliers as $item)
                                    <option value="{{$item->id}}" {{ $item->id == old('supplier_id') ? 'selected' : ''}} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="col-md-4 col-lg-3">
                                <label for="category_id" class="col-form-label">
                                    {{ __('messages.Category') }}
                                </label>
                                <select class="form-select select2" name="category_id" id="category_id" >
                                    <option value=""> - {{ __('messages.Category') }} - </option>
                                    
                                </select>
                            </div>  

                            <div class="col-md-4 col-lg-3">  
                                <label for="product_id" class="col-form-label">
                                    {{ __('messages.Product') }}
                                </label>
                                <select class="form-select select2" name="product_id" id="product_id" >
                                    <option value=""> - {{ __('messages.Category') }} - </option>
                                    
                                </select>
                            </div>  

                            <div class="col-md-4 col-lg-3">  
                                {{--
                                
                                <input class="btn btn-dark  waves-effect waves-light mb-3 primary_bg" type="submit" id="purchase_no" value=" Add " > 
                                --}}
                                <label for="product_id" class="col-form-label" style="margin-top:45px">
                                    &nbsp;
                                 </label>
                                <div class="btn btn-dark  waves-effect waves-light mb-3 primary_bg addeventmore">
                                    <i class="fas fa-plus-circle"> </i>
                                    &nbsp;
                                    Add
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('purchase.store')}}" id="frm_add">
                            @csrf
                            <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                                <thead>
                                    <tr>
                                        <th style="width:18%">{{ __('messages.Category') }}</th>
                                        <th style="width:18%">{{ __('messages.Product') }}</th>
                                        <th style="width:10%">{{ __('messages.Quantity') }} / Kg</th>
                                        <th style="width:10%">{{ __('messages.UnitPrice') }}</th>
                                        <th style="width:18%">{{ __('messages.Description') }}</th>
                                        <th style="width:12%">{{ __('messages.TotalPrice') }}</th>
                                        <th style="width:14%">{{ __('messages.Manage') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                    
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                        </td>
                                        <td>
                                            <input type="text" name="estimated_amount" id="estimated_amount" value="0" readonly class="form-control estimated_amount" style="background-color:#ddd">
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info primary_color mt-4">Purchase store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script id="document-template" type="text/x-handlebars-template">
   
<tr class="delete_add_more_item"  id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{date}}">
    <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
    <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
    
    <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{ category_name }}
    </td>

    <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{ product_name }}
    </td>

    <td>
        <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
    </td>

    <td>
        <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="@{{product_price}}">
    </td>

    <td>
        <input type="text" class="form-control" name="description[]" value="">
    </td> 

    <td>
        <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
    </td> 

    <td>
        <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
    </td> 
</tr>

</script>

<script>
$(document).ready(function(){

    $(document).on('click',".addeventmore", function(){
        const date = $('#date').val();
        const purchase_no = $('#purchase_no').val();
        const supplier_id = $('#supplier_id').val();
        const category_id = $('#category_id').val();
        const category_name = $('#category_id').find('option:selected').text();
        const product_id = $('#product_id').val();
        const product_price = $('#product_price').val();
        const product_name = $('#product_id').find('option:selected').text();

        if(date == ''){
            $.notify("Date is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }
        if(purchase_no == ''){
            $.notify("Purchase n. is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }
        if(supplier_id == ''){
            $.notify("Supplier is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }
        if(category_id == ''){
            $.notify("Category is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }
        if(product_id == ''){
            $.notify("Product is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }

        const source = $("#document-template").html();
        let template = Handlebars.compile(source);
        const data = {
            date: date,
            purchase_no: purchase_no,
            supplier_id: supplier_id,
            category_id: category_id,
            category_name: category_name,
            product_id: product_id,
            product_price: product_price,
            product_name: product_name
        };
        const html = template(data);
        $('#addRow').append(html);
    });

    $(function(){
        $(document).on('click','.removeeventmore', function(e){
           $(this).closest(".delete_add_more_item").remove();
        });
    });

    $(function(){
        $(document).on('keyup click','.unit_price,.buying_qty', function(){
            let unit_price = parseFloat($(this).closest("tr").find("input.unit_price").val());

            let qty = parseFloat($(this).closest("tr").find("input.buying_qty").val());
            let total = parseFloat(unit_price * qty).toFixed(2);
            $(this).closest("tr").find("input.buying_price").val(total);
            totalAmontPrice();
        });
    });

    const totalAmontPrice = () => {
        let sum = parseFloat(0);
        $(".buying_price").each(function(){
            let value = parseFloat($(this).val());
            if(!isNaN(value) && value.length!=0){
            sum += parseFloat(value);
            }
        });
        sum = sum.toFixed(2);
        $('#estimated_amount').val(sum);
    }

    $(function(){
        $(document).on('change','#supplier_id', function(){
           const supplier_id = $(this).val();
           $.ajax({
            url:"{{ route('get-category') }}",
            type: "GET",
            data: {supplier_id:supplier_id},
            success:function(data) {
                    let html = '<option value="">Select category</option>';
                    $.each(data,function(key,v) {
                        html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
                    });
                    $('#category_id').html(html);
                }
           });
        });
    });

    $(function(){
        $(document).on('change','#category_id', function(){
           const category_id = $(this).val();
           $.ajax({
            url:"{{ route('get-product') }}",
            type: "GET",
            data: {category_id:category_id},
            success:function(data) {
                    let html = '<option value="">Select category</option>';
                    $.each(data,function(key,v) {
                        html += '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
           });
        });
    });

    $(function(){
        $(document).on('change','#product_id', function(){
           const product_id = $(this).val();
           $.ajax({
            url:"{{ route('get-product-price') }}",
            type: "GET",
            data: {product_id:product_id},
            success:function(data) {
                    /*
                    let html = '<input type="text" value="120" name="product_price" id="product_price">';
                    $('#frm_add').append(html);
                    */
                }
           });
        });
    });

   $('#frm_data').validate({
    rules:{
        name: {
            required : true,
        },
        supplier_id: {
            required : true,
        },
        category_id: {
            required : true,
        }
    },
    message: {
        name: {
                required: 'Enter name'
        },
        supplier_id: {
                required: 'Select supplier'
        },
        category_id: {
                required: 'Select category'
        }
    },
    errorElement: 'span',
    errorPlacement: function(error,element){
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function(element,errorClass,validClass){
        $(element).addClass('is-invalid');
    },
    unhighlight: function(element,errorClass,validClass){
        $(element).removeClass('is-invalid');
    },
   });
});
</script>

@endsection