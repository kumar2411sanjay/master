@extends('theme.layouts.default')
@section('content')
      <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5><label  class="control-label"><u>{{ (@$role->id!='')?'EDIT ROLE':'ADD ROLE'}}</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="#">MANAGE EMPLOYEE</a></li>
         <li><a href="#">ROLE & PERMISION</a></li>
        <li><a href="{{ route('roles.index') }}"><u>EDIT ROLE</u></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="{{ route('roles.index') }}" class="btn btn-info btn-xs pull-right mt7"  id="ram" name="">
           <span class="glyphicon glyphicon-forward"></span>&nbsp BACK TO LIST</a>
          </div>
          </div>

<div class="box mt3">
  <div class="box-body">

  <form method="post" action="{{ (@$role->id!='')?url('/roles/'.$role->id):route('roles.store')}}">
            {{ csrf_field() }}
            {{ (@$role->id!='')?method_field('PATCH'):method_field('POST')}}
  <div class="row">
      <div class="col-md-3 {{ $errors->has('department') ? 'has-error' : '' }}">
     <label  class="control-label">DEPARTMENT NAME<span class="text-danger"><strong>*</strong></span></label>
       <select class="form-control input-sm" name="department">
         <option value="">SELECT DEPARTMENT</option>
         @if(count($department) > 0)
          @foreach($department as $department_data)
            <option value="{{ $department_data->id }}" @if((isset($role->id)&& $role->department_id==$department_data->id)||old('department')==$department_data->id)selected='selected' @endif>{{ $department_data->depatment_name }}</option>
          @endforeach
          @else
           <option value="">NO DATA FOUND.</option>
         @endif

       </select>
        <span class="text-danger">{{ $errors->first('department') }}</span>
    </div>
  <div class="col-md-3 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label  class="control-label">ROLE<span class="text-danger"><strong>*</strong></span></label>
  <input class="form-control input-sm" type="text" placeholder="ENTER ROLE" name="name" value="{{(isset($role->id)&& $role->name)?$role->name:old('name')}}">
    <span class="text-danger">{{ $errors->first('name') }}</span>
  </div>
 <div class="col-md-4">
 </div>  
<div class="col-md-1 mt3">
  <label  class="control-label"></label>
  <button type="submit" class="btn btn-block btn-info btn-xs">SAVE</button>
</div>
<div class="col-md-1" style="margin-top:21px;">
  <a href="{{ route('roles.index') }}"><input type="button"  class="btn btn-danger btn-block  btn-xs pull-right"value="Cancel"></a>
</div>
</div>
</form>
</div>
</div>

    </section>

      <!-- /.content -->
  @endsection
