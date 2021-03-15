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

            $table->foreignId('cryptocurrency_id')
                ->constrained('cryptocurrencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('initiator_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('seller_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('buyer_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('random_id')
                ->unique();
            
            $table->decimal('price', 11, 2);
            $table->decimal('price_per_unit', 11, 2)
                ->nullable();
            
            $table->tinyInteger('type');
            
            $table->tinyInteger('status');
            
            $table->string('buyer_cryptocurrency_address')
                ->nullable();
            $table->decimal('cryptocurrency_amount', 11, 5)
                ->nullable();
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
