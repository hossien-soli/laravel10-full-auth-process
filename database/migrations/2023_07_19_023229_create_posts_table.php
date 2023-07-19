<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title');  // min:5  max:100
            $table->string('slug')->unique();
            $table->string('banner')->unique()->nullable(); // image banner
            $table->text('content');

            $table->mediumInteger('likes_count')->unsigned()->nullable(); // max:999999
            $table->mediumInteger('dislikes_count')->unsigned()->nullable();  // max:999999
            $table->smallInteger('comments_count')->unsigned()->nullable();  // max:60000

            $table->tinyInteger('status')->nullable();
            // null=0=created-by-user  1=accepeted-by-admin(published)  2=rejected-by-admin  3=hidden-by-user  4=banned-by-admin
            $table->string('reject_reason')->nullable();

            $table->dateTime('published_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
