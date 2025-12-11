<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('nim')->unique();
        $table->string('nama');
        $table->string('jurusan');
        $table->string('angkatan');
        $table->string('email')->unique();
        $table->string('telepon')->nullable();
        $table->timestamps();
    });
}



public function down(): void
{
Schema::dropIfExists('students');
}
};