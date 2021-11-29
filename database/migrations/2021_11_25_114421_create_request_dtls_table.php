<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_dtls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_hdr_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('request_hdr_id')->references('id')->on('request_hdrs')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_dtls');
    }
}
