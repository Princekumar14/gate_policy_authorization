<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $timestamps = false;
    public function up(): void
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',30)->nullable();
            $table->string('customer_email',40)->nullable();
            $table->string('customer_phone');
            $table->string('customer_message')->nullable();
            $table->string('requested_product_image');
            $table->string('page_info');
            $table->string('staff_comment')->default('');
            $table->boolean('status')->default(0);
            $table->timestamp('requested_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
