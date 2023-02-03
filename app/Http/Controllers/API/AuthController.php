<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Author;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'

        ]);



        if (!$validator->fails()) {

            if ($request->get('guard') == 'author-api') {
                $author = Author::where('email', $request->get('email'))->first();

                if (Hash::check($request->get('password'), $author->password)) {
                    $token =  $author->createToken('author-api');
                    $author->setAttribute('token', $token->accessToken);
                    return response()->json(['status' => 'success', 'title' => 'Login Successfully', 'requestStatus' => 200, 'token' => $token]);
                } else {
                    return response()->json(['status' => 'fail', 'title' => 'Password is wrong', 'requestStatus' => 400]);
                }
            } elseif ($request->get('guard') == 'admin-api') {


                $admin = Admin::where('email', $request->get('email'))->first();;



                if (Hash::check($request->get('password'), $admin->password)) {
                    $token =  $admin->createToken('admin-api');
                    $admin->setAttribute('token', $token->accessToken);
                    return response()->json(['status' => 'success', 'title' => 'Login Successfully', 'requestStatus' => 200, 'token' => $token]);
                } else {
                    return response()->json(['status' => 'fail', 'title' => 'Password is wrong', 'requestStatus' => 400]);
                }
            } else {
                return response()->json(['status'  => 'error', 'title' => 'Login Failed ', 400]);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }


    public function logout(Request $request)
    {
        $guard = auth('admin-api')->check() ? 'admin-api' : 'author-api';

        if ($guard == 'author-api') {
            $token = $request->user('author-api')->token();
            $revoked = $token->revoke();
            return response()->json(['status' => 'success', 'title' => 'logout Successfully', 'requestStatus' => 200]);
        } elseif ($guard == 'admin-api') {
            $token = $request->user('admin-api')->token();
            $revoked = $token->revoke();
            return response()->json(['status' => 'success', 'title' => 'logout Successfully', 'requestStatus' => 200]);
        }
    }

    public function ResetPassword(Request $request)
    {

        if ($request->get('guard') == 'author-api') {
            $validator = validator(
                $request->all(),
                [
                    'email' => 'required|email|exists:authors,email',
                ]
            );
            if (!$validator->fails()) {
                $author = Author::where('email', $request->get('email'))->first();
                $auth_code = random_int(1000, 9999);
                $author->auth_code = Hash::make($auth_code);
                $isSaved = $author->save();
                return response()->json(['status' => 'success', 'title' => 'Code Created Successfully', 'code' => $auth_code, 'requestStatus' => 200]);
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        } elseif ($request->get('guard') == 'admin-api') {
            $validator = validator(
                $request->all(),
                [
                    'email' => 'required|email|exists:admins,email',
                ]
            );

            if (!$validator->fails()) {
                $admin = Admin::where('email', $request->get('email'))->first();;
                $auth_code = random_int(1000, 9999);
                $admin->auth_code = Hash::make($auth_code);
                $isSaved = $admin->save();

                return response()->json(['status' => 'success', 'title' => 'Code Created Successfully ', 'code' => $auth_code, 'requestStatus' => 200]);
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        }
    }



    public function UpdatePassword(Request $request)
    {

        if ($request->get('guard') == 'author-api') {
            $validator = validator(
                $request->all(),
                [
                    'email' => 'required|email|exists:authors,email',
                    'auth_code' => 'required',
                    'password' => 'required|string|min:3|confirmed'
                ]
            );
            if (!$validator->fails()) {
                $author = Author::where('email', $request->get('email'))->first();

                if (Hash::check($request->get('auth_code'), $author->auth_code)) {
                    $author->password = Hash::make($request->get('password'));
                    $author->auth_code = null;
                    $author->save();
                    return response()->json(['status' => 'success', 'title' => 'Password Changed Successfully', 'requestStatus' => 200]);
                } else {
                    return response()->json(['status' => 'fail', 'title' => 'auth_code is Wrong', 'requestStatus' => 400]);
                }
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        } elseif ($request->get('guard') == 'admin-api') {
            $validator = validator(
                $request->all(),
                [
                    'email' => 'required|email|exists:admins,email',
                    'auth_code' => 'required',
                    'password' => 'required|string|min:3|confirmed'
                ]
            );

            if (!$validator->fails()) {
                $admin = Admin::where('email', $request->get('email'))->first();;
                if (Hash::check($request->get('auth_code'), $admin->auth_code)) {
                    $admin->password = Hash::make($request->get('password'));
                    $admin->auth_code = null;
                    $admin->save();
                    return response()->json(['status' => 'success', 'title' => 'Password Changed Successfully', 'requestStatus' => 200]);
                } else {
                    return response()->json(['status' => 'fail', 'title' => 'auth_code is Wrong', 'requestStatus' => 400]);
                }
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        }
    }
}