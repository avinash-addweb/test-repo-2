<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\Interfaces\GeneralSettingRepositoryInterface;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Api\v1\RoleResource;
use App\Http\Resources\Api\v1\ModuleResource;
use App\Http\Resources\Api\v1\LanguageResource;
use App\Http\Resources\Api\v1\GeneralSettingResource;

class CommonController extends BaseController
{
    private RoleRepositoryInterface $roleRepository;
    private LanguageRepositoryInterface $languageRepository;
    private GeneralSettingRepositoryInterface $generalSettingRepository;
    
    function __construct(RoleRepositoryInterface $roleRepository, LanguageRepositoryInterface $languageRepository, GeneralSettingRepositoryInterface $generalSettingRepository)
    {
         $this->roleRepository = $roleRepository;
         $this->languageRepository = $languageRepository;
         $this->generalSettingRepository = $generalSettingRepository;
    }

    /**
    * @OA\Get(
    * path="/role-list",
    * operationId="getRoleList",
    * tags={"RoleList"},
    * summary="Get list of roles",
    * description="Returns list of roles.",
    *      @OA\RequestBody(),
    *      @OA\Response(
    *          response=200,
    *          description="Role fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function roleList(Request $request)
    {
        $filters['searchParams']['is_for_client']=1;
        $roles = $this->roleRepository->getData($filters,$pagination=false);
        $roleList = RoleResource::collection($roles);
        return ResponseHelper::getResponse('200', __('messages.:record fetched successfully.',['record'=>__('Role')]), $roleList);
    }

    /**
    * @OA\Get(
    * path="/module-list",
    * operationId="getModuleList",
    * tags={"ModuleList"},
    * summary="Get list of modules",
    * description="Returns list of modules.",
    *      @OA\RequestBody(),
    *      @OA\Response(
    *          response=200,
    *          description="Module fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function moduleList(Request $request)
    {
        $modules = getModuleList(true);
        $moduleList = ModuleResource::collection($modules);
        return ResponseHelper::getResponse('200', __('messages.:record fetched successfully.',['record'=>__('Module')]), $moduleList);
    }

    /**
    * @OA\Get(
    * path="/language-list",
    * operationId="getLanguageList",
    * tags={"LanguageList"},
    * summary="Get list of languages",
    * description="Returns list of languages.",
    *      @OA\RequestBody(),
    *      @OA\Response(
    *          response=200,
    *          description="Language fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function languageList(Request $request)
    {
        $filters['searchParams']['status']=1;
        $languages = $this->languageRepository->getData($filters,$pagination=false);
        $languageList = LanguageResource::collection($languages);
        return ResponseHelper::getResponse('200', __('messages.:record fetched successfully.',['record'=>__('Language')]), $languageList);
    }

    /**
    * @OA\Get(
    * path="/setting-list",
    * operationId="getSettingList",
    * tags={"SettingList"},
    * summary="Get list of settings",
    * description="Returns list of settings.",
    *      @OA\RequestBody(),
    *      @OA\Response(
    *          response=200,
    *          description="Setting fetched successfully.",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function settingList(Request $request)
    {
        $moduleList = getModuleList(false,true);
        $moduleKeyList = (!empty($moduleList)) ? \array_keys($moduleList) : [];
        $filters['searchParams']['display_status'] = 1;
        $generalSettings = $this->generalSettingRepository->getAllGeneralSetting($filters,true,$moduleKeyList);
        $allSettingList = $allSettingList['modules'] = [];
        $allSettingList['general'] = GeneralSettingResource::collection($generalSettings['general']);
        if(!empty($generalSettings['modules'])) {
            foreach($generalSettings['modules'] as $moduleName => $moduleSetting) {
                if(!empty($moduleSetting)) {
                    $allSettingList['modules'][$moduleName] = GeneralSettingResource::collection($moduleSetting);
                } else {
                    $allSettingList['modules'][$moduleName] = [];
                }
            }
        }
        return ResponseHelper::getResponse('200', __('messages.:record fetched successfully.',['record'=>__('Setting')]), $allSettingList);
    }

}
