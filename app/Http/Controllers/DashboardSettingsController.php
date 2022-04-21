<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        return view('dashboard.settings', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();

        $this->validate($request, [
            'password' => $request->has('password') ? ['required', 'string', 'min:8', 'confirmed'] : [],
            'name' => $request->has('name') ? ['required', 'string', 'max:255'] : [],
            'email' => $request->has('email') ? ['required', 'string', 'email', 'max:255', $request->email != $user->email ? 'unique:users' : ''] : [],
        ]);

        $updatedData = [];
        if ($request->has('email') && $request->email !== $user->email) {
            $input['email_verified_at'] = null;
            array_push($updatedData, 'Email');
        }
        if ($request->has('name') && $request->name != $user->name) {
            array_push($updatedData, 'Name');
        }

        $update = $user->update($input);

        if ($update) {
            if (isset($input['password'])) {
                return back()->with('success', 'Your password updated successfully');
            } else {
                // if email changed, resend verification email to new email addstess
                if ($request->has('email')) {
                    $user_ = Auth::user();
                    if (!$user->email_verified_at) {
                        $user_->sendEmailVerificationNotification();
                    }
                }

                $allert = '';
                if (in_array('Email', $updatedData)) {
                    $allert = '<br><span class="fw-bold">Before proceeding, please check your email for a verification link</span>';
                }
                if (count($updatedData) > 0) {
                    return back()->with('success', implode(" & ", $updatedData) . ' updated successfully.' . $allert );
                } else {
                    return back();
                }
            }
        } else {
            return back()->with('error', 'Unable to proceed your request... Please try again later.');
        }
    }
}
