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
        Schema::create('waybills', function (Blueprint $table) {
            $table->id();
            $table->string('waybill_no')->unique()->nullable();
            $table->string('type')->nullable();
            $table->string('van_no')->nullable();
            $table->foreignId('consignee_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipper_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('shipment');
            $table->decimal('cbm', 12, 6)->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('declared_value', 12, 2)->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waybills');
    }
};
