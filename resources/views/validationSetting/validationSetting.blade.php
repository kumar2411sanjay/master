@extends('theme.layouts.default')
@section('content_head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')

<section class="content-header">
   <h5>
      <label  class="control-label"><u>Validation Setting</u></label>
   </h5>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> HOME</a></li>
      <li><a href="/basicdetails">MANAGE CLIENT</a></li>
      <li><a href="">DAM</a></li>
      <li><a href="">IEX</a></li>
      <li class="#"><u> VALIDATION SETTING </u></li>
   </ol>
     
</section>
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div class="clearfix"></div>
     @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> {{ session()->get('message') }}
    </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('updatemsg'))
    <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> {{ session()->get('updatemsg') }}
    </div>
     @endif
     <!-- query validater     -->
     <!-- success msg -->
     @if(session()->has('delmsg'))
      <div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <span class="glyphicon glyphicon-ok"></span> {{ session()->get('delmsg') }}
      </div>

     @endif

      <div class="row">
        <div class="col-xs-12">
          <form method="post" action="{{ route('validationSetting') }}">
            {{ csrf_field()}}
          <div class="box">
             <div class="box-body">
               <div class="well well-sm">
                <div class="row " >
                   <div class="col-md-6">
                      <div class="  {{ $errors->has('user_id') ? 'has-error' : '' }}">
                          <select class="" name="user_id" id="select-client" data-live-search="true">
                              <option value="">Search Client</option>
                               @foreach ($users as $key => $aa)
                               <option value="{{ $aa['id'] }}" data-tokens="{{ $aa['id'] }}.{{ $aa['id'] }}.{{ $aa['id'] }};?>" @if(isset($client_id) && $aa['id'] == $client_id) selected @endif> {{$aa->company_name}} [{{$aa->short_id}}] [{{$aa->crn_no}}] [{{$aa->iex_portfolio}}] [{{$aa->pxil_portfolio}}]</option>
                              @endforeach

                            </select>

                          <span class="text-danger">{{ $errors->first('user_id') }}</span>
                       </div>
                   </div>
                   <div class="col-md-6" style="margin-top:2px;">
                          <div class="row">
                          <div class="col-md-3"><span><input type="checkbox" class="minimal" value="NOC" name="noc" id="noc"></span> <label class="control-label" for="noc">NOC</label></div>

                          <div class="col-md-3"><span><input type="checkbox" class="minimal" value="PPA" name="ppa" id="ppa"></span> <label class="control-label" for="ppa">PPA</label></div>

                          <div class="col-md-3"><span><input type="checkbox" class="minimal" value="Exchange" name="exchange" id="exchange"></span> <label class="control-label" for="exchange">EXCHANGE</label></div>
                          <div class="col-md-3" ><span><input type="checkbox"  class="minimal" value="PSM" name="psm" id="psm"></span> <label class="control-label" for="psm">PSM</label></div>
                       </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                   <div class="col-md-1 pull-right">
                     <button type="submit" class="btn btn-block btn-info btn-xs pull-right" id="vg6" name="vg6">SAVE</button>
                   </div>
                </div>
             </div>
          </div>
        </form>
          <div class="row">
             <div class="col-md-2">
                <div class="input-group input-group-sm">
                   <input type="text" class="form-control" id="search" placeholder="SEARCH">
                   <span class="input-group-btn">
                   <button type="button" class="btn btn-info btn-flat" id="vg8" name="vg8"><span class="glyphicon glyphicon-search"></span></button>
                   </span>
                </div>
             </div>
             <div class="col-md-8"></div>
             <!-- <div class="col-md-2">
                <a href="#" class="btn btn-info btn-xs pull-right" id="vg9" name="vg9">
                   <span class="glyphicon glyphicon-plus"> </span>ADD VALIDATION
                </a>
             </div> -->
          </div>
       </div>
      </div>
    <div class="box mt3">
       <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped table-hover text-center">
             <thead>
                <tr>
                   <th>SR.NO</th>
                   <th>CLIENT NAME</th>
                   <th>NOC</th>
                   <th>PPA</th>
                   <th>EXCHANGE</th>
                   <th>PSM</th>
                   <th>ACTION</th>
                </tr>
             </thead>
             <tbody>
               <?php $i=1; ?>
               @foreach ($validationsettingData as $key => $value)
               <tr>
                 <td class="text-center" style="width:4%;">{{ $i }}</td>
                 <td class="text-center" style="width:45%;">{{$value->clients['company_name']}}</td>
                 <td class="text-center" style="width:10%;">{{ isset($value->noc) && $value->noc == 'NOC' ? 'Yes' : 'No'}}</td>
                 <td class="text-center" style="width:10%;">{{ isset($value->ppa) && $value->ppa == 'PPA' ? 'Yes' : 'No'}}</td>
                 <td class="text-center" style="width:10%;">{{ isset($value->exchange) && $value->exchange == 'Exchange' ? 'Yes' : 'No'}}</td>
                 <td class="text-center" style="width:10%;">{{ isset($value->psm) && $value->psm == 'PSM' ? 'Yes' : 'No'}}</td>
                 <!-- <td class="text-center">
                   <a href="/editvalidationsetting/{{$value->id}}"><img src="{{ asset('img/assets/edit.svg')}}" height="22" width="22"></a>
                </td> -->
                <td class="text-center" style="width:10%;">
                  <a href="/editvalidationsetting/{{$value->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                  &nbsp;&nbsp;&nbsp;
                  <a href="" data-toggle="modal" data-target="#ConvertData{{ $value->id }}" name="" id="convert-disabled"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                </td>
                  <div id="ConvertData{{ $value->id }}" class="modal fade" role="dialog">
           <form method="GET"  action="{{url('/deleteeditvalidationsetting/'.$value->id)}}">
            {{ csrf_field() }}
           <div class="modal-dialog modal-confirm">
             <div class="modal-content">
               <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                 <h4 class="modal-title text-center"></h4>
               </div> -->
               <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                <center><p style="font-size: 12px;font-weight:500;color:black!important; text-align:center;">DO YOU REALLY WANT TO DELETE THIS RECORD?</p></center> 
               </div>
               <div class="modal-footer">

                 
                <div class="text-center">
                 <button type="submit" class="btn btn-info btn-xs">YES</button>
                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">NO</button>
               </div>
               </div>
             </div>
           </div>
           </form>
         </div>
               </tr>
             <?php $i++; ?>
               @endforeach
             </tbody>
          </table>
          <div class="col-md-6"><br>
            Total Records: {{ $validationsettingData->total() }}
          </div>
          <div class="col-md-6">
            <div class="pull-right">{{$validationsettingData->links()}}</div>
          </div>
       </div>
       <!-- /.box-body -->
    </div>

  </section>

<!-- <script type="text/javascript">
 setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 2000); // <-
</script> -->
<script>
   $(function () {

     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
     $('#datepicker1').datepicker({
       autoclose: true
     })
     $('#datepicker2').datepicker({
       autoclose: true
     })
     $('#datepicker3').datepicker({
       autoclose: true
     })

   })
</script>
<script>
$(function () {
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass   : 'iradio_flat-blue'
  })

});


</script>
<script type="text/javascript">
    $(document).ready(function() {
   $('#select-client').select2();
});
</script>
<script>
  $("#search").keyup(function () {
      var value = this.value.toLowerCase().trim();

      $("table tr").each(function (index) {
          if (!index) return;
          $(this).find("td").each(function () {
              var id = $(this).text().toLowerCase().trim();
              var not_found = (id.indexOf(value) == -1);
              $(this).closest('tr').toggle(!not_found);
              return not_found;
          });
      });
  });
</script>
@endsection
