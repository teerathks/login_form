<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQbidNegotiatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qbid_negotiators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->String('mobile_call');
            $table->String('mobile_text')->nullable();
            $table->String('company_name')->nullable();
            $table->String('nick_name');
            $table->String('zip_code');
            $table->boolean('retired');
            $table->boolean('self_employed');
            $table->Integer('nick_name_status')->default(0);
            $table->String('address_line1')->nullable();
            $table->String('address_line2')->nullable();
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
        Schema::dropIfExists('qbid_negotiators');
    }
}
