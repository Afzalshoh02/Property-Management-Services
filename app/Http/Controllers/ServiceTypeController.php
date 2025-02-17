<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function service_type_list(Request $request)
    {
        $data['getrecord'] = ServiceType::get_record($request);
        return view('admin.service_type.list', $data);
    }

    public function service_type_add()
    {
        return view('admin.service_type.add');
    }

    public function service_type_add_post(Request $request)
    {
        $save = request()->validate([
            'name' => 'required|unique:service_types',
        ]);
        $save = new ServiceType();
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/service_type/list')->with('success', 'Service Type Added Successfully');
    }

    public function service_type_edit(Request $request, $id)
    {
        $data['getrecord'] = ServiceType::get_single($id);
        return view('admin/service_type/edit', $data);
    }

    public function service_type_edit_update($id, Request $request)
    {
        $save = request()->validate([
            'name' => 'required|unique:service_types,name,'.$id,
        ]);
        $save = ServiceType::get_single($id);
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/service_type/list')->with('success', 'Service Type Updated Successfully');
    }

    public function service_type_edit_delete($id, Request $request)
    {
        $delete = ServiceType::get_single($id);
        $delete->is_delete = 1;
        $delete->save();
        return redirect('admin/service_type/list')->with('success', 'Service Type Deleted Successfully');
    }
}
