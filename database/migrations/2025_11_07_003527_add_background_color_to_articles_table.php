<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Article;
use App\Models\Article as ModelsArticle;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('background_color', 7)->nullable()->after('content');
            $table->string('icon_color', 7)->nullable()->after('background_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('background_color');
            $table->dropColumn('icon_color');
        });
    }
};
