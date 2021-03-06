<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Approvalrequest;
use App\NocTemp;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use App\Client;
use App\Noc;



class NocApprovalController extends Controller
{
     public function nocapproval(Request $request)
    {
        $user_id = $request['id'];
        $client_id  =  $user_id;
         $nocData = Approvalrequest::select('id','updated_attribute_value','attribute_name','approval_type','old_att_value','client_id','created_at','updated_by')->where(function($q) { $q->where('approval_type','noc'); })->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        $Addnocdata = NocTemp::select('*')->where('client_id',$request['id'])->where('status', 0)->orderBy('created_at','desc')->get();
        $delnocData = Noc::select('*')->where('client_id',$request['id'])->where('del_status',1)->orderBy('created_at','desc')->withTrashed()->get();
        //dd($delexcgData);
        $client_details = Client:: select('company_name','iex_portfolio','pxil_portfolio','crn_no')->where('id',$request['id'])->get();
        return view('ApprovalRequest.client.noc_existing',compact('nocData','Addnocdata','delnocData','client_details'));
    }
     public function addapprove($id,$type,$type2)
       {
         
           if($id!='' && $type=='approved'){
             
                $bnc = NocTemp::find($id);
                $new_bnc = new Noc();
                $new_bnc->noc_application_no = $bnc->noc_application_no;
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->noc_type = $bnc->noc_type;
                $new_bnc->exchange = $bnc->exchange;
                $new_bnc->validity_from = $bnc->validity_from;
                $new_bnc->validity_to = $bnc->validity_to;
                $new_bnc->upload_noc = $bnc->upload_noc;
                $new_bnc->noc_quantum = $bnc->noc_quantum;
                $new_bnc->noc_periphery = $bnc->noc_periphery;
                $new_bnc->final_quantum = $bnc->final_quantum;
                $new_bnc->poc_losses = $bnc->poc_losses;
                $new_bnc->stu_losses = $bnc->stu_losses;
                $new_bnc->discom_losses = $bnc->discom_losses;
                $new_bnc->region = $bnc->region;
                $new_bnc->region_entity = $bnc->region_entity;
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1; 
                $bnc->update();
            
              
               return Redirect::back()->with('success', 'User Successfully Approved.');
               }else{
               $mm = new NocTemp;
               $mm::where('id', $id)->update(['status'=> '2']);
                return Redirect::back()->with('success', 'User Successfully Rejected.');
            }
    }
     public function clientNocApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
                $bnc = NocTemp::find($id);
                $new_bnc = new Noc();
                $new_bnc->noc_application_no = $bnc->noc_application_no;
                $new_bnc->client_id = $bnc->client_id;
                $new_bnc->noc_type = $bnc->noc_type;
                $new_bnc->exchange = $bnc->exchange;
                $new_bnc->validity_from = $bnc->validity_from;
                $new_bnc->validity_to = $bnc->validity_to;
                $new_bnc->upload_noc = $bnc->upload_noc;
                $new_bnc->noc_quantum = $bnc->noc_quantum;
                $new_bnc->noc_periphery = $bnc->noc_periphery;
                $new_bnc->final_quantum = $bnc->final_quantum;
                $new_bnc->poc_losses = $bnc->poc_losses;
                $new_bnc->stu_losses = $bnc->stu_losses;
                $new_bnc->discom_losses = $bnc->discom_losses;
                $new_bnc->region = $bnc->region;
                $new_bnc->region_entity = $bnc->region_entity;                
                $new_bnc->status= 1;
                $new_bnc->save();
                $bnc->status = 1; 
                $bnc->update();
            }         
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
            $mm = new NocTemp;
               $mm::where('id', $id)->update(['status'=> '2']);
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }

        
    }


     public function modified($id,$type)
    {
         if($id!='' && $type=='approved'){
            // $model = array('excahnge'=> 'Exchange',
            //           'client'=>'Client');
            $updatestemp = Approvalrequest::find($id); 
            //$selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $selectedmodel = new Noc;
            $exchange = $selectedmodel::find($updatestemp->reference_id); 
            $attribute_name = $updatestemp->attribute_name;
            $exchange->$attribute_name = $updatestemp->updated_attribute_value;
            $exchange->update();
            $updatestemp->status = 1;
            $updatestemp->update();          
            return Redirect::back()->with('success', 'User Successfully Approved.');

         }elseif ($id!='' && $type=='rejected') {

            Approvalrequest::where('id', $id)->update(['status'=> '2']);
            return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
    }
     public function clientNocMode(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
                  $updatestemp = Approvalrequest::find($id); 
            //$selectedmodel= '\\App\\'.$model[$updatestemp->approval_type];
            $selectedmodel = new Noc;
            $exchange = $selectedmodel::find($updatestemp->reference_id); 
            $attribute_name = $updatestemp->attribute_name;
            $exchange->$attribute_name = $updatestemp->updated_attribute_value;
            $exchange->update();
            $updatestemp->status = 1;
            $updatestemp->update();   
            }         
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
            Approvalrequest::where('id', $id)->update(['status'=> '2']);
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }

        
    }

     public function delete_noc($id,$type,$type2){

        if($id!='' && $type=='Approved'){

                  $new_bnc = new Noc;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 2;
                  $new->update();

            return Redirect::back()->with('success', 'User Successfully Approved.');
           }else{
            
                  $new_bnc = new Noc;;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 4;
                  $new->update();
                  return Redirect::back()->with('success', 'User Successfully Rejected.');
        }
     }
     public function clientNocDel(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved'){
          foreach($array as $id){
                   $new_bnc = new Noc;
                  $new =  $new_bnc::withTrashed()->find($id);
                  $new->del_status = 2;
                  $new->update(); 
            }         
            return Redirect::back()->with('success', 'Client details successfully approved.');
          }
          elseif ($tag=='Rejected') {
            foreach($array as $id){
              $new_bnc = new Noc;;
              $new =  $new_bnc::withTrashed()->find($id);
              $new->del_status = 4;
              $new->update();
            }
            return Redirect::back()->with('success', 'Client details successfully rejected.');
        }

        
    }

}
