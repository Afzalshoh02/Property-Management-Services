<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function sub_category_list(Request $request)
    {
        $data['getrecord'] = SubCategory::get_record($request);
        return view('admin.sub_category.list', $data);
    }

    public function sub_category_add(Request $request)
    {
        $data['getCategory'] = Category::get_record($request);
        return view('admin.sub_category.add', $data);
    }

    public function sub_category_store(Request $request)
    {
        $store = request()->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $store = new SubCategory();
        $store->category_id = trim($request->category_id);
        $store->name = trim($request->name);
        $store->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category added successfully!');
    }

    public function sub_category_edit($id, Request $request)
    {
        $data['getCategory'] = Category::get_record($request);
        $data['getrecord'] = SubCategory::get_single($id);
        return view('admin.sub_category.edit', $data);
    }

    public function sub_category_update($id, Request $request)
    {
        $store = request()->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $store = SubCategory::get_single($id);
        $store->category_id = trim($request->category_id);
        $store->name = trim($request->name);
        $store->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category updated successfully!');
    }

    public function sub_category_delete($id, Request $request)
    {
        $delete = SubCategory::get_single($id);
        $delete->is_delete = 1;
        return redirect('admin/sub_category/list')->with('success', 'Sub Category deleted successfully!');
    }
}
