<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('district_id')->unsigned();
            $table->double("latitude");
            $table->double("longitude");
            $table->string("title");
            $table->string("description", 2000);
            $table->tinyInteger("priority")->default(0);
            $table->boolean("status")->default(0);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("city_id")->references("id")->on("cities");
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("district_id")->references("id")->on("districts")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
