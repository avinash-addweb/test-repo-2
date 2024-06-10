<?php

namespace Modules\Testimonial\Repositories\Interfaces;

Interface TestimonialRepositoryInterface{
    public function getData(array $filters, bool $pagination = true);
    public function getAllData();
    public function viewTestimonial(int $id);
    public function storeTestimonial(array $data);
    public function updateTestimonial(array $data, int $id); 
    public function deleteTestimonial(int $id);
    public function deleteModelMediaAttribute(int $model_id, string $model_name, string $media_for_attribute);
}