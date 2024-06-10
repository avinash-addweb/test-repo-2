<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
        Schema::create('testimonial_locales', function (Blueprint $table) {
            $table->id();
            $table->string('lang_code');
            $table->unsignedBigInteger('testimonial_id');
            $table->string('name');
            $table->string('designation');
            $table->text('contents');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->unique(["lang_code", "testimonial_id"], 'testimonial_local_unique');
        });
        Schema::table('testimonial_locales', function (Blueprint $table) {
            $table->foreign('testimonial_id')->references('id')->on('testimonials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonial_locales', function (Blueprint $table) {
            $table->dropForeign(['testimonial_id']);
        });
        Schema::dropIfExists('testimonial_locales');
        Schema::dropIfExists('testimonials');
    }
};

