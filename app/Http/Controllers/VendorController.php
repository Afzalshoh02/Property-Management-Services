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
}
