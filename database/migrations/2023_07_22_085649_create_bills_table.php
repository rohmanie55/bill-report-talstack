<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('type_id')->constrained('bill_types')->restrictOnDelete();
            $table->double('bill_amount', 10,2);
            $table->double('pay_amount', 10,2)->default(0);
            $table->timestamp('pay_date')->nullable();
            $table->string('pay_slip')->nullable();
            $table->text('user_note')->nullable();
            $table->text('admin_note')->nullable();
            $table->string('status', 10)->default('created');
            $table->timestamp('approve_at')->nullable();
            $table->foreignId('approve_by')->nullable()->constrained('users');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
