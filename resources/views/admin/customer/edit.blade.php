@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('customers')}}" class="btn btn-primary waves-effect waves-light primary_bg">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            &nbsp;{{ __('messages.Back') }}
                        </a>

                        <hr />

                        <h4 class="card-title mb-5">Edit customer</h4>
                     
                        <form id="frm_data" method="post" action="{{ route('customer.update')}}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $customer->id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                   Image
                                </label>
                                <div class="col-sm-10">
                                    <input name="image" id="image"  class="form-control" type="file">
                                    <div class="avatar-xl mt-4 overflow-hidden" style="width:150px">
                                        <img id="showImage" class="h-100 w-auto justify-content-center" src="{{ (!empty($customer->image)) ? url($customer->image) : url('upload/no_image.jpg') }}" alt="image">                                   
                                    </div>
                                </div>
                            </div>   

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    {{ __('messages.Name') }}
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="name" class="form-control" type="text" id="example-text-input" value="{{ $customer->name }}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Surname
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="surname" class="form-control" type="text" id="example-text-input" value="{{ $customer->surname }}">
                                    @error('surname')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Email
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="email" class="form-control" type="text" id="example-text-input" value="{{ $customer->email }}">
                                    @error('email')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                               
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Mobile number
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="mobile_no" class="form-control" type="text" id="example-text-input" value="{{ $customer->mobile_no }}">
                                    @error('mobile_no')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Adress
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="address" class="form-control" type="text" id="example-text-input" value="{{ $customer->address }}">
                                    @error('address')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <hr />

                            <a href="#" onclick="$('#frm_data').submit()" class="btn btn-primary waves-effect waves-light primary_bg">            
                                <i class="fas fa-save"></i>               
                                &nbsp;Save
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
            </div>
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
        surname: {
            required : true,
        },
        email: {
            required : true,
        }
    },
    message: {
        name: {
            required: 'Enter name'
        },
        surname: {
            required: 'Enter surname'
        },
        email: {
            required: 'Enter email'
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