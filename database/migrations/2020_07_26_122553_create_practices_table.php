<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer')->comments('客戶名稱');
            $table->string('material')->comments('訂購材質');
            $table->string('tel')->unique();
            $table->integer('T')->unsigned()->comments('厚度');
            $table->integer('W')->unsigned()->comments('寬度');
            $table->integer('L')->unsigned()->comments('長度');
            $table->date('shipment_date')->comments('出貨日期');

            #softDelete 軟刪除：一般情況下search不到，但將資料留在資料表中
            $table->softDeletes();
            #通常必放
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practices');
    }
}
