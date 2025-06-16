<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert default admin account
        Admin::create([
            'username' => 'finlabadmin',
            'name' => 'Finlab Admin',
            'email' => 'finlab@gmail.com',
            'password' => Hash::make('finlab123'),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};