<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExchangeTemp;
use App\Exchange;
use App\Approvalrequest;
use DB;
use App\ServiseAlert;
use Validator;
use File;
use App\Client;


class ExchangeController extends Controller
{
   public function edit_exchangedetails($id='',$eid='')
   {
        $exchange_id=$eid;
        $client_id=$id;
        $get_exchange_details = Exchange::where('id',$exchange_id)->where('status',1)->withTrashed()->first();
        $exchangedetails = Exchange::where('client_id',$client_id)->where('status',1)->withTrashed()->paginate(15);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();

        return view('ManageClient.exchangedetails',compact('exchangedetails','client_id','get_exchange_details','client_details'));
    }

    public function exchangedetails($id)
    {

        $client_id=$id;
        $exchangedetails = DB::table('exchange')->select('*')->where(function($q) { $q->where('del_status',0)->orwhere('del_status',1)->orwhere('del_status',4); })->where('client_id',$id)->where('status',1)->paginate(15);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$id)->get();
        return view('ManageClient.exchangedetails',compact('exchangedetails','client_id','client_details'));
    }

    public function add_exchangedetails(Request $request)
    {
        $this->validate($request, [
            'ex_type' => 'required|max:40',
            'file_upload' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
        ]);

        $from_date = strtr($request->input('validity_from'), '/', '-');
        $validity_from = date("Y-m-d", strtotime($from_date));
        $to_date = strtr($request->input('validity_to'), '/', '-');
        $validity_to = date("Y-m-d", strtotime($to_date));

        $exchangedetail = new ExchangeTemp();
        $exchangedetail->client_id = $request->client_id;
        $exchangedetail->ex_type = $request->input('ex_type');
        $exchangedetail->validity_from = $validity_from;
        $exchangedetail->validity_to = $validity_to;

        if($file = $request->hasFile('file_upload')) 
        {
              $file = $request->file('file_upload') ;
              $fileName = 'EX_REG_'.($request->input('ex_type')).'_'.time().'_'.$file->getClientOriginalName();
              $UID_path = storage_path('/files/client/exreg');
              File::isDirectory($UID_path) or File::makeDirectory($UID_path, 0777, true, true);
              $destinationPath = $UID_path ;
              $file->move($destinationPath,$fileName);
              $exchangedetail->file_upload = $fileName;
        }
        $exchangedetail->status = 0;
        $exchangedetail->save();
        return redirect()->back()->with('message','Detail added successfully and sent to Approver');

    }

    public function update_exchangedetails(Request $request ,$exchange_detail_id)
    {
         $this->validate($request, [
            'ex_type' => 'required|max:40',
            'file_upload' => 'required',
            'validity_from' => 'required',
            'validity_to' => 'required',
        ]);

    	  $client_id = $request->input('client_id');
        $exchangedetail = Exchange::find($exchange_detail_id)->toArray();
        $datas =array();
        $datas['ex_type'] = $exchangedetail['ex_type'];
        $datas['validity_from'] = $exchangedetail['validity_from'];
        $datas['validity_to'] = $exchangedetail['validity_to'];
        $datas['file_upload'] = $exchangedetail['file_upload'];
        $from_date = strtr($request->input('validity_from'), '/', '-');
        $validity_from = date("Y-m-d", strtotime($from_date));
        $to_date = strtr($request->input('validity_to'), '/', '-');
        $validity_to = date("Y-m-d", strtotime($to_date));
        $dataArray =array();
        $dataArray['ex_type'] = $request->input('ex_type');
        $dataArray['validity_from'] = $validity_from;
        $dataArray['validity_to'] = $validity_to;
        if($file = $request->hasFile('file_upload'))
           {
              $file = $request->file('file_upload') ;
              $fileName = 'EX_REG_'.($request->input('ex_type')).'_'.time().'_'.$file->getClientOriginalName();
              $UID_path = storage_path('/app/public/uploads/ex_reg');
              $destinationPath = $UID_path ;
              $file->move($destinationPath,$fileName);
              $dataArray['file_upload'] = $fileName;
           }
        $result=array_diff($dataArray,$datas);
        $this->generateApprovalrequest($result,'exchange',$client_id,$exchange_detail_id,$datas);
        return redirect()->route('exchangedetails', ['id' => $client_id])->with('message','Detail added successfully and sent to Approver');
    }

    public function delete_exchangedetails(Request $request ,$exchange_detail_id)
    {
        $client_id=$request->input('client_id');
        $exchange = Exchange::find($exchange_detail_id);
        $exchange->del_status = 1;
        $exchange->update();

        return redirect()->back()->with('message','Delete Request has been submitted successfully  for approval.');
    }
    function generateApprovalrequest($data, $type, $client_id, $reference_id='',$datas)
    {
        $arrayKey = array_keys($data);
        $arrayValue = array_values($data);
          foreach($data as $key=>$value)
          {
           $approvalRequest = New Approvalrequest();
            $approvalRequest->client_id       = $client_id;
            $approvalRequest->attribute_name  = $key;
            $approvalRequest->updated_attribute_value =  $value;
            $approvalRequest->approval_type   = $type;
            $approvalRequest->old_att_value   = isset($datas[$key])?$datas[$key]:'-';
            $approvalRequest->status          = '0';
            $approvalRequest->reference_id    = $reference_id;
            $approvalRequest->save();
          }
    }
}
