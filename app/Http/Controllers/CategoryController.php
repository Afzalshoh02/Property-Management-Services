<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use function Psy\bin;

class CategoryController extends Controller
{
    public function category_list(Request $request)
    {
        $data['getrecord'] = Category::get_record($request);
        return view('admin.category.list', $data);
    }
    public function category_add()
    {
        return view('admin.category.add');
    }
    public function category_insert(Request $request)
    {
        $save = request()->validate([
           'name' => 'required|unique:categories',
        ]);
        $save = new Category();
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/category/list')->with('success', 'Record Successfully Create');
    }
    public function category_edit($id, Request $request)
    {
        $data['getrecord'] = Category::get_single($id);
        return view('admin.category.edit', $data);
    }
    public function category_update($id, Request $request)
    {
        $save = request()->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        $save = Category::get_single($id);
        $save->name = trim($request->name);
        $save->save();
        return redirect('admin/category/list')->with('success', 'Record Successfully Updated');
    }
    public function category_delete($id, Request $request)
    {
        $save = Category::get_single($id);
        $save->is_delete = 1;
        $save->save();
        return redirect('admin/category/list')->with('success', 'Record Successfully Deleted');
    }
}
