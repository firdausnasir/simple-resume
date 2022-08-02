<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id('resume_id');
            $table->unsignedBigInteger('user_id');
            $table->char('slug');
            $table->char('name');
            $table->char('position')->nullable();
            $table->text('contact_info')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });

        Schema::create('work_histories', function (Blueprint $table) {
            $table->id('work_history_id');
            $table->unsignedBigInteger('resume_id');
            $table->char('title');
            $table->char('company');
            $table->timestamp('started_working_at');
            $table->timestamp('ended_working_at')->nullable();
            $table->longText('detail')->nullable();
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id('education_id');
            $table->unsignedBigInteger('resume_id');
            $table->char('institutional_name');
            $table->char('education_major');
            $table->timestamp('started_study_at');
            $table->timestamp('ended_study_at')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('work_histories');
        Schema::dropIfExists('educations');
    }
};
