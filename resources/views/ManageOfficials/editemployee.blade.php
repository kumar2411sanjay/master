@extends('theme.layouts.default')
@section('content')

<section class="content-header">
    <h5><label  class="control-label"><u>EDIT EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="active"><u>EDIT EMPLOYEE</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
          @endif
          <!-- query validater     -->
          @if($errors->any())
           @foreach ($errors->all() as $error)
              <div class="alert alert-danger">
                {{$error}}
              </div>
           @endforeach
          @endif
      <div class="row">
        <div class="col-xs-12">

<form method="post" action="/manageofficials/updateofficialsdata/{{$officialstData->id}}">
            {{ csrf_field() }}
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">EMPLOYEE</label>
       <input class="form-control input-sm" type="text" name="name" onKeyPress="return ValidateAlpha(event);" id="name"   value="{{ $officialstData->name }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">EMPLOYEE ID</label>
  <input class="form-control input-sm" type="text"  name="employee_id"  id="employee_id"   value="{{ $officialstData->employee_id }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">DESIGNATION</label>
  <input class="form-control input-sm" type="text" name="designation"  id="designation"   value="{{ $officialstData->designation }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">EMAIL ID</label>
  <input class="form-control input-sm" type="text" name="email"  value="{{ $officialstData->email }}">
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONTACT NUMBER</label>
     <input class="form-control input-sm" type="text" name="contact_number" id="contact_number"   value="{{ $officialstData->contact_number }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="telephone_number"  id="telephone_number"   value="{{ $officialstData->telephone_number }}">
</div>
<div class="col-md-3">
  <label  class="control-label">USER NAME</label>
<input class="form-control input-sm" type="text" name="username"  id="username"   value="{{ $officialstData->username }}">
</div>
<div class="col-md-3">
  <label  class="control-label">NEW PASSWORD</label>
<input class="form-control input-sm" type="password" name="password"  id="password"   value="{{ $officialstData->password }}">
</div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CONFIRM PASSWORD</label>
     <input class="form-control input-sm" type="password" name="confirmed"id="confirmed" value="{{ $officialstData->password }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">DEPARTMENT NAME</label>
  <select class="form-control input-sm" name="department_id" id="department_id" style="width: 100%;">
       @foreach($department as $departmentuser)
        <option value="{{$departmentuser->id}}" {{isset($officialstData) && $officialstData->department_id == $departmentuser->id ? 'selected="selected"' : ''}}>{{$departmentuser->depatment_name}}</option>
      @endForeach
      
  </select>
</div>
<div class="col-md-3">
  <label  class="control-label">ROLE</label>
  <select class="form-control input-sm" name="role_id" id="role_id" style="width: 100%;">

      @foreach($role as $roleuser)
      <option value="{{$roleuser->id}}" {{isset($officialstData) && $officialstData->id == $roleuser->id ? 'selected="selected"' : ''}}>{{$roleuser->name}}</option>
      @endForeach
      
  </select>
</div>

</div>
</div>
</div>



<h5><label  class="control-label"><u>COMMUNICATION ADDRESS<u></label></h5>
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3">
     <label  class="control-label">LINE1</label><span class="text-danger"><strong>*</strong></span>
       <input class="form-control input-sm" type="text" name="line1"  id="line1"   value="{{ $officialstData->line1 }}">
    </div>
  <div class="col-md-3">
    <label  class="control-label">LINE2</label>
  <input class="form-control input-sm" type="text" name="line2"  id="line2"   value="{{ $officialstData->line2 }}">
  </div>
  <div class="col-md-3">
    <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="country" id="country" style="width: 100%;">
        
        <option value="India" {{ isset($officialstData) && $officialstData->country == 'India' ? 'selected="selected"' : '' }}>India</option>
     
    </select>
  </div>
  <div class="col-md-3">
    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="state" id="state" style="width: 100%;">
        
         <?php
          $state_list = \App\Common\StateList::get_states();
              ?>
        @foreach($state_list as $state_code=>$state_ar)
          <option value="{{$state_code}}" {{ isset($officialstData) && $officialstData->state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
        @endforeach
    </select>
  </div>
</div>
<div class="row">
    <div class="col-md-3">
   <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="city"  id="city"   value="{{ $officialstData->city }}">
  </div>
<div class="col-md-3">
  <label  class="control-label">PIN CODE</label>
<input class="form-control input-sm" type="text" name="pin_code" id="pin_code" value="{{ $officialstData->pin_code }}">
</div>
<div class="col-md-3">
  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="comm_mob" id="comm_mob" value="{{ $officialstData->comm_mob }}">
</div>
<div class="col-md-3">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm" type="text" name="comm_telephone" id="comm_telephone" value="{{ $officialstData->comm_telephone }}">
</div>
</div>
<div class="row">&nbsp;</div>
 <div class="row">
    <div class="col-md-5"></div>
    <input type="hidden" value="{{ $officialstData->approve_status }}" name="approve_status">
     <div class="col-md-1"><input type="submit" class="btn btn-block btn-info btn-xs" id="update_officials" value="Update"></button></div>
     <div class="col-md-1"><a href="{{ route('employee') }}"><input type="button" class="btn btn-block btn-danger btn-xs" value="Cancel"></button></a></div>
   <div class="col-md-5"></div>
 </div>




</div>
</div>

</form>
    </section>
    
<script type="text/javascript">
function ValidateAlpha(evt)
   {
       var keyCode = (evt.which) ? evt.which : evt.keyCode
       if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

       return false;
           return true;
   }
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    @endsection