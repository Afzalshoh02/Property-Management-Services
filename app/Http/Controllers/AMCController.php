<?php

namespace App\Http\Controllers;

use App\Models\AmcAddOns;
use App\Models\AmcFreeService;
use App\Models\AMCModel;
use http\Exception\BadUrlException;
use Illuminate\Http\Request;

class AMCController extends Controller
{
    public function amc_list(Request $request)
    {
        $data['getrecord'] = AMCModel::get_record($request);
        return view('admin.amc.list', $data);
    }
    public function amc_add()
    {
        return view('admin.amc.add');
    }
    public function amc_insert(Request $request)
    {
        $user = request()->validate([
            'name' => 'required|unique:amc',
            'amount' => 'required'
        ]);
        $user = new AMCModel();
        $user->name = trim($request->name);
        $user->amount = trim($request->amount);
        $user->business_category = trim($request->business_category);
        $user->series = trim($request->series);
        $user->save();

        return redirect('admin/amc/list')->with('success', 'Record successfully Created');
    }
    public function amc_edit($id, Request $request)
    {
        $data['getrecord'] = AMCModel::get_single($id);
        return view('admin.amc.edit', $data);
    }
    public function amc_update($id, Request $request)
    {
        $user = request()->validate([
            'name' => 'required|unique:amc,name,'.$id,
            'amount' => 'required'
        ]);
        $user = AMCModel::get_single($id);
        $user->name = trim($request->name);
        $user->amount = trim($request->amount);
        $user->business_category = trim($request->business_category);
        $user->series = trim($request->series);
        $user->save();

        return redirect('admin/amc/list')->with('success', 'Record successfully Created');
    }
    public function amc_delete($id, Request $request)
    {
        $delete_record = AMCModel::get_single($id);
        $delete_record->is_delete = 1;
        $delete_record->save();
        return redirect()->back()->with('error', 'Record successfully deleted!');
    }

    public function amc_add_ons_list($id, Request $request)
    {
        $data['getrecord'] = AMCModel::get_single($id);
        $data['get_add_ons'] = AmcAddOns::get_add_ons($id);
        return view('admin.amc.add_ons_list', $data);
    }
    public function amc_add_ons_add($id, Request $request)
    {
        $data['getrecord'] = AMCModel::get_single($id);
        return view('admin.amc.add_ons_add', $data);
    }
    public function amc_store_add_ons(Request $request)
    {
        $insert_r = request()->validate([
           'amc_id' => 'required',
           'name' => 'required',
           'price' => 'required'
        ]);
        $insert_r = new AmcAddOns();
        $insert_r->amc_id = trim($request->amc_id);
        $insert_r->name = trim($request->name);
        $insert_r->price = trim($request->price) ? $request->price : 0;
        $insert_r->save();
        return redirect('admin/amc/add_ons/'.$request->amc_id)->with('success', 'Record Successfully Created');
    }
    public function amc_edit_add_ons($id, Request $request)
    {
        $data['getrecord'] = AmcAddOns::get_single($id);
        return view('admin.amc.add_ons_edit', $data);
    }
    public function amc_edit_add_ons_update($id, Request $request)
    {
        $update = AmcAddOns::get_single($id);
        $update->name = trim($request->name);
        $update->price = !empty($request->price) ? $request->price : 0;
        $update->save();
        return redirect('admin/amc/add_ons/'.$update->amc_id)->with('success', 'Record Successfully Updated');
    }
    public function delete_add_ons($id, Request $request)
    {
        $delete_record = AmcAddOns::get_single($id);
        $delete_record->delete();
        return redirect()->back()->with('error', 'Record successfully deleted');
    }
    public function amc_free_service($id, Request $request)
    {
        $data['getrecord'] = AMCModel::get_single($id);
        $data['get_free_service'] = AmcFreeService::get_free_service($id);
        return view('admin.amc.free_service_list', $data);
    }
    public function amc_add_free_service($id, Request $request)
    {
        $data['getrecord'] = AMCModel::get_single($id);
        return view('admin.amc.free_service_add', $data);
    }
    public function amc_store_free_service($id, Request $request)
    {
        $insert_r = request()->validate([
            'amc_id' => 'required',
            'name' => 'required',
            'limits' => 'required',
            'price' => 'required'
        ]);
        $insert_r = new AmcFreeService();
        $insert_r->amc_id = trim($request->amc_id);
        $insert_r->name = trim($request->name);
        $insert_r->limits = trim($request->limits);
        $insert_r->price = trim($request->price);
        $insert_r->save();
        return redirect('admin/amc/free_service/'.$request->amc_id)->with('success', 'AMC Free Service successfully save');
    }
}
