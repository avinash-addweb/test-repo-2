<?php
//also import the main constants , if available
$mainConstants = @include(base_path('config/constants.php'));

$moduleConfig = [
    'name' => 'Testimonial',
    'pagination_limit' => 10,
    
];

//return the module constants with main constants(module constants overridden the main constants)
return ($mainConstants) ? \array_merge($mainConstants,$moduleConfig) : $moduleConfig;

//example usage  : config('constants.pagination_limit');