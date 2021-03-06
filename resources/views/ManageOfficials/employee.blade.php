@extends('theme.layouts.default')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>ADD EMPLOYEE</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
        <li><a href="#"><u>ADD EMPLOYEE</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="{{ route('employee') }}" class="btn btn-info btn-xs pull-right mt7"  id="ram" name="">
           <span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a>
          </div>
          </div>
<form method="post" action="/manageofficials/saveofficialsdata">
  {{ csrf_field() }}
<div class="box mt3">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
     <label  class="control-label">EMPLOYEE NAME</label><span class="text-danger"><strong>*</strong></span>
       <input class="form-control input-sm valid" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="EMPLOYEE NAME">
       <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('employee_id') ? 'has-error' : '' }}">
    <label  class="control-label">EMPLOYEE ID</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text"  name="employee_id" id="employee_id" value="{{ old('employee_id') }}" placeholder="EMPLOYEE ID">
  <span class="text-danger">{{ $errors->first('employee_id') }}</span>
  </div>
  <div class="col-md-3 {{ $errors->has('designation') ? 'has-error' : '' }}">
    <label  class="control-label">DESIGNATION</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm alphnum" type="text" name="designation" id="designation" value="{{ old('designation') }}" placeholder="DESIGNATION">
  <span class="text-danger">{{ $errors->first('designation') }}</span>
  </div>
  <div class="col-md-3 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label  class="control-label">EMAIL ID</label><span class="text-danger"><strong>*</strong></span>
  <input class="form-control input-sm" type="text" name="email" id="email" placeholder="EMAIL ID" value="{{ old('email') }}">
  <span class="text-danger">{{ $errors->first('email') }}</span>
  </div>
</div>
<div class="row">
    <div class="col-md-3 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
   <label  class="control-label">CONTACT NUMBER</label><span class="text-danger"><strong>*</strong></span>
     <input class="form-control input-sm mobile" maxlength="10" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" placeholder="CONTACT NUMBER">
     <span class="text-danger">{{ $errors->first('contact_number') }}</span>
  </div>
<div class="col-md-3 {{ $errors->has('telephone_number') ? 'has-error' : '' }}">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm num" maxlength="15" type="text" name="telephone_number" id="telephone_number" value="{{ old('telephone_number') }}" placeholder="TELEPHONE NUMBER">
<span class="text-danger">{{ $errors->first('telephone_number') }}</span>
</div>
<div class="col-md-3 {{ $errors->has('username') ? 'has-error' : '' }}">
  <label  class="control-label">USER NAME</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="text" name="username" id="username" value="{{ old('username') }}" placeholder="USER NAME">
<span class="text-danger">{{ $errors->first('username') }}</span>
</div>
<div class="col-md-3 {{ $errors->has('password') ? 'has-error' : '' }}">
  <label  class="control-label">NEW PASSWORD</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm" type="password" name="password" id="password" value="" placeholder="NEW PASSWORD">
<span class="text-danger">{{ $errors->first('password') }}</span>

</div>
</div>
<div class="row">
    <div class="col-md-3 {{ $errors->has('confirmed') ? 'has-error' : '' }}">
   <label  class="control-label">CONFIRM PASSWORD</label><span class="text-danger"><strong>*</strong></span>
     <input class="form-control input-sm" type="password" name="confirmed" id="confirmed" value="" placeholder="CONFIRM PASSWORD">
     <span class="text-danger">{{ $errors->first('confirmed') }}</span>
  </div>
<div class="col-md-3 {{ $errors->has('department_id') ? 'has-error' : '' }}">
  <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
  <select class="form-control input-sm" name="department_id" id="department_id">
     <option value="">Select</option>
         @foreach($department as $departmentuser)
        <option value="{{$departmentuser->id}}" @if(old('department_id')==$departmentuser->id)selected='selected'@endif>{{$departmentuser->depatment_name}}</option>
          @endForeach
        </select>
        <span class="text-danger">{{ $errors->first('role_id') }}</span>
        
        <div class="mda-form-control-line"></div>

   </div>
<div class="col-md-3 {{ $errors->has('role_id') ? 'has-error' : '' }}">
  <label  class="control-label">ROLE</label><span class="text-danger"><strong>*</strong></span>
  <select class="form-control input-sm" name="role_id" id="role_id" style="width: 100%;">
    <option value="">Select</option>
     @foreach($role as $roleuser)
      @if(old('role_id')==$roleuser->id)
        <option value="{{$roleuser->id}}" @if(old('role_id')==$roleuser->id)selected='selected'@endif >{{$roleuser->name}}</option>
        @endif
          @endForeach
        </select>
        <span class="text-danger">{{ $errors->first('role_id') }}</span>
        <div class="mda-form-control-line"></div>

</div>

</div>
</div>
</div>



