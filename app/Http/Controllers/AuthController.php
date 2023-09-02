<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(MemberRegisterRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);

        $member = Member::create($validatedData);
        $token = $member->createToken('MemberAccessToken')->accessToken;

        return response()->json(['token' => $token,'member' => $member], 201);
    }

    public function login(MemberLoginRequest $request): JsonResponse
    {

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->validated('email'), 'password' => $request->validated('password')],$request->validated('remember_token'))) {
            $member = Auth::user();
            $token = $member->createToken('MemberAccessToken')->accessToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }
    }
}
