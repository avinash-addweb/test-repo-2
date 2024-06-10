<?php

namespace Modules\Testimonial\Repositories;

use Modules\Testimonial\Repositories\Interfaces\TestimonialRepositoryInterface;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Testimonial\Entities\TestimonialLocale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     *  @method used to get the list of model data with or without pagination and can also pass the searching and sorting params
     * 
     *  @param array $filters
     *  @param bool  $pagination
     * 
     *  @return mixed $models
     * 
     */
    public function getData(array $filters, bool $pagination = true) :Collection|LengthAwarePaginator {

        $models = (new Testimonial)->newQuery();
        $models->with(['testimonialLocales','testimonialImage']);
        if (!empty($filters['searchParams']['name'])) {
            $models->whereHas('testimonialLocales',function($model)use($filters){
                return $model->where('name', 'like', '%' . $filters['searchParams']['name'] . '%');
            });
        }
        if (!empty($filters['searchParams']['email'])) {
            $models->whereHas('testimonialLocales',function($model)use($filters){
                return $model->where('email', 'like', '%' . $filters['searchParams']['email'] . '%');
            });
        }
        if (!empty($filters['searchParams']['designation'])) {
            $models->whereHas('testimonialLocales',function($model)use($filters){
                return $model->where('designation', 'like', '%' . $filters['searchParams']['designation'] . '%');
            });
        }
        if (!empty($filters['searchParams']['lang_code'])) {
            $models->whereHas('testimonialLocales',function($model)use($filters){
                return $model->where('lang_code', $filters['searchParams']['lang_code']);
            });
            $models->with('testimonialLocales',function($model)use($filters){
                return $model->where('lang_code', $filters['searchParams']['lang_code']);
            });
        }
        if (!empty($filters['searchParams']['status'])) {
            $models->where('status', 1);
        }
        if (!empty($filters['searchParams']['id'])) {
            $models->where('id', $filters['searchParams']['id']);
        }
        if (!empty($filters['sortParams']['sortColumn']) && !empty($filters['sortParams']['sortDir'])) {
            $models->orderBy($filters['sortParams']['sortColumn'],$filters['sortParams']['sortDir']);
        } else {
            $models->latest();
        }
        if (!$pagination) {
            $models = $models->get();
        } else {
            $recordlimit = $filters['paginationParams']['recordLimit'] ?? config('testimonial.pagination_limit');
            $models = $models->paginate($recordlimit);
        }
        
        return $models;
    }

    /**
     *  @method used to get all of model data 
     * 
     *  @return mixed $models
     * 
     */
    public function getAllData() :Collection {
        return Testimonial::all();
    }

    /**
     *  @method used to get the model data by id
     * 
     *  @param int $id
     * 
     *  @return object $model
     * 
     */
    public function viewTestimonial(int $id) :Testimonial {
        return Testimonial::with('testimonialImage')->findOrFail($id);
    }

    /**
     *  @method used to store the model data
     * 
     *  @param array $data
     * 
     *  @return object $model
     * 
     */
    public function storeTestimonial(array $data) :Testimonial|bool {
        try {
            DB::beginTransaction();
            $model = Testimonial::create(['email' => $data['email'],'status' => $data['status']]);
            $modelLocale = new TestimonialLocale;
            $modelLocale->lang_code = $data['lang_code'];
            $modelLocale->name = $data['name'];
            $modelLocale->designation = $data['designation'];
            $modelLocale->contents = $data['contents'];
            $model->testimonialLocales()->save($modelLocale);
            \DB::commit();
            return $model;
        } catch(\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    /**
     *  @method used to update the model data
     * 
     *  @param array $data
     *  @param int   $id
     * 
     *  @return object $modelqUpdate
     * 
     */
    public function updateTestimonial(array $data, int $id) :Testimonial|bool {
        try {
            DB::beginTransaction();
            $modelUpdate = Testimonial::findOrFail($id);
            $modelData = ['email' => $data['email'],'status' => $data['status']];
            $modelUpdate->update($modelData);
            if (!$modelLocale = $modelUpdate->testimonialLocale($data['lang_code'])->first()) {
                $modelLocale = new TestimonialLocale;
                $modelLocaleData['testimonial_id'] = $id;
                $modelLocaleData['lang_code'] = $data['lang_code'];
                $modelLocaleData['name'] = $data['name'];
                $modelLocaleData['designation'] = $data['designation'];
                $modelLocaleData['contents'] = $data['contents'];
                $modelLocale->create($modelLocaleData);
                \DB::commit();
                return $modelUpdate;
            }
            $modelLocaleData['name'] = $data['name'];
            $modelLocaleData['designation'] = $data['designation'];
            $modelLocaleData['contents'] = $data['contents'];
            $modelLocale->update($modelLocaleData);
            \DB::commit();
            return $modelUpdate;
        } catch(\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    /**
     *  @method used to delete the model data
     * 
     *  @param int   $id
     * 
     *  @return bool
     * 
     */
    public function deleteTestimonial(int $id) :bool {
        try {
            DB::beginTransaction();
            $model = Testimonial::findOrFail($id);
            $model->testimonialLocales()->delete();
            $model->testimonialImage()->delete();
            $modelDelete = $model->delete();
            \DB::commit();
            return $modelDelete;
        } catch(\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    /**
     *  @method used to delete the model media
     * 
     *  @param int      $model_id
     *  @param string   $model_name
     *  @param string   $media_attribute
     * 
     *  @return bool
     * 
     */
    public function deleteModelMediaAttribute(int $model_id, string $model_name, string $media_for_attribute) :bool {
        try {
            DB::beginTransaction();
            //$model = Testimonial::findOrFail($model_id);
            $modelMediaDelete = \App\Models\MediaUpload::where('model_id',$model_id)->where('model_name',$model_name)->where('media_for_attribute',$media_for_attribute)->delete();
            \DB::commit();
            return $modelMediaDelete;
        } catch(\Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}