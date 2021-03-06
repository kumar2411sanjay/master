@extends('theme.layouts.default')
@section('content')
<section class="content-header">
        <div class="col-md-7">

                <h5 class="pull-left"><label class="control-label pull-right mt-1"><u>APPROVE NOC DETAILS</u></h5> &nbsp;&nbsp;&nbsp; {{$client_details[0]['company_name']}}<span class="hifan">|</span> {{$client_details[0]['crn_no']}} <span class="hifan">|</span> {{$client_details[0]['iex_portfolio']}}<span class="hifan">|</span> {{$client_details[0]['pxil_portfolio']}}</label>
              </div>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
                  <li><a href="/client/new">APPROVE REQUEST</a></li>
                  <li><a href="/client/existing">CLIENT</a></li>
                  <li><a href="/client/existing">EXISTING</a></li>
                  <li class="#"><u>NOC DETAILS</u></li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
              
               <div class="row">
                 @if (\Session::has('success'))
                    <br><br>
                    <div class="col-md-12">
                      <div class="alert alert-success alert-dismissible fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <span class="glyphicon glyphicon-ok"></span> &nbsp; {!! \Session::get('success') !!}
                    </div>
                  </div>
                  @endif
                  <div class="col-xs-12">
                    <div class="row">
                      <div class="col-md-10">
                            <ul class="nav nav-tabs">
                               <li class="active"><a data-toggle="tab" href="#home">NEW</a></li>
                                <li><a data-toggle="tab" href="#menu1">MODIFIED</a></li>
                                <li><a data-toggle="tab" href="#menu2">DELETED</a></li>
                             </ul>
                       </div>
                      <div class="col-md-2 mt8">
                         <a href="{{url('client/existing')}}"><button type="button" class="btn btn-info btn-xs pull-right mr"><span class="glyphicon glyphicon-forward"></span>BACK TO LIST</button></a>
                       </div>
                      </div>
                     <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right">
        @if (count($Addnocdata) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-a/Approved') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted" name="cdw5" id="cdw5">APPROVE ALL</button>

              <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
            </form>
            @endif

            @if (count($Addnocdata) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-a/Rejected') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_status">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rej" name="cdw5" id="cdw5">REJECT ALL</button>

              <a data-toggle="modal" data-target="#myModalRej" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
            </form>
            @endif

                <div id="myModal" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-xs btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal">Yes</a>
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModalRej" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rej">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbutton" name="select_all"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">NOC APPLICATION NO</th>
                                             <th class="vl">NOC TYPE</th>
                                             <th class="vl">EXCHANGE TYPE</th>
                                             <th class="vl">NOC QUANTUM</th>
                                             <th class="vl">VALIDITY FROM</th>
                                             <th class="vl">VALIDITY TO</th>
                                             <th class="vl">NOC PERIPHERY</th>
                                             <th class="vl">FINAL NOC QUANTUM</th>
                                             <th class="vl">POC LOSSES(%)</th>
                                             <th class="vl">STU LOSSES(%)</th>
                                             <th class="vl">DISCOM LOSSES(%)</th>
                                             <th class="vl">FILE NAME</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @if(count($Addnocdata)>0)
                                          <?php
                                          $i=1;
                                          ?>
                                          @foreach ($Addnocdata as $key => $value)
                                          <tr>

                                              <td class="vl" style="padding:5px!important;"><input type="checkbox" name="select_all" value="{{ $value->id }}" class="minimal1 deletedbutton"></td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->noc_application_no}}</td>
                                               <td class="text-center vl">{{ ucfirst($value->noc_type)}}</td>
                                               <td class="text-center vl">{{ strtoupper($value->exchange)}}</td>
                                               <td class="text-center vl">{{ $value->noc_quantum }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                                               <td class="text-center vl">{{ $value->noc_periphery }}</td>
                                               <td class="text-center vl">{{ $value->final_quantum }}</td>
                                               <td class="text-center vl">{{ $value->poc_losses }}</td>
                                               <td class="text-center vl">{{ $value->stu_losses }}</td>
                                               <td class="text-center vl">{{ $value->discom_losses }}</td>
                                               <td class="text-center vl">
                                                  @if($value->upload_noc)
                                                    <a href="{{url('noc-file-downloads/'.$value->upload_noc)}}">View</a>
                                                  @endif
                                                </td>
                                             <td class="vl"><a href="/addnoc/{{ $value->id }}/approved/noc_temp"><span  class="text-success glyphicon glyphicon-ok" name="" id=""></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/addnoc/{{ $value->id }}/rejected/noc_temp"><span  class="text-danger glyphicon glyphicon-remove" name="" id=""></span></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @else
                                       <tr class="alert-danger" ><th colspan='15'>No Data Found.</th></tr>
                                       @endif
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4 text-right">
            @if (count($nocData) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-m/Approved') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_statusM">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deletedM" name="cdw5" id="cdw5">APPROVE ALL</button>

              <a data-toggle="modal" data-target="#myModalM" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
            </form>
            @endif

            @if (count($nocData) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-m/Rejected') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_statusM">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rejM" name="cdw5" id="cdw5">REJECT ALL</button>

              <a data-toggle="modal" data-target="#myModalRejM" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
            </form>
            @endif


                <div id="myModalM" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modalM">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModalRejM" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rejM">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                                    </div>
                                 </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox" class="minimal1 deleteallbuttonM" name="select_allM"></th>
                                             <th class="srno vl">SR.NO</th>
                                             <th class="vl">FIELD NAME</th>
                                             <th class="vl">CURRENT VALUE</th>
                                             <th class="vl">UPDATED VALUE</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>

                                              @if(count($nocData)>0)
                                          <?php
                                          $i=1;
                                           $input_lebels = \App\Common\Languages\ManageClientLang::input_labels();
                                          ?>
                                          @foreach ($nocData as $key => $value)
                                          <tr>

                                                <td class="vl" style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonM" name="select_allM" value="{{ $value->id }}"> </td>
                                               <td class="text-center vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $input_lebels[$value->attribute_name]}}</td>
                                               <td class="text-center vl">
                                                 @if(strstr($input_lebels[$value->attribute_name], 'Date') !== false)
                                                {{ date('d/m/Y',strtotime($value->old_att_value)) }}
                                                @else
                                                  {{$value->old_att_value}}
                                                @endif

                                              </td>
                                               <td class="text-center vl">
                                                @if(strstr($input_lebels[$value->attribute_name], 'Date') !== false)
                                                {{ date('d/m/Y',strtotime($value->updated_attribute_value)) }}
                                                @else
                                                  {{$value->updated_attribute_value}}
                                                @endif
                                              </td>
                                             <td class="vl"><a href="/noc/modified/{{ $value->id }}/approved"><span  class="text-success glyphicon glyphicon-ok" name="" id=""></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/noc/modified/{{ $value->id }}/rejected"><span  class="text-danger glyphicon glyphicon-remove" name="" id=""></span></a></td>
                                          </tr>
                                        <?php
                                       $i++;
                                       ?>
                                       @endforeach
                                       @else
                                       <tr class="alert-danger" ><th colspan='6'>No Data Found.</th></tr>
                                       @endif


                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                           <div class="box">
                              <div class="box-body">
                                <div class="row">
                                   <div class="col-md-2"></div>
                                   <div class="col-md-6"></div>
                                   <div class="col-md-4 text-right">
        @if (count($delnocData) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-d/Approved') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_statusD">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deletedD" name="cdw5" id="cdw5">APPROVE ALL</button>

              <a data-toggle="modal" data-target="#myModalD" class="btn btn-sm btn-info btn-xs">APPROVE ALL</a>
            </form>
            @endif

            @if (count($delnocData) > 0)
            <form class="pull-right" action="{{ url()->to('client/noc-d/Rejected') }}" method="post" id="approve_data">
              {{ csrf_field() }}
              <input type="hidden" name="selected_status" class="selected_statusD">
              <button type="submit" class="btn  btn-info btn-xs hidden submit-all-deleted-rejD" name="cdw5" id="cdw5">REJECT ALL</button>

              <a data-toggle="modal" data-target="#myModalRejD" class="btn btn-danger btn-xs mlt">REJECT ALL</a>
            </form>
            @endif


                <div id="myModalD" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO APPROVED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modalD">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModalRejD" class="modal fade" style="display: none;">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <!-- <div class="modal-header" style="border-bottom: 2px solid #e5e5e5;">
                        <h4 class="modal-title text-center">ARE YOU SURE?</h4>
                      </div> -->
                      <div class="modal-body" style="border-bottom: 2px solid #e5e5e5;">
                        <center><p style="font-size: 12px;font-weight: 500;color:black!important;">DO YOU REALLY WANT TO REJECTED ALL RECORDS? </p></center>
                      </div>
                      <div class="modal-footer">
                         <div class="text-center">
                        <button type="button" href="#"   class="btn btn-info">
                          <a href="" style="color:#fff;text-decoration:none" id="delete-button-modal-rejD">Yes</a>
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

                                   </div>
                                </div>
                                 <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                       <thead>
                                          <tr>
                                             <th class="chy" style="padding:5px!important;"><input type="checkbox"  class="minimal1 deleteallbuttonD" name="select_allD"></th>
                                             <th class="srno">SR.NO</th>
                                             <th class="vl" >NOC TYPE</th>
                                             <th class="vl">NOC QUANTUM</th>
                                             <th class="vl">VALIDITY FROM</th>
                                             <th class="vl">VALIDITY TO</th>
                                             <th class="vl">NOC PERIPHERY</th>
                                             <th class="vl">FINAL NOC QUANTUM</th>
                                             <th class="vl">POC LOSSES</th>
                                             <th class="vl">STU LOSSES</th>
                                             <th class="vl">DISCOM LOSSES</th>
                                             <th class="vl">FILE NAME</th>
                                             <th class="act vl">ACTION</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                                @if(count($delnocData)>0)
                                                  <?php
                                                  $i=1;
                                                  ?>
                                                  @foreach ($delnocData as $key => $value)


                                                <tr>
                                                  <td class="vl" style="padding:5px!important;"><input type="checkbox" class="minimal1 deletedbuttonD" name="select_allD" value="{{ $value->id }}"></td>
                                                   <td class="vl">{{ $i }}</td>
                                               <td class="text-center vl">{{ $value->noc_type}}</td>
                                               <td class="text-center vl">{{ $value->noc_quantum }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_from)) }}</td>
                                               <td class="text-center vl">{{ date('d/m/Y',strtotime($value->validity_to)) }}</td>
                                               <td class="text-center vl">{{ $value->noc_periphery }}</td>
                                               <td class="text-center vl">{{ $value->final_quantum }}</td>
                                               <td class="text-center vl">{{ $value->poc_losses }}</td>
                                               <td class="text-center vl">{{ $value->stu_losses }}</td>
                                               <td class="text-center vl">{{ $value->discom_losses }}</td>
                                               <td class="text-center vl">{{ $value->upload_noc }}</td>
                                                    <td class="text-center vl">

                                                          <a href="/delete_noc/{{ $value->id }}/approved/noc"><span  class="text-success glyphicon glyphicon-ok" name="" id=""></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                          <a href="/delete_noc/{{ $value->id }}/rejected/noc"><span  class="text-danger glyphicon glyphicon-remove" name="" id=""></span></a>

                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                                ?>

                                            @endforeach
                                           @else
                                           <tr class="alert-danger" ><th colspan='13'>No Data Found.</th></tr>
                                           @endif
                                          </tr>

                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            @endsection
@section('content_foot')

  <script>
    $(function () {
        $('input[type="checkbox"].minimal1, input[type="radio"].minimal1').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
      });

    });

    </script>
     <script type="text/javascript">
            $('.deletedbutton').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_status').val(array);
            });
            $('.deletedbutton').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbutton').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_status').val(array);
            });
      $(document).delegate('#delete-button-modal','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rej','click',function(){
        if(!$(".selected_status").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rej").trigger('click');
         return false;
      }
      });


            $(".deleteallbutton").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbutton").iCheck('check');
                    var array = [];
                    $('.deletedbutton').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_status').val(array);
                  }else{
                      $('.selected_status').val('');
                    $(".deletedbutton").iCheck('uncheck');
                  }
            });
            $('.deleteallbutton').on('ifUnchecked', function(event) {
                $('.selected_status').val('');
                $(".deletedbutton").iCheck('uncheck');
            });

    </script>
    <script type="text/javascript">
            $('.deletedbuttonM').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbuttonM').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_statusM').val(array);
            });
            $('.deletedbuttonM').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbuttonM').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_statusM').val(array);
            });


      $(document).delegate('#delete-button-modalM','click',function(){
        if(!$(".selected_statusM").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deletedM").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rejM','click',function(){
        if(!$(".selected_statusM").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rejM").trigger('click');
         return false;
      }
      });

            $(".deleteallbuttonM").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbuttonM").iCheck('check');
                    var array = [];
                    $('.deletedbuttonM').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_statusM').val(array);
                  }else{
                      $('.selected_statusM').val('');
                    $(".deletedbuttonM").iCheck('uncheck');
                  }
            });
            $('.deleteallbuttonM').on('ifUnchecked', function(event) {
                $('.selected_statusM').val('');
                $(".deletedbuttonM").iCheck('uncheck');
            });


    </script>
    <script type="text/javascript">
            $('.deletedbuttonD').on('ifChecked', function(event) {
              var array = [];
              $('.deletedbuttonD').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
              $('.selected_statusD').val(array);
            });
            $('.deletedbuttonD').on('ifUnchecked', function(event){
              var array = [];
              $('.deletedbuttonD').each(function(){
                if($(this).prop('checked')){
                  array.push($(this).val());
              }
              });
                $('.selected_statusD').val(array);
            });


      $(document).delegate('#delete-button-modalD','click',function(){
        if(!$(".selected_statusD").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deletedD").trigger('click');
         return false;
      }
      });
      $(document).delegate('#delete-button-modal-rejD','click',function(){
        if(!$(".selected_statusD").val()){
          alert('please check some status to proceed');

        }else{
        $(".submit-all-deleted-rejD").trigger('click');
         return false;
      }
      });

            $(".deleteallbuttonD").on('ifChecked', function(event) {
                  if($(this).iCheck('check')){
                    $(".deletedbuttonD").iCheck('check');
                    var array = [];
                    $('.deletedbuttonD').each(function(){
                      if($(this).iCheck('check')){
                        array.push($(this).val());
                    }
                    });
                    $('.selected_statusD').val(array);
                  }else{
                      $('.selected_statusD').val('');
                    $(".deletedbuttonD").iCheck('uncheck');
                  }
            });
            $('.deleteallbuttonD').on('ifUnchecked', function(event) {
                $('.selected_statusD').val('');
                $(".deletedbuttonD").iCheck('uncheck');
            });

    </script>
 <script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
  </script>
   <script>
 function myFunction() {
 var input, filter, table, tr, td, i;
 input = document.getElementById("input");
 filter = input.value.toUpperCase();
 table = document.getElementById("example1");
 tr = table.getElementsByTagName("tr");
 console.log(tr);
 for (i = 0; i < tr.length; i++) {
   td = tr[i].getElementsByTagName("td")[1];
   if (td) {
     if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
       tr[i].style.display = "";
     } else {
       tr[i].style.display = "none";
     }
   }
 }
}
</script>
@endsection