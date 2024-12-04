<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function adminLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
        throw ValidationException::withMessages([
            'email' => __('The provided credentials are incorrect.'),
        ]);
    }

    return redirect()->route('home');
}


    public function edit($id)
    {
        $admin=Admin::find($id);
        return view('admin.edit',compact('admin'));
    }

  
    public function update(Request $request,$id)
    {
        $admin = Admin::find($id);

        if (Hash::check($request->current_password, $admin->password)) {
            $admin->name = $request->name;
            $admin->email = $request->email;
        
            // Hash the new password before saving it to the database
            if ($request->new_password) {
                $admin->password = Hash::make($request->new_password);
            }
        
            $admin->save();
        
            return redirect()->back()->with(['success' => 'Profile updated successfully']);
        } else {
            return redirect()->back()->with(['failed' => 'Current password is wrong!']);
        }
        
    }

  
    public function adminLogout(Request $request)
    {
        
        Auth::guard('admin')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to admin login page
        return redirect()->route('home')->with('status', 'You have been logged out successfully.');
    }

    public function index()
    {
        $accounts=User::paginate(15);
        return view('admin.users',compact('accounts'));
    }
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('admin.users')->with(['message'=>'account deleted, but still in trash']);

    }

    public function deletedAccounts()
    {
        $accounts=User::onlyTrashed()->paginate(15);
        return view('admin.trash',compact('accounts'));
    }

    public function restoreAccounts($id)
    {
        $accounts=User::onlyTrashed()->find($id);
        $accounts->restore();
        return redirect()->route('admin.users')->with(['message'=>'account restored successfully']);
    }

    public function forceDelete($id)
    {
        $accounts=User::onlyTrashed()->find($id);
        $accounts->forceDelete();
        return redirect()->route('trash')->with(['message'=>'account deleted generally']);
    }


}
