<?php

namespace App\Http\Controllers;

use App\Models\Vendortype;
use Illuminate\Http\Request;

class VendortypeController extends Controller
{
    public function vendor_type_list(Request $request)
    {
        $data['getrecord'] = Vendortype::get_record($request);
        return view('admin.vendor_type.list', $data);
    }

    public function vendor_type_add()
    {
        return view('admin.vendor_type.add');
    }

    public function vendor_type_store(Request $request)
    {
        $save = request()->validate([
            'name' => 'required|unique:vendortypes',
        ]);
        $save = new Vendortype();
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/vendor_type/list')->with('success', 'Vendor Type Updated Successfully');
    }

    public function vendor_type_edit($id, Request $request)
    {
        $data['getrecord'] = Vendortype::get_single($id);
        return view('admin/vendor_type/edit', $data);
    }

    public function vendor_type_update($id, Request $request)
    {
        $save = request()->validate([
            'name' => 'required|unique:vendortypes,name,'.$id,
        ]);
        $save = Vendortype::get_single($id);
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/vendor_type/list')->with('success', 'Vendor Type Updated Successfully');
    }

    public function vendor_type_delete($id, Request $request)
    {
        $delete = Vendortype::get_single($id);
        $delete->is_delete = 1;
        return redirect('admin/vendor_type/list')->with('success', 'Vendor Type Deleted Successfully');
    }
}
