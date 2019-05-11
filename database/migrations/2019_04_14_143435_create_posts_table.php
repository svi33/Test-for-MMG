<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('content');
            $table->string('file');
            $table->integer('category_id');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
