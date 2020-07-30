<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer',50)->comment('客戶名稱');
            $table->string('material',80)->comment('訂購材質');
            $table->string('telephone',20)->unique();
            $table->integer('thickness')->unsigned()->comment('厚度');
            $table->integer('width')->unsigned()->comment('寬度');
            $table->integer('length')->unsigned()->comment('長度');
            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('customer_products');
    }
}
