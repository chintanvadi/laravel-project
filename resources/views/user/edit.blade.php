@extends('layouts.default')

@section('title', 'Create User')

@section('styles') 
    <!-- Datatables -->
    <link href="{{ asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('css/green.css')}}" rel="stylesheet">
    <style type="text/css">
      .margins{margin-bottom:2em;border-bottom:1px solid #efeaea;}
      label.error{color:red;}
      .figure{
            width:150px;
            height:150px;
            border-radius:50%;
            overflow:hidden;
            position: relative;
            right: -120px;
        }
    </style>
@endsection

@section('content')

    <div class="">
      <div class="row" style="margin-bottom:2em;border-bottom:1px solid #efeaea;">
          <div class="page-title" >
              <div class="title_left">
                  <h3>Edit User</h3>
              </div>
          </div>
          <div class="clearfix"></div>

      </div>
      <div class="main">
          <form class="form-horizontal form-label-left input_mask" id="customerforms" method="post" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="x_panel">
                      <div class="x_content">
                          
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <input type="file" class="form-control" name="image" id="imgInp"><br>
                              <img src="{{ url('storage/image/'.$user->image)}}" class="figure" id="blah" onerror="this.onerror=null;this.src='{{asset('images/useravatar.png') }}';" />
                              <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                          </div>
                          
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>First Name</label>
                              <input type="text" class="form-control" id="inputSuccess1"  name="first_name" value="{{ $user->first_name }}" placeholder="Enter Name">
                              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>
                          
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Last Name</label>
                              <input type="text" class="form-control" id="inputSuccess2"  name="last_name" value="{{ $user->last_name }}" placeholder="Enter Name">
                              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter Email">
                              <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                              <label>Phone Number </label>
                              <input type="text" class="form-control" id="inputSuccess5" value="{{ $user->phone }}" placeholder="Phone Number" name="phone" >
                              <input type="hidden" id="user_id" value="{{ $user->id }}" hidden>
                              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                          </div>

                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <a href="{{ url()->previous() }}" class="btn btn-primary" >Cancel</a>
                          <input type="submit" name="addcustomerdata" value="Update" class="btn btn-success">
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
       

@endsection
@section('js') 

    <!-- Datatables -->
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/responsive.bootstrap.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('js/icheck.min.js')}}"></script>
    <!-- jquery validate -->
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Add Validation Rules -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
          $(document).ready(function () {
            //Phone Us
            $.validator.addMethod("phoneUS", function (phone_number, element) {
                  phone_number = phone_number.replace(/\s+/g, "");
                  return this.optional(element) || phone_number.length > 9 &&
                        phone_number.match(/\(?[\d\s]{3}\)[\d\s]{3}-[\d\s]{4}$/);
                  }, "Invalid phone number");

              $('#customerforms').validate({ // initialize the plugin
                    rules :{
                        "name" : {
                            required : true
                        },
                       /* "phone" : {
                            /*required : true,
                            minlength: 10,
                            maxlength: 10
                            phoneUS: true
                        }*/
                        
                    },
                    messages :{
                        "name" : {
                            required : 'Please Enter Name'
                        },
                       /* "phone" : {
                            /*required : 'Please Enter Phone Number',
                            minlength: 'Phone Number Should be 10 Digits',
                            maxlength: 'Phone Number Should be 10 Digits',
                            phoneUS: "Enter Right US Phone Number"
                        }*/
                    }
              });

          });
          
          
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
            }
          }

          $("#imgInp").change(function() {
            readURL(this);
            if ($(this).val() != '') {
                upload(this);

            }
          });
          
        function upload(img) {
            var form_data = new FormData();
            console.log(form_data);
            form_data.append('file', img.files[0]);
            form_data.append('user_id', $("#user_id").val());
            form_data.append('_token', '{{csrf_token()}}');
            
            $('#loading').css('display', 'block');
            $.ajax({
                url: "{{url('ajax-image-upload')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {
                        
                    }
                    else {
                        $('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
                    }
                    $('#loading').css('display', 'none');
                }
            });
        }
          
    </script>
@endsection