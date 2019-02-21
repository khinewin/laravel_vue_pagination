<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser(){
        $users=User::OrderBy('id', 'desc')->paginate("5");
        return response()->json(['users'=>$users]);
    }
    public function getRemoveUser($id){
        $user=User::whereId($id)->firstOrFail();
        $user->delete();
        return response()->json(["message"=>"The user account have been removed."]);
    }
    public function postUpdateUser(Request $request){
        $id=$request['id'];
        $name=$request['name'];
        $email=$request['email'];
        $user=User::whereId($id)->firstOrFail();
        $user->name=$name;
        $user->email=$email;
            $user->update();
        return response()->json(['user'=>$user, "message"=>"The user account have been updated."]);

    }
}
