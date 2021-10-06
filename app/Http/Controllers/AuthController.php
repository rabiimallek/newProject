<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth ;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['newUser' , 'login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        /*$credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);*/


        $credentials = $request->only(['email' ,'password']);
       /* $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;*/


        $token = Auth::guard('api')->attempt($credentials);
        if (!$token)
            return 'email or password not right';


        $user = Auth::guard('api')->user();
        $user->api_token = $token;


        return $user;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user()->name);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function newUser(Request $request)
    {
        $rules = [

            "email" => "required | unique:users"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $user = new User();

        $user->email = $request->email;
        $user->name = '$request->email';
        $user->typeUser = 'admin';

        $user->password = Hash::make($request->password);
        $user->save();

        ////////////////////////////////
        // $u = User::where('telephone', $request->Telephone)->first();
        //return $this->returnData("user" , $u);


        $credentials = $request->only(['email']);
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;


        $token = Auth::guard('api')->attempt($credentials);
        if (!$token)
            return $this->returnError('E001', 'email or password not right');


        $user = Auth::guard('api')->user();
        $user->api_token = $token;


        return $user;

    }
}