<h5><label  class="control-label"><u>COMMUNICATION ADDRESS<u></label></h5>
<div class="box">
  <div class="box-body">
  <div class="row">
      <div class="col-md-3 {{ $errors->has('line1') ? 'has-error' : '' }}">
     <label  class="control-label">LINE1</label><span class="text-danger"><strong>*</strong></span>
       <input class="form-control input-sm" type="text" name="line1" id="line1" value="{{ old('line1') }}" placeholder="EMPLOYEE ADDRESS LINE1">
       <span class="text-danger">{{ $errors->first('line1') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('line2') ? 'has-error' : '' }}">
    <label  class="control-label">LINE2</label>
  <input class="form-control input-sm" type="text" name="line2" id="line2" value="{{ old('line2') }}" placeholder="EMPLOYEE ADDRESS LINE2">
  <span class="text-danger">{{ $errors->first('line2') }}</span>
  </div>
  <div class="col-md-3 {{ $errors->has('country') ? 'has-error' : '' }}">
    <label  class="control-label">COUNTRY</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="country" id="country" style="width: 100%;">
        <option value="INDIA">INDIA</option>
    </select>
    <span class="text-danger">{{ $errors->first('country') }}</span>
  </div>
  <div class="col-md-3 {{ $errors->has('state') ? 'has-error' : '' }}">
    <label  class="control-label">STATE</label><span class="text-danger"><strong>*</strong></span>
    <select class="form-control input-sm select2" name="state" id="state" style="width: 100%;">
        <option value="">SELECT STATE</option>
          <?php
          $state_list = \App\Common\StateList::get_states();
          ?>
          @foreach($state_list as $state_code=>$state_ar)
           <option value="{{$state_code}}" {{ isset($clientData) && $clientData->reg_state == $state_code ? 'selected="selected"' : '' }}>{{$state_ar['name']}}</option>
          @endforeach
    </select>
    <span class="text-danger">{{ $errors->first('state') }}</span>
  </div>
</div>
<div class="row">
    <div class="col-md-3 {{ $errors->has('city') ? 'has-error' : '' }}">
   <label  class="control-label">CITY/TOWN</label><span class="text-danger"><strong>*</strong></span>
   <input class="form-control input-sm" type="text" name="city" id="city" value="{{ old('city') }}" placeholder="CITY/TOWN">
   <span class="text-danger">{{ $errors->first('city') }}</span>
  </div>
<div class="col-md-3 {{ $errors->has('pin_code') ? 'has-error' : '' }}">
  <label  class="control-label">PIN CODE</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm mobile" maxlength="6" type="text" name="pin_code" id="pin_code" value="{{ old('pin_code') }}" placeholder="PIN CODE">
<span class="text-danger">{{ $errors->first('pin_code') }}</span>
</div>
<div class="col-md-3 {{ $errors->has('comm_mob') ? 'has-error' : '' }}">
  <label  class="control-label">MOBILE NUMBER</label><span class="text-danger"><strong>*</strong></span>
<input class="form-control input-sm mobile" maxlength="10" type="text" name="comm_mob" id="comm_mob" value="{{ old('comm_mob') }}" placeholder="MOBILE NUMBER">
<span class="text-danger">{{ $errors->first('comm_mob') }}</span>
</div>
<div class="col-md-3 {{ $errors->has('comm_telephone') ? 'has-error' : '' }}">
  <label  class="control-label">TELEPHONE NUMBER</label>
<input class="form-control input-sm num" maxlength="15" type="text" name="comm_telephone" id="comm_telephone" value="{{ old('comm_telephone') }}" placeholder="TELEPHONE NUMBER">
<span class="text-danger">{{ $errors->first('comm_telephone') }}</span>
</div>
</div>
<div class="row">&nbsp;</div>
 <div class="row">

      <div class="col-md-10"></div>
      <div class="col-md-1 "><button type="submit" class="btn btn-info btn-block btn-xs" id="save_officials">SAVE</button></div>
      <div class="col-md-1 "><a href="{{ route('employee') }}" class="btn btn-danger btn-block btn-xs" value="Cancel">CANCEL</a></div>

   </div>
 </div>
</div>
</div>

</form>
    </section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <script>

 $(document).ready(function(){
   $('#department_id').on('change', function() {

     var department_id=this.value;
     if(department_id!='')
     {
       $.ajax({
           url: '{{ url()->to("get_ajax_role") }}',
           type: 'GET',
           data: {'department_id':department_id},
           dataType: 'JSON',
           success: function(data)
           {
             html1='';
             html1+='<option value="">CHOOSE</option>';
             $.each(data.role, function(key1, value1){
              //console.log(value1.name);
               html1+='<option value="'+value1.id+'">'+value1.name+'</option>';
             });
             $('#role_id').html(html1);
           }
       });
     }
   });

 });
</script>
  @endsection
