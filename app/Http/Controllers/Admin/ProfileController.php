<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\File as ModelsFile;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Dashboard\UserRequest;
use Exception;


class ProfileController extends Controller
{

    public function edit()
    {

        return view('admin.crud.users.editProfile');
    }


    public function update(UserRequest $request)
    {
        try {
            $input = $request->except('image','profile_avatar_remove');
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }
            $user = auth('admin')->user();
            $user->update($input);
            $user->updateFile();
            return redirect()->back()
                ->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}