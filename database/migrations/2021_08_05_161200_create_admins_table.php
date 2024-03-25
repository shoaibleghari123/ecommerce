<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('password_hint');

            $table->timestamps();
        });
        $this->insertAdminUser();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }

    private function insertAdminUser()
    {
        $user = new App\Models\Admin\Admin(); // Replace 'User' with your actual user model class
        $user->email = 'admin@gmail.com'; // Replace with your desired admin email
        $user->password = bcrypt('password'); // Hash the password using bcrypt
        $user->password_hint = 'password'; // Optional: Set a password hint
        $user->save();
    }
}
