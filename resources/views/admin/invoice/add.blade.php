@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('invoices')}}" class="btn btn-primary waves-effect waves-light primary_bg">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            &nbsp;{{ __('messages.Back') }}
                        </a>

                        <hr />

                        <h4 class="card-title mb-5">{{ __('messages.AddInvoice') }}</h4>
                        
                        <div class="row">
                            <div class="col-md-2 col-lg-1">
                                <label for="invoice_no" class="col-form-label">
                                    {{ __('messages.Invoice') }} n.
                                </label>
                                <input name="invoice_no" class="form-control example-text-input" value="{{ $invoice_no }}" type="text" id="invoice_no" readonly style="background: #f1f1f1">
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-4 col-lg-2">
                                <label for="date" class="col-form-label">
                                    {{ __('messages.Date') }}
                                </label>
                                <input name="date" class="form-control example-text-input" value="{{ $date }}" type="date" id="date"> 
                            </div>

                            <div class="col-md-2 col-lg-2">
                                <label for="current_stock_qty" class="col-form-label">
                                    {{ __('messages.Stock') }} (Qt.)
                                </label>
                                <input name="current_stock_qty" class="form-control example-text-input" type="text" id="current_stock_qty" readonly style="background: #f1f1f1">
                            </div> 
                            
                            <div class="col-md-4 col-lg-2">
                                {{--
                                
                                <input class="btn btn-dark  waves-effect waves-light mb-3 primary_bg" type="submit" id="invoice_no" value=" Add " > 
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


                        <div class="row">
                           
                            <div class="col-md-4 col-lg-2">
                                <label for="category_id" class="col-form-label">
                                    Category
                                </label>
                                <select class="form-select select2" name="category_id" id="category_id" >
                                    <option value=""> - Category - </option>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{ $item->id == old('category_id') ? 'selected' : ''}} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="col-md-4 col-lg-2">  
                                <label for="product_id" class="col-form-label">
                                    Product
                                </label>
                                <select class="form-select select2" name="product_id" id="product_id" >
                                    <option value=""> - {{ __('messages.Category') }} - </option>
                                    
                                </select>
                            </div>  
                        </div>   
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('invoice.store')}}" id="frm_add">
                            @csrf
                            <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                                <thead>
                                    <tr>
                                        <th style="width:24%">{{ __('messages.Category') }}</th>
                                        <th style="width:24%">{{ __('messages.Product') }}</th>
                                        <th style="width:12%">{{ __('messages.Quantity') }} / Kg</th>
                                        <th style="width:12%">Unit price</th>
                                        <th style="width:14%">Total price</th>
                                        <th style="width:14%">{{ __('messages.Manage') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                    
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="4" align="right">
                                            Discount &nbsp;
                                        </td>
                                        <td>
                                            <input type="number" name="discount_amount" id="discount_amount" value="0.00"  class="form-control discount_amount" placeholder="0.00" style="background-color:#ddd">
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">
                                            Total &nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="estimated_amount" id="estimated_amount" value="0.00" readonly class="form-control estimated_amount" style="background-color:#ddd">
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <p>{{ __('messages.Description') }}</p>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="description" class="form-control" placeholder="{{ __('messages.Description') }}"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3 mt-3">
                                    <label>
                                        Paid status
                                    </label>
                                    <select name="paid_status" id="paid_status" class="form-select">
                                        <option value="">Select status</option>
                                        <option value="full_paid">Full paid</option>
                                        <option value="full_due">Full due</option>
                                        <option value="partial_paid">Partial paid</option>
                                    </select>
                                    <input type="text" name="paid_amount" id="paid_amount" class="form-control paid_amount mt-3" style="display:none" placeholder="Enter paid amount">
                                </div>

                                <div class="form-group col-md-3 mt-3">
                                    <label>
                                        {{ __('messages.Customer') }}
                                    </label>
                                    <select name="customer_id" id="customer_id" class="form-select">
                                        <option value="">{{ __('messages.SelectCustomer') }}</option>
                                        <option value="0"> + {{ __('messages.AddCustomer') }}</option>
                                        @foreach ($customers as $item)
                                        <option value="{{$item->id}}">{{$item->surname}} {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="paid_amount" id="paid_amount" class="form-control paid_amount mt-3" style="display:none" placeholder="Enter paid amount">
                                </div>
                            </div>

                            <div id="new_customer" class="row new_customer mt-3" style="display:none">
                                <label>
                                    {{ __('messages.AddCustomer') }}
                                 </label>
                                <div class="form-group col-md-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('messages.Name') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" name="surname" id="surname" class="form-control" placeholder=" {{ __('messages.Surname') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile">
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-info primary_color mt-4">Invoice store</button>
                            </div>   
                        </form>
                    </div>   
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>


<script id="document-template" type="text/x-handlebars-template">
   
<tr class="delete_add_more_item"  id="delete_add_more_item">
    <input type="hidden" name="date" value="@{{date}}">
    <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
    
    <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{ category_name }}
    </td>    

    <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{ product_name }}
    </td>  

    <td>
        <input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]" value="">
    </td> 

    <td>
        <input type="number" class="form-control unit_price text-right" name="unit_price[]">
    </td> 

    <td>
        <input type="number" class="form-control selling_price text-right" name="selling_price[]" value="0" readonly>
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
        const invoice_no = $('#invoice_no').val();
        const category_id = $('#category_id').val();
        const category_name = $('#category_id').find('option:selected').text();
        const product_id = $('#product_id').val();
        const product_name = $('#product_id').find('option:selected').text();

        if(date == ''){
            $.notify("Date is required", {globalPosition: 'top  right', className: 'error'});
            return false;
        }
        if(invoice_no == ''){
            $.notify("Invoice n. is required", {globalPosition: 'top  right', className: 'error'});
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
            invoice_no: invoice_no,
            category_id: category_id,
            category_name: category_name,
            product_id: product_id,
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
        $(document).on('keyup click','.unit_price,.selling_qty', function(){
            let unit_price = parseFloat($(this).closest("tr").find("input.unit_price").val());
            let qty = parseFloat($(this).closest("tr").find("input.selling_qty").val());
            let total = parseFloat(unit_price * qty).toFixed(2);
            $(this).closest("tr").find("input.selling_price").val(total);
            $('#discount_amount').trigger('keyup');
        });
    });

    $(function(){
        $(document).on('keyup','#discount_amount', function(){
           totalAmontPrice();
        });
    });

    const totalAmontPrice = () => {
        let sum = parseFloat(0);
        $(".selling_price").each(function(){
            let value = parseFloat($(this).val());
            if(!isNaN(value) && value.length!=0){
            sum += parseFloat(value);
            }
        });
        let discount_amount = parseFloat($('#discount_amount').val());
        if(!isNaN(discount_amount) && discount_amount.length != 0) {
            sum -= parseFloat(discount_amount);
        }
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
            url:"{{ route('get-product-stock') }}",
            type: "GET",
            data: {product_id:product_id},
            success:function(data) {
                    $('#current_stock_qty').val(data);
                }
           });
        });
    });

    $(function(){
        $(document).on('change','#paid_status', function(){
            const paid_status = $(this).val();
            if(paid_status == "partial_paid"){
                $('#paid_amount').show();
            }
           else {
                $('#paid_amount').hide();
            }
        });
    });

    $(function(){
        $(document).on('change','#customer_id', function(){
            const customer_id = $(this).val();
            if(customer_id == "0"){
                $('#new_customer').show();
            }
           else {
                $('#new_customer').hide();
            }
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