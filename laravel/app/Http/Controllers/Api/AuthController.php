<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 2ea047728b55eabc1e1eb8c71ca2a72109afdb9c

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
<<<<<<< HEAD
        $credentials = request(['login_name','mobile','password']);

//        var_dump($credentials);die;

        DB::enableQueryLog();

        $token = auth('api')->attempt($credentials);

        dd(DB::getQueryLog());die;



//        if (! $token = auth('api')->attempt($credentials)) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
=======
        $credentials = $request->only('email', 'password');

        $token = $this->guard()->attempt($credentials);
        if ($token) {
            return $this->respondWithToken($token);
        }
>>>>>>> 2ea047728b55eabc1e1eb8c71ca2a72109afdb9c

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
