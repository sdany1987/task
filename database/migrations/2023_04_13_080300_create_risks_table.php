<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->tinyInteger('user_id')->default(1)->comment('Creator ID refer user table');
            $table->tinyInteger('created_by')->default(1)->comment('1->Admin,2->User');
            $table->Integer('assigned_to')->default(0)->comment('Refer the user table');
            $table->Integer('assigned_by')->default(0)->comment('refer the user table');
            $table->Integer('assigned_type')->default(0)->comment('1->Admin,2->User,3->Self');
            $table->tinyInteger('status')->nullable()->comment('1->Active,2->Inactive');
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('risks');
    }
}
