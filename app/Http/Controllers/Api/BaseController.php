<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Library Collection - API Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="support@example.com"
     *      ),
     *      @OA\License(
     *              name="Apache 2.0",
     *              url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *          )
     *      ),
     *      @OA\SecurityScheme(
     *          securityScheme="sanctum",
     *          type="http",
     *          scheme="bearer"
     *      ),
     *      @OA\Server(
     *          url=L5_SWAGGER_CONST_HOST,
     *          description="Library Collection API Server"
     *      )
     * 
     */
class BaseController extends Controller
{

}
