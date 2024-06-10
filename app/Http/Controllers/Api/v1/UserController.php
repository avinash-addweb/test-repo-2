<?php

namespace App\Http\Controllers\Api\v1;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Api\v1\User\UserGetRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Http\Requests\Api\v1\User\PasswordChangeRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    private UserRepositoryInterface $userRepository;
    
    function __construct(UserRepositoryInterface $userRepository)
    {
         $this->userRepository = $userRepository;
    }

    /**
    * @OA\Get(
    * path="/user",
    * operationId="getUserDetail",
    * tags={"User"},
    * security={ {"sanctum": {} }},
    * summary="Get current user details",
    * description="Returns current user details.",
    *      @OA\RequestBody(),
    *       @OA\Parameter(
    *           parameter="lang_code",
    *           name="lang_code",
    *           description="The lang_code of desired locale",
    *           @OA\Schema(
    *               type="string"
    *           ),
    *           in="query",
    *           required=false
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Password changed successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Password changed successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function userDetail(UserGetRequest $request)
    {
        $userDetail = collect([$request->user()]);
        $user = UserResource::collection($userDetail);
        return ResponseHelper::getResponse('200', __('messages.:record details fetched successfully.',['record'=>__('User')]), $user);
    }

    /**
    * @OA\Post(
    * path="/logout",
    * operationId="UserLogout",
    * tags={"User"},
    * security={ {"sanctum": {} }},
    * summary="logout current user",
    * description="logout current user.",
    *      @OA\RequestBody(),
    *       @OA\Parameter(
    *           parameter="lang_code",
    *           name="lang_code",
    *           description="The lang_code of desired locale",
    *           @OA\Schema(
    *               type="string"
    *           ),
    *           in="query",
    *           required=false
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="User logout successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="User logout successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function userLogout(UserGetRequest $request)
    {
        $request->user()->tokens->each(fn($token) => $token->delete());
        return ResponseHelper::getResponse('200', __('messages.:record logout successfully.',['record'=>__('User')]), []);
    }

    /**
    * @OA\Post(
    * path="/change-password",
    * operationId="changePassword",
    * tags={"User"},
    * security={ {"sanctum": {} }},
    * summary="User password change.",
    * description="User password change.",
    *      @OA\RequestBody(),
    *       @OA\Parameter(
    *           parameter="lang_code",
    *           name="lang_code",
    *           description="The lang_code of desired locale",
    *           @OA\Schema(
    *               type="string"
    *           ),
    *           in="query",
    *           required=false
    *       ),
    *       @OA\Parameter(
    *           parameter="old_password",
    *           name="old_password",
    *           description="old password",
    *           @OA\Schema(
    *               type="string",
    *               format = "password"
    *           ),
    *           in="query",
    *           required=true
    *       ),
    *       @OA\Parameter(
    *           parameter="new_password",
    *           name="new_password",
    *           description="new password",
    *           @OA\Schema(
    *               type="string",
    *               format = "password"
    *           ),
    *           in="query",
    *           required=true
    *       ),
    *       @OA\Parameter(
    *           parameter="confirm_password",
    *           name="confirm_password",
    *           description="confirm password",
    *           @OA\Schema(
    *               type="string",
    *               format = "password"
    *           ),
    *           in="query",
    *           required=true
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Password changed successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Password changed successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function changePassword(PasswordChangeRequest $request)
    {
        $request->user()->fill([
            'password' => Hash::make($request->new_password)
            ])->save();
        return ResponseHelper::getResponse('200', __('messages.:record changed successfully.',['record'=>__('Password')]), []);
    }

    /**
     * @OA\Post(
     * path="/secret-details",
     * operationId="getSecretDetails",
     * tags={"User"},
     * security={ {"sanctum": {} }},
     * summary="Get general secret details",
     * description="Returns general secret details.",
     *      @OA\RequestBody(),
     *       @OA\Parameter(
     *           parameter="lang_code",
     *           name="lang_code",
     *           description="The lang_code of desired locale",
     *           @OA\Schema(
     *               type="string"
     *           ),
     *           in="query",
     *           required=false
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Details fetched successfully.",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Details fetched successfully.",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function commonSecretDetail(Request $request)
    {
        $secretDetails = [];
        $secretDetails['stripe']['key'] = config('services.stripe.key');
        $secretDetails['stripe']['secret'] = config('services.stripe.secret');
        $secretDetails['stripe']['currency'] = config('services.stripe.currency');
        $secretDetails['stripe']['currency_symbol'] = config('services.stripe.currency_symbol');
        return ResponseHelper::getResponse('200', __('messages.:record details fetched successfully.',['record'=>__('Secret')]), $secretDetails);
    }

}
