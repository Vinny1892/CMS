<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store','login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only(['email','password']))) {
            $token = Auth::user()->createToken('seila')->plainTextToken;
            return response()->json(
                [
                "email" => auth()->user()->email,
                "token" => $token
                ],200
            );
        }

        return response()->json(["message" => "credentials are invalid"],401);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $userRepository)
    {
        return response([$userRepository->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request , UserRepository $userRepository)
    {
        // validar
        $user = $userRepository->store(
            [ "email" => $request->email , "password" => $request->password , "name" => $request->name]
        );
        return response()->json(["email" => $user->email , "name" => "$user->name"],201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(UserRepository $userRepository, Request $request)
    {
        $user = $userRepository->findById($request->id);
        return response()->json($user);
    }
    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return  response()->json(["message" => "token deletado com sucesso"]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UserRepository $userRepository  )
    {
       $user =  $userRepository->update($request->user , [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);
        $jsonResponse =["email" =>$user->email , "name" => $user->name ];
       return response()->json($jsonResponse);
    }


}
