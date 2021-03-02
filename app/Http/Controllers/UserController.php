<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect('users.index')
            ->with('success', 'User was successfully deleted');
    }

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_admin = $request->is_admin;
        $user->save();
  
        return response()->json(['success'=>'User role change successfully.']);
    }
}
