<?php


namespace Modules\Testimonial\Http\Controllers\Api\v1;

use Modules\Testimonial\Repositories\Interfaces\TestimonialRepositoryInterface;
use Modules\Testimonial\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Modules\Testimonial\Http\Resources\Api\v1\TestimonialResource;
use Modules\Testimonial\Http\Requests\Api\v1\Testimonial\TestimonialViewRequest;

use Illuminate\Http\Resources\Json\Resource;

class TestimonialController extends BaseController
{
    private TestimonialRepositoryInterface $testimonialRepository;
    function __construct(TestimonialRepositoryInterface $testimonialRepository)
    {
         $this->testimonialRepository = $testimonialRepository;
    }

    /**
    * @OA\Get(
    * path="/testimonial-list",
    * operationId="getTestimonialList",
    * tags={"Testimonial"},
    * summary="Get list of testimonials",
    * description="Returns list of testimonials.",
    *      @OA\RequestBody(),
    *       @OA\Parameter(
    *           parameter="lang_code",
    *           name="lang_code",
    *           description="The lang_code of locale testimonial",
    *           @OA\Schema(
    *               type="string"
    *           ),
    *           in="query",
    *           required=false
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Testimonial fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=201,
    *          description="Testimonial not available.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function testimonialList(Request $request)
    {   
        $filters['searchParams']['lang_code']= $request->lang_code ?? getDefaultLocale();
        $filters['searchParams']['status']=1;
        $testimonials = $this->testimonialRepository->getData($filters);
        $testimonialList = TestimonialResource::collection($testimonials);
        if (!empty($testimonialList[0])) {
            return ResponseHelper::getResponse('200', __(':record fetched successfully.',['record'=>__('Testimonial')]), $testimonialList);
        } else {
            return ResponseHelper::getResponse('404', __(':record not available.',['record'=>__('Testimonial')]), $testimonialList);
        }
    }
    
    /**
    * @OA\Get(
    * path="/testimonial-detail/{Id}",
    * operationId="getTestimonial",
    * tags={"Testimonial"},
    * summary="Get specific testimonial by id",
    * description="Returns specific testimonial by id",
    *       @OA\Parameter(
    *           description="ID of testimonial",
    *           in="path",
    *           name="Id",
    *           required=true,
    *           example="1",
    *           @OA\Schema(
    *               type="integer",
    *               format="int64"
    *           )
    *       ),
    *       @OA\Parameter(
    *           parameter="lang_code",
    *           name="lang_code",
    *           description="The lang_code of locale testimonial",
    *           @OA\Schema(
    *               type="string"
    *           ),
    *           in="query",
    *           required=false
    *       ),
    *      @OA\Response(
    *          response=200,
    *          description="Testimonial details fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function testimonialView(TestimonialViewRequest $request, int $id)
    {
        $filters['searchParams']['lang_code']= $request->lang_code ?? getDefaultLocale();
        $filters['searchParams']['id']=$id;
        $filters['searchParams']['status']=1;
        $testimonialData = $this->testimonialRepository->getData($filters,false);
        $testimonial = TestimonialResource::collection($testimonialData);
        if(!empty($testimonial[0]->id)) {
            return ResponseHelper::getResponse('200', __(':record details fetched successfully.',['record'=>__('Testimonial')]), $testimonial);
        } else {
            return ResponseHelper::getResponse('404', __(':record details not available.',['record'=>__('Testimonial')]), $testimonial);
        }
        
    }
}
