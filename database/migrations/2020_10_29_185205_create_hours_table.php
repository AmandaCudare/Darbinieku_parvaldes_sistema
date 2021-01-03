<?php
//Dienas izdarītā tabula
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->id();
            $table->string('description',500);
            $table->date('day');
            $table->integer('week');
            $table->double('hours',4,2);
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('hours');
    }
}
