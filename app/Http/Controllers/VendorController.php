<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Mail\VendorRegisterMail;
use App\Models\Category;
use App\Models\User;
use App\Models\Vendortype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function vendor_list(Request $request)
    {
        $data['getrecord'] = User::get_record($request);
        return view('admin.vendor.list',$data);
    }

    public function vendor_add(Request $request)
    {
        $data['getVendorType'] = VendorType::get_record($request);
        $data['getCategory'] = Category::get_record($request);
        return view('admin.vendor.add', $data);
    }

    public function vendor_store(Request $request)
    {
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'status' => 'required',
            'category_id' => 'required',
            'vendor_type_id' => 'required',
        ]);
        $user = new User();
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->vendor_type_id = trim($request->vendor_type_id);
        $user->employee_id = trim($request->employee_id);
        $user->mobile = trim($request->mobile);
        if (!empty($request->file('profile'))) {
            $file = $request->file('profile');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile/', $filename);
            $user->profile = $filename;

        }
        $user->category_id = trim($request->category_id);
        $user->always_assign = trim($request->always_assign);
        $user->company_name = trim($request->company_name);
        $user->status = trim($request->status);
        $user->is_admin = 2;
        $user->remember_token = Str::random(50);
        $user->forgot_token = Str::random(50);
        $user->save();
//        $this->sern_vendor_verification_mail($user);
        return redirect('admin/vendor/list')->with('success', 'Vendor added successfully!');
    }

    public function sern_vendor_verification_mail($user)
    {
        Mail::to($user->email)->send(new VendorRegisterMail($user));
    }
    public function vendor_password(Request $request, $token)
    {
        $user = User::where('forgot_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $data['token'] =  $token;
        return view('admin.vendor.password', $data);
    }
    public function vendor_password_post($token, ResetPasswordRequest $request)
    {
        $user = User::where('forgot_token', '=', $token);
        if ($user->count() === 0) {
            abort(403);
        }
        $user = $user->first();
        $user->remember_token = Str::random(50);
        $user->forgot_token = Str::random(50);
        $user->password = Hash::make($request->password);
        $user->status = 0;
        $user->save();
        return redirect('/')->with('success', 'Password has been save.');
    }
    public function vendor_edit($id, Request $request)
    {
        $data['getrecord'] = User::get_single($id);
        $data['getVendorType'] = VendorType::get_record($request);
        $data['getCategory'] = Category::get_record($request);
        return view('admin.vendor.edit', $data);
    }

    public function vendor_update($id, Request $request)
    {
        $insert_r = request()->validate([
           'name' => 'required',
           'email' => 'required|unique:users,email,' . $id,
           'status' => 'required',
           'category_id' => 'required',
           'vendor_type_id' => 'required',
        ]);
        $insert_r = User::get_single($id);
        $insert_r->name = trim($request->name);
        $insert_r->last_name = trim($request->last_name);
        $insert_r->email = trim($request->email);
        $insert_r->mobile = trim($request->mobile);
        if (!empty($request->file('profile'))) {
            if (!empty($insert_r->profile) && file_exists('uploads/profile/' . $insert_r->profile)) {
                unlink('uploads/profile/' . $insert_r->profile);
            }
            $file = $request->file('profile');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile/', $filename);
            $insert_r->profile = $filename;
        }
        $insert_r->category_id = trim($request->category_id);
        $insert_r->vendor_type_id = trim($request->vendor_type_id);
        if ($request->vendor_type_id == 2) {
            $insert_r->company_name = null;
            $insert_r->employee_id = null;
        } else if ($request->vendor_type_id == 1) {
            $insert_r->company_name = trim($request->company_name);
            $insert_r->employee_id = null;
        }
        if ($request->vendor_type_id == 2) {
            $insert_r->company_name = null;
            $insert_r->employee_id = null;
        } else if ($request->vendor_type_id == 3) {
            $insert_r->employee_id = trim($request->employee_id);
            $insert_r->company_name = null;
        }
        $insert_r->status = trim($request->status);
        $insert_r->always_assign = trim($request->always_assign);
        $insert_r->save();
        return redirect('admin/vendor/list')->with('success', 'Vendor updated successfully!');
    }

    public function vendor_delete($id, Request $request)
    {
        $user = User::get_single($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/vendor/list')->with('success', 'Vendor deleted successfully!');
    }
}
