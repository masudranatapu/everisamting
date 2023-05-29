<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomerPlanResource;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{



    public $authApiGuard;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'socialLogin']]);
        $this->authApiGuard = auth()->guard('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|string',
            'username' => 'sometimes|string',
        ]);

        try {
            $login_type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $credentials = [$login_type => $request->username, 'password' => $request->password];

            if (!$token = $this->authApiGuard->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Crendentials',
                ], Response::HTTP_UNAUTHORIZED);
            }

            $token = JWTAuth::fromUser(auth()->guard('api')->user());



            return $this->createNewToken($token);
        } catch (JWTException $e) {
            return response()->json(["failed", "An error occured, please contact support."], 500);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $setting = setting();

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'username' => 'required|string|between:2,100|unique:users,username',
            'email' => "required|string|max:100|email|unique:users,email",
            'password' => "required|min:8|max:50",
        ]);

        if ($validate->fails()) {
            Log::alert([$validate->failed()]);

            return sendError("Validation Error", $validate->errors());
        }


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        if ($setting->customer_email_verification) {
            $user->sendEmailVerificationNotification();
            $message = "A varification email send to your email address";
        } else {

            $message = "User registered";
        }

        $data = [
            'expires_in' => $token,
            'user' => $user
        ];

        return sendResponse(200, $message, $data, true, "");

        return response()->json([], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->authApiGuard->logout();

        $message = "User logged out";
        return  sendResponse(200, $message, null, true, "");
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken($this->authApiGuard->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {


                $message = "User Not Found";
                sendError($message, $message);
                // return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {

            // return response()->json(['token_expired'], $e->getMessage());
            $message = "Token Expired";
            sendError($message, $e->getMessage());
        } catch (TokenInvalidException $e) {

            // return response()->json(['token_invalid'], $e->getMessage());

            $message = "Token Invalid";
            sendError($message, $e->getMessage());
        } catch (JWTException $e) {
            $message = "Token Absent";
            sendError($message, $e->getMessage());
            // return response()->json(['token_absent'], $e->getMessage());
        }
        $message = "User Found";
        return sendResponse(200, $message, $user);
        // return response()->json(compact('user'));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {

        $data = [
            'access_token' => $token,
            'user' => $this->authApiGuard->user(),
            'token_type' => 'bearer',
            // 'expires_in' => $this->authApiGuard->factory()->getTTL() * 60 * 24 * 30
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'plan' => new CustomerPlanResource(auth()->guard('api')->user()->userPlan)

        ];

        $message = "User Found";
        return sendResponse(200, $message, $data);
        // return response()->json([
        //     'access_token' => $token,
        //     'user' => $this->authApiGuard->user(),
        //     'token_type' => 'bearer',
        //     'expires_in' => $this->authApiGuard->factory()->getTTL() * 60 * 24 * 30
        //     'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        // ]);
    }

    public function socialLogin(Request $request)
    {



        $userName = "";
        if ($request->email) {
            $trimedUserName = explode('@', $request->email);
            $userName = array_shift($trimedUserName);
            $result = User::where('username', $userName)->first();

            if (isset($result)) {
                $userName = Str::slug($userName . random_int(999, 9999));
            }
        } else {
            $userName = $request->id;
        }

        $provider = $request->input('provider');
        $token = $request->input('access_token');

        // get the provider's user. (In the provider server)
        $providerUser = Socialite::driver($provider)->userFromToken($token);




        // check if access token exists etc.
        $user = User::where('provider', $provider)->where('provider_id', $providerUser->id)->first();
        // if there is no record with these data, create a new user
        if ($user == null) {
            $validate = Validator::make($request->all(), [
                'email' => "nullable|unique:users,email",
            ]);

            if ($validate->fails()) {
                Log::alert([$validate->failed()]);

                return sendError("Validation Error", 'The email has already been taken. please use another sign in method.');
            }
            $user = User::create([
                'name' => $request->name,
                'username' => $userName,
                'email' => $request->email ?? $request->id,
                'password' => bcrypt($userName),
                'email_verified_at' => now(),
                'provider' => $provider,
                'provider_id' => $request->id,
            ]);
        }
        // create a token for the user, so they can log in
        Auth::guard('api')->login($user);

        $token = JWTAuth::fromUser($user);



        $data = [
            'access_token' => $token,
            'user' => Auth::guard('api')->user(),
            'token_type' => 'bearer',
            // 'expires_in' => $this->authApiGuard->factory()->getTTL() * 60 * 24 * 30
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'plan' => new CustomerPlanResource(auth()->guard('api')->user()->userPlan)

        ];

        Log::alert($data);

        $message = "User Found";
        return sendResponse(200, $message, $data);
    }

    public function resend()
    {
        $user = User::find(Auth::guard('api')->id());
        $user->sendEmailVerificationNotification();
        $message = "A varification email send to your email address";
        return sendResponse(200, $message, []);
    }
}
