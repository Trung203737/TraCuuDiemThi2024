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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('registration_number')->unique(); // SBD
        $table->decimal('toan', 5, 2)->nullable();
        $table->decimal('ngu_van', 5, 2)->nullable();
        $table->decimal('ngoai_ngu', 5, 2)->nullable();
        $table->decimal('vat_li', 5, 2)->nullable();
        $table->decimal('hoa_hoc', 5, 2)->nullable();
        $table->decimal('sinh_hoc', 5, 2)->nullable();
        $table->decimal('lich_su', 5, 2)->nullable();
        $table->decimal('dia_li', 5, 2)->nullable();
        $table->decimal('gdcd', 5, 2)->nullable();
        $table->string('ma_ngoai_ngu')->nullable();
        $table->decimal('total_group_a', 6, 2)->nullable(); // Toán + Lý + Hóa
        $table->decimal('total_group_b', 6, 2)->nullable(); // Toán + Hóa + Sinh
        $table->decimal('total_group_c', 6, 2)->nullable(); // Văn + Sử + Địa
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
