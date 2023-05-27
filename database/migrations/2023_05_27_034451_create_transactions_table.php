<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->tinyInteger('transaction_type')->comment('(1-deposit, 2-withdrawal, 3-transfer from, 4-trasfer to)');
            $table->decimal('amount', 10, 2)->unsigned();
            $table->decimal('balance', 10, 2)->unsigned();   
            $table->string('recipient_email', 255)->nullable();
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
