<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Article;


class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // L'auteur de la proposition
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable(); // chemin vers l'image (nullable = facultatif)
            $table->string('category')->nullable();
            $table->string('region')->nullable();
            $table->boolean('anonymous')->default(false);
            $table->timestamps();

            // Contraintes et index
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
