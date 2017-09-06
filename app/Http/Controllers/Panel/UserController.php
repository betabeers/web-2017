<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        //return $user;

        return view('panel/user/show/single')->with(['user'=>$user]);
    }

    public function showAll(Request $request)
    {
        $usersPerPage = 20;
        if($request->per_page) $usersPerPage = $request->per_page;

        $users = User::paginate($usersPerPage);

        return view('panel/user/show')->with(['users'=>$users]);
    }

    public function edit(Request $request)
    {
        $userId = $request->user["id"];

        $user = User::find($userId);

        foreach($request->user as $key=>$value){
            $user->setAttribute($key, $value);
        }

        $user->save();

        return redirect()->route('panel_user_single_show', $userId);
    }

    public function delete(Request $request)
    {
        $userId = $request->id;
        $user = User::find($userId);
        $user->setAttribute('visible', 0);
        $user->save();
        return redirect()->route('panel_user_show');
    }

    public function restore(Request $request)
    {
        $userId = $request->id;
        $user = User::find($userId);
        $user->setAttribute('visible', 1);
        $user->save();
        return redirect()->route('panel_user_show');
    }
}
