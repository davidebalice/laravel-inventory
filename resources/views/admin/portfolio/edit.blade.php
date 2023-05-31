@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-5">Update portfolio</h4>
                        
                        <!--
                        <p class="card-title-desc">Here are examples of <code class="highlighter-rouge">.form-control</code> applied to each
                            textual HTML5 <code class="highlighter-rouge">&lt;input&gt;</code> <code class="highlighter-rouge">type</code>.</p>
                        -->
                        
                        <form id="frm_portfolio" method="post" action="{{ route('update.portfolio')}}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $portfolio->id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Name
                                </label>
                                <div class="col-sm-10">
                                    <input name="name" class="form-control" type="text" id="example-text-input" value="{{ $portfolio->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                    Title
                                </label>
                                <div class="col-sm-10">
                                    <input name="title" class="form-control" type="text" id="example-text-input" value="{{ $portfolio->title }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                   Long description
                                </label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" rows="5" id="elm2">{{ $portfolio->description }}</textarea>
                                </div>
                            </div>

                            <hr />

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                   Image
                                </label>
                                <div class="col-sm-10">
                                    <input name="image" id="image"  class="form-control" type="file">
                                    <div class="avatar-xl mt-4 overflow-hidden" style="width:150px">
                                        <img id="showImage" class="w-100 justify-content-center" src="{{ (!empty($portfolio->image)) ? url($portfolio->image) : url('upload/no_image.jpg') }}" alt="image">                                   
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">
                                Image 
                                   <br />
                                   (homepage 1020x512px)
                                </label>
                                <div class="col-sm-10">
                                    <input name="image_home" id="image_home"  class="form-control" type="file">
                                    <div class="avatar-xl mt-4 overflow-hidden" style="width:150px">
                                        <img id="showImage_home" class="h-100 w-auto justify-content-center" src="{{ (!empty($portfolio->image_home)) ? url($portfolio->image_home) : url('upload/no_image.jpg') }}" alt="image_home">                                   
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <a href="#" onclick="$('#frm_portfolio').submit()" class="btn btn-primary waves-effect waves-light">            
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
        $('#image_home').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage_home').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection