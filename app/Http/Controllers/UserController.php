<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Validator;

class UserController extends Controller
{
    public function index() {
        return response()->json([
            'message'=>'Users',
            'code'=>'200',
            'error'=>false,
            'results'=> User::orderBy('name', 'asc')->get()
        ], 200);
    }

    public function show($id) {
        $user = User::find($id);

        if(!$user) return response()->json(['message'=>'no user found'], 404);

        return response()->json([
            'message'=>'user detail',
            'code'=>'200',
            'error'=>false,
            'results'=>$user
        ], 200);
    }

    public function store(Request $request) {

        $validation = Validator::make($request->all(), [
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|max:50'
        ]);

        if ($validation->fails()) {
            return $validation->errors();
        }

        DB::beginTransaction();
        try {
            $newUser = new User;
            $newUser->name = $request->name;
            $newUser->email = preg_replace('/\s+/', '', strtolower($request->email));
            $newUser->password = \Hash::make($request->passsword);
            $newUser->save();

            DB::commit();
            return response()->json([
                'message'=>'User Created',
                'code'=>200,
                'error'=>false,
                'results'=>$newUser
            ], 201);
        } catch(\Exception $e) {
            DB:: rollback();
            return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true,
                'code'=>500
            ], 500);
        }
    }

    public function update(Request $request, $id) {

        $validation = Validator::make($request->all(), [
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users,email,' . $id
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);

            if(!$user) return response()->json(['message'=>'no user found'], 404);

        $user->name = $request->name;
        $user->email = preg_replace('/\s+/', '', strtolower($request->email));
        $user->save();

        DB::commit();
        return response()->json([
            'message'=>'user updated',
            'code'=>200,
            'error'=>false,
            'results'=>$user
        ], 200);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true,
                'code'=>500
            ], 500);
        }
    }

    public function destory($id) {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            if(!$user) return response()->json(['message'=>'no user found'], 404);

            $user->delete();

            DB::commit();
            return response()->json([
                'message'=>'User deleted',
                'code'=>200,
                'error'=>false,
                'results'=>$user
            ], 200);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true,
                'code'=>500
            ], 500);
        }
    }
}
