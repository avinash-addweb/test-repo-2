<?php

namespace Modules\Testimonial\Http\Resources\Api\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'email' => $this?->email??"",
            'lang_code' => $this?->testimonialLocales[0]?->lang_code??"",
            'name' => $this?->testimonialLocales[0]?->name??"",
            'designation' => $this?->testimonialLocales[0]?->designation??"",
            'contents' => $this?->testimonialLocales[0]?->contents??"",
            'image' => (!empty($this->testimonialImage->name) && !empty($this->testimonialImage->path)) ? asset(config('constants.asset_prefix').$this->testimonialImage->path.DIRECTORY_SEPARATOR.$this->testimonialImage->name) : "",
            //'status' => $this->status,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ];
    }
}
