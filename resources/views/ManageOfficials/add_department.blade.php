@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <h5><label  class="control-label">ADD DEPARTMENT</label></h5>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li><a href="#">MANAGE EMPLOYEE</a></li>
            <li><a href="active">DEPARTMENT</a></li>
         </ol>
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="row">
            <div class="col-xs-12">

               <div class="box">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-3">
                           <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
                           <input class="form-control input-sm" type="text" placeholder="ENTER DEPARTMENT NAME">
                        </div>
                        <div class="col-md-3">
                           <label  class="control-label">DESCRIPTION</label>
                           <input class="form-control input-sm" type="text" placeholder="ENTER DESCRIPTION">
                        </div>
                        <div class="col-md-1" style="margin-top:19px!important;">
                           <label  class="control-label"></label>
                           <button type="button" class="btn btn-block btn-info btn-xs">SAVE</button>
                        </div>
                     </div>
                  </div>
               </div>

             </div>
          </div>

      </section>
     <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>

  @endsection
