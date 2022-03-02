<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCtl extends Controller
{

    public function index()
    {
        $rs = User::all();
        return response()->json($rs);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate( $request, [
            'username' => 'required|email',
            'password' => 'bail|required|min:5',
        ]);

        try {
            if(Auth::attempt(['email' => $request->username, 'password' => $request->password])){
                return response()->json(
                    ['loggin'=> Auth::check(),
                    'user'=> Auth::user()
                    ],200);
            }
            return response()->json(['loggin'=>Auth::check()],401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    public function logout()
    {
        try {
            if(Auth::logout()){
                return response()->json(
                    ['loggin'=> Auth::check(),
                    'user'=> Auth::user()
                    ]);
            }
            return response()->json(['loggin'=>Auth::check(),'user'=> Auth::user()]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }

    public function checkUserSession(){
        return response()->json(['loggin' => Auth::check(),'user' => Auth::user()]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        try {
            $rs = User::find(Auth::user()->id);
            return response()->json(['user' => $rs]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
