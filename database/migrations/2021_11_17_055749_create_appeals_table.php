<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Gender;

class CreateAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();

            $table->string('name', 20);
            $table->string('surname', 40);
            $table->string('patronymic', 20)->nullable();

            $table->unsignedTinyInteger('age');
            $table->enum('gender', [Gender::MALE, Gender::FEMALE]);

            $table->string('phone')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('message', 100);

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
        Schema::dropIfExists('appeals');
    }
}
