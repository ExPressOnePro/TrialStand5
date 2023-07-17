<?php

use App\Models\Congregation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('congregation_id');
            $table->unsignedBigInteger('groups_id');
            $table->text('mobile_phone');
            $table->text('additional_phone');
            $table->text('brief_information');
            $table->string('gender');
            $table->string('hometown');
            $table->string('languages');
            $table->string('city');
            $table->string('address');
            $table->date('birthday');
            $table->date('christening_day');
            $table->timestamp('last_login');
            $table->timestamp('registration_date');
            $table->text('user_agent');
            $table->timestamp('email_verified_at');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
