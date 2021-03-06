@extends('theme.layouts.default')
@section('content')
    <section class="content-header">
      <h5><label  class="control-label"><u>ALL LEAD</u></label></h5>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="lead">CRM</a></li>
        <li class="active"><u>LEAD</u></li>
      </ol>
    </section>
    <section class="content">
  @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span class="glyphicon glyphicon-ok"></span> {!! \Session::get('success') !!}
    </div>


  @endif


      <div class="row">
        <div class="col-xs-12">
          <div class="row">
              <div class="col-md-2">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="SEARCH" id="search" name=" " onkeyup="myFunction()">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id=" " name=" "><span class="glyphicon glyphicon-search"></span></button>
                    </span>
              </div></div>
          <div class="col-md-8"></div>
          <div class="col-md-2">
            <a href="{{ route('lead.create') }}" class="btn btn-info btn-xs pull-right" id="ram" name=" ">
            <span class="glyphicon glyphicon-plus"> </span>&nbspCREATE LEAD</a>
          </div>
          </div>
          <div class="box mt3">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover text-center">
                <thead>
                <tr>
                  <th class="srno">SR.NO</th>
                  <th>LEAD NO</th>
                  <th>COMPANY NAME</th>
                  <th>EMAIL ID</th>
                  <th>CONTACT NUMBER</th>
                  <th>LEAD SOURCE</th>
                  <th>LEAD OWNER</th>
                </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @if (count($leads) > 0)
                     @foreach ($leads as $k=>$lead)
                      <tr>
                        <td>{{ $k + $leads->firstItem() }}</td>
                        <td>{{$lead->leadID}}</td>
                        <td><a href="{{ route('lead.edit',[$lead->id]) }}">{{$lead->company_name}}</a></td>
                        <td>{{$lead->email_id}}</td>
                        <td>{{$lead->contact_number}}</td>
                        <td>{{@$lead->leadsource->name}}</td>
                        <td>{{@$lead->leadowner->name}}</td>
                      </tr>
                        @php $i++; @endphp
                    @endforeach
                  @else
                    <tr>
                        <td colspan="8" style="background-color: #c74343a6;"><b>No Data Found.</b></td>
                    </tr>
                  @endif
                </tbody>
                </table>
                 {{ $leads->links() }}
            </div>
          </div>
    </div>
  </div>
    </section>
    <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script type="text/javascript">
     setTimeout(function() {
       $('#successMessage').fadeOut('fast');
       }, 2000); // <-
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
