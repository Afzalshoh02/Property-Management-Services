<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisterMail;
use App\Models\AMCModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function user_list(Request $request)
    {
        $data['getrecord'] = User::get_record_user($request);
        return view('admin.user.list', $data);
    }

    public function user_add()
    {
        $data['getAMC'] = Amcmodel::get_record_delete();
        return view('admin.user.add', $data);
    }
    public function user_store(Request $request)
    {
        $user = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'amc_id' => 'required',
            'mobile' => 'required',
        ]);
        $DataAmc = AMCModel::where('id', '=', $request->amc_id)->first();
        $UserDesc = User::orderBy('id', 'desc')->where('amc_id', '=', $request->amc_id)->first();
        $user = new User();
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->email = trim($request->email);
        $user->mobile = trim($request->mobile);
        $user->address = trim($request->address);
        $user->amc_business_category_name = trim($request->amc_business_category_name);
        if (!empty($request->file('profile'))) {
            $file = $request->file('profile');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile/', $filename);
            $user->profile = $filename;

        }
        if (!empty($UserDesc)) {
            $user->account_number = $UserDesc->account_number + 1;
        } else {
            $user->account_number = trim($DataAmc->series);
        }
        $user->amc_id = trim($request->amc_id);
        $user->is_admin = 0;
        $user->remember_token = Str::random(50);
        $user->forgot_token = Str::random(50);
        $user->save();
//        $this->serd_user_verification_mail($user);
        return redirect('admin/user/list')->with('success', 'User added successfully.');
    }
    public function serd_user_verification_mail($user)
    {
        Mail::to($user->email)->send(new UserRegisterMail($user));
    }

    public function user_edit($id, Request $request)
    {
        $data['getrecord'] = User::get_single($id);
        $data['getAMC'] = Amcmodel::get_record_delete();
        return view('admin.user.edit', $data);
    }

    public function user_update($id, Request $request)
    {
        $insert_r = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
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
        $insert_r->address = trim($request->address);
        $insert_r->save();
        return redirect('admin/user/list')->with('success', 'User updated successfully.');
    }

    public function user_delete($id, Request $request)
    {
        $user = User::get_single($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/user/list')->with('success', 'User deleted successfully.');
    }
}
