<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProviderAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_provider_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('payment_provider_id')
                ->constrained('payment_providers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('account_name');
            $table->string('account_number');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('seller_payment_provider_account_id')
                ->nullable()
                ->constrained('payment_provider_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('order_requests', function (Blueprint $table) {
            $table->foreignId('payment_provider_account_id')
                ->nullable()
                ->constrained('payment_provider_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_provider_accounts');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('seller_payment_provider_account_id');
            $table->drop('seller_payment_provider_account_id');
        });

        Schema::table('order_requests', function (Blueprint $table) {
            $table->dropForeign('payment_provider_account_id');
            $table->drop('payment_provider_account_id');
        });
    }
}
