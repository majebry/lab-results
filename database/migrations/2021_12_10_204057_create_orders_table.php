<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('patient_first_name');
            $table->string('patient_last_name');
            $table->date('patient_date_of_birth');
            $table->string('patient_phone')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('reason_of_test');
            $table->string('covid_test_type');
            $table->date('date_of_test');
            $table->boolean('is_patient_swabbed')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
