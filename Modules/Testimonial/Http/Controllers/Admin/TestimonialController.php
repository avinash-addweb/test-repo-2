<?php

namespace Modules\Testimonial\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Modules\Testimonial\Http\Controllers\Admin\BaseController;
use Modules\Testimonial\Http\Requests\Admin\Testimonial\TestimonialStoreRequest;
use Modules\Testimonial\Http\Requests\Admin\Testimonial\TestimonialUpdateRequest;
use Modules\Testimonial\Http\Requests\Admin\Testimonial\TestimonialViewRequest;
use Modules\Testimonial\Repositories\Interfaces\TestimonialRepositoryInterface;
use Modules\Testimonial\DataTables\TestimonialDataTable;
use App\Http\Traits\FileUpload;

class TestimonialController extends BaseController
{
    use FileUpload;
    private TestimonialRepositoryInterface $testimonialRepository;
    function __construct(TestimonialRepositoryInterface $testimonialRepository)
    {
         $this->testimonialRepository = $testimonialRepository;
         $this->middleware('can:testimonial list', ['only' => ['index','show']]);
         $this->middleware('can:testimonial create', ['only' => ['create','store']]);
         $this->middleware('can:testimonial edit', ['only' => ['edit','update']]);
         $this->middleware('can:testimonial delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(TestimonialDataTable $dataTable)
    {
        return $dataTable->render('testimonial::testimonial.index');
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $localeList = getLocaleList();
        $defaultLocale = getDefaultLocale();
        return view('testimonial::testimonial.create',['localeList' => $localeList, 'defaultLocale' => $defaultLocale]);
    }

    /**
     * Store a newly created resource in storage.
     * @param TestimonialStoreRequest $request
     */
    public function store(TestimonialStoreRequest $request)
    {
        // $upload_file = $request->file('image');
        // $image_name = $this->uploadMedia($upload_file, config('testimonial.name'));
        // $image_rules = $request?->rules()['image']??[];
        // if((!$image_name) && !empty($image_rules) && str_contains($image_rules,'required')) {
        //     return back()->with('error', __('testimonial::messages.:record could not upload, please try again.',['record'=>__('Image')]))->withInput();;
        // }

        $data = [
            'lang_code' => $request->lang_code,
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation??"",
            'contents' => $request->contents,
            'status' => ($request->status)?1:0
        ];
        $storeTestimonial = $this->testimonialRepository->storeTestimonial($data);
        $saveMedia = $this->saveMediaItem(($request->image??""), $storeTestimonial->id, 'Modules\Testimonial\Entities\Testimonial', 'image','Testimonial');
        if(!$storeTestimonial) {
            return redirect()->route('testimonial::testimonial.index')->with('error', __('testimonial::messages.:record could not created.',['record'=>__('Record')]));
        } else {
            return redirect()->route('testimonial::testimonial.index')->with('success', __('testimonial::messages.:record created successfully.',['record'=>__('Record')]));
        }
    }

    /**
     * Show the specified resource.
     * @param TestimonialViewRequest $request
     * @param int $id
     * @return Renderable
     */
    public function show(TestimonialViewRequest $request, $id)
    {
        $localeList = getLocaleList();
        $testimonial = $this->testimonialRepository->viewTestimonial($id);
        return view('testimonial::testimonial.show',['testimonial'=>$testimonial, 'localeList' => $localeList]);
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param TestimonialViewRequest $request
     * @param int $id
     * @return Renderable
     */
    public function edit(TestimonialViewRequest $request, $id, $langCode = "")
    {
        $localeList = getLocaleList();
        $defaultLocale = getDefaultLocale();
        $langCode = !empty($langCode) ? $langCode : $defaultLocale;
        if(!empty($langCode) && !in_array($langCode,array_keys($localeList))) {
            return redirect()->route('testimonial::testimonial.edit',['testimonial' => $id]);
        }
        $testimonial = $this->testimonialRepository->viewTestimonial($id);
        return view('testimonial::testimonial.edit',['testimonial'=>$testimonial, 'langCode' => $langCode, 'localeList' => $localeList]);
    }

    /**
     * Update the specified resource in storage.
     * @param TestimonialUpdateRequest $request
     * @param int $id
     */
    public function update(TestimonialUpdateRequest $request, $id)
    {   
        // if($request->hasFile('image')) {
        //     $upload_file = $request->file('image');
        //     $image_name = $this->uploadMedia($upload_file, config('testimonial.name'));
        //     $image_rules = $request?->rules()['image']??[];
        //     if((!$image_name) && !empty($image_rules) && \str_contains($image_rules,'required')) {
        //         return back()->with('error', __('testimonial::messages.:record could not upload, please try again.',['record'=>__('Image')]))->withInput();;
        //     }
        // }

        $data = [
            'lang_code' => $request->lang_code,
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation??"",
            'contents' => $request->contents,
            'status' => ($request->status)?1:0
        ];
        $updateTestimonial = $this->testimonialRepository->updateTestimonial($data, $id);
        if (!empty($request->image)) {
            $deleteOldMedia = $this->testimonialRepository->deleteModelMediaAttribute($id, 'Modules\Testimonial\Entities\Testimonial', 'image');
            $updateMedia = $this->saveMediaItem(($request->image), $id, 'Modules\Testimonial\Entities\Testimonial', 'image', 'Testimonial');
        }
        if(!$updateTestimonial) {
            return redirect()->route('testimonial::testimonial.index')->with('error', __('testimonial::messages.:record could not updated.',['record'=>__('Record')]));
        } else {
            return redirect()->route('testimonial::testimonial.index')->with('success', __('testimonial::messages.:record updated successfully.',['record'=>__('Record')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param TestimonialViewRequest $request
     * @param int $id
     */
    public function destroy(TestimonialViewRequest $request, $id)
    {
        $deleteTestimonial = $this->testimonialRepository->deleteTestimonial($id);
        if(!$deleteTestimonial) {
            return redirect()->route('testimonial::testimonial.index')->with('error', __('testimonial::messages.:record could not deleted.',['record'=>__('Record')]));
        } else {
            return redirect()->route('testimonial::testimonial.index')->with('success', __('testimonial::messages.:record deleted successfully.',['record'=>__('Record')]));
        }
    }
}
