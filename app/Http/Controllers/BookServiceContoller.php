<?php

namespace App\Http\Controllers;

use App\Models\AMCModel;
use App\Models\BookService;
use App\Models\BookServiceImage;
use App\Models\Category;
use App\Models\ServiceType;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class BookServiceContoller extends Controller
{
    public function service_history_list(Request $request)
    {
        $data['getrecord'] = BookService::getBookService(Auth::user()->id, $request);
        return view('user.book_service.list', $data);
    }
    public function book_service_add()
    {
        $data['getServiceType'] = ServiceType::get_record_delete();
        $data['getCategory'] = Category::get_record_delete();
        $data['getAMC'] = AMCModel::where('id', Auth::user()->amc_id)->first();
        return view('user.book_service.add', $data);
    }
    public function book_service_dropdown(Request $request)
    {
        $data['get_sub_category'] = SubCategory::where('category_id', $request->cat_id)
            ->get(['name', 'id']);
        return response()->json($data);
    }
    public function book_service_store(Request $request)
    {
        $insert_r = new BookService();
        $insert_r->user_id = Auth::user()->id;
        $insert_r->service_type_id = trim($request->service_type_id);
        $insert_r->category_id = trim($request->category_id);
        $insert_r->sub_category_id = trim($request->sub_category_id);
        $insert_r->amc_free_service_id = trim($request->amc_free_service_id);
        $insert_r->description = trim($request->description);
        $insert_r->special_instructions= trim($request->special_instructions);
        $insert_r->pet = trim($request->pet);
        $insert_r->available_date = trim($request->available_date);
        $insert_r->save();
        if (!empty($request->option)) {
            foreach ($request->option as $value) {

                if (!empty($value['attachment_image'])) {
                    $option_ind = new BookServiceImage();
                    $option_ind->book_service_id = $insert_r->id;
                    $file = $value['attachment_image'];
                    $randomStr = \Illuminate\Support\Str::random(30);
                    $filename = $randomStr . '.' . $file->getClientOriginalExtension();
                    $file->move('uploads/service/',$filename);
                    $option_ind->attachment_image = $filename;
                    $option_ind->save();
                }
            }
        }
        return redirect('user/book_service/list')->with('success', 'Record Successfully Create');
    }
}
