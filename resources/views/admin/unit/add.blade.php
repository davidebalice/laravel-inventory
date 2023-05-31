@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('units')}}" class="btn btn-primary waves-effect waves-light primary_bg">            
                            <i class="fas fa-arrow-alt-circle-left"></i>               
                            &nbsp;Back
                        </a>

                        <hr />

                        <h4 class="card-title mb-5">Add unit</h4>
                     
                        
                        <form id="frm_data" method="post" action="{{ route('unit.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Name
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="name" class="form-control" type="text" id="example-text-input" value="{{old('name')}}">
                                    @error('name')
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