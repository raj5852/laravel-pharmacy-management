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
        Schema::create('medicinepers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('quantity')->nullable();
            $table->string('rack')->nullable();
            $table->string('supplier')->nullable();
            $table->string('priceparunit')->nullable();
            $table->string('saleprice')->nullable();
            $table->string('totalcost')->nullable();
            $table->string('expairdate')->nullable();
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
        Schema::dropIfExists('medicinepers');
    }
};
