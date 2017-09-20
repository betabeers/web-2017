<?php

namespace App\Http\Controllers\Panel;

use Faker\Provider\DateTime;
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
        $userId = $request->get("id");

        $user = User::find($userId);

        foreach($request->user as $key=>$value){
            if($key == 'pass' && ($value != $user->pass)) {
                $user->$key = md5($value);
                break;
            } elseif($key=='pass') {
                break;
            }
            if($value != null)$user->$key = $value;
        }

        if($user->ip == null) $user->ip = '127.0.0.1';
        if($user->date_login == null) $user->date_login = date('Y-m-d H:i:s');

        $user->date_update = date('Y-m-d H:i:s');

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

    public function search(Request $request)
    {
        $keyword = str_replace('%20', ' ', $request->keyword);
        $searchWord = '%' . $keyword . '%';
        $users = User::where('name', 'LIKE', $searchWord)
            ->orWhere('email', 'LIKE', $searchWord)
            ->orWhere('slug', 'LIKE', $searchWord)
            ->distinct()->get(['id', 'name', 'email']);

        foreach ($users as $user) {
            $user['url'] = route('panel_user_single_show', $user->id);
        }

        return $users;

    }
}
