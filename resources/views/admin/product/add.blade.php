@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('products')}}" class="btn btn-primary waves-effect waves-light primary_bg">            
                            <i class="fas fa-arrow-alt-circle-left"></i>               
                            &nbsp;Back
                        </a>

                        <hr />

                        <h4 class="card-title mb-5">Add product</h4>
                     
                        
                        <form id="frm_data" method="post" action="{{ route('product.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                   Image
                                </label>
                                <div class="col-sm-10">
                                    <input name="image" id="image"  class="form-control" type="file">
                                    <div class="avatar-xl mt-4 overflow-hidden" style="width:150px">
                                        <img id="showImage" class="h-100 w-auto justify-content-center" src="{{ asset('upload/no_image.jpg') }}" alt="image">                                   
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Product name
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="name" class="form-control" type="text" id="example-text-input" value="{{old('name')}}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Product name (row2)
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="sub_name" class="form-control" type="text" id="example-text-input" value="{{old('sub_name')}}">
                                    @error('sub_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Code
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="code" class="form-control" type="text" id="example-text-input" value="{{old('code')}}">
                                    @error('code')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="supplier_id" >
                                        <option value=""> - Supplier - </option>
                                        @foreach ($suppliers as $item)
                                        <option value="{{$item->id}}" {{ $item->id == old('supplier_id') ? 'selected' : ''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="category_id" >
                                        <option value=""> - Category - </option>
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}" {{ $item->id == old('category_id') ? 'selected' : ''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Unit</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="unit_id"  style="width:100px;">
                                        <option value=""> - Unit - </option>
                                        @foreach ($units as $item)
                                        <option value="{{$item->id}}" {{ $item->id == old('unit_id') ? 'selected' : ''}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Quantity
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="quantity" class="form-control" style="width:100px;" type="text" id="example-text-input" value="{{old('quantity')}}">
                                    @error('quantity')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                               
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                   Description
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" rows="5" id="elm2">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <hr />

                            <a href="#" onclick="$('#frm_data').submit()" class="btn btn-primary waves-effect waves-light primary_bg">            
                                <i class="fas fa-plus-circle"></i>               
                                &nbsp;Insert
                            </a>
                        </form>

                        
                        <!--

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    </select>
                            </div>
                        </div>
                       
                        -->



                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
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