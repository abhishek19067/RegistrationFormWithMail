<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stored_datas', function (Blueprint $table) {
            $table->id();
            $table->string("Username",191);
            $table->integer("Roll Number");
            $table->integer("Neet Score");
            $table->integer("All India Rank");
            $table->string("BFUHS REGISTRATION ID");
            $table->string("Father Name");
            $table->string("Mother Name");
            $table->date("Dob");
            $table->string("Gender",191);
            $table->string("Religion",191);
            $table->string("Member Chruch",191);
            $table->string("Duration Membership",191);
            $table->date("Date of Baptism");
            $table->string("State",191);
            $table->integer("Landline Number");
            $table->integer("Mobile");
            $table->integer("Alternative");
            $table->string("Address",191);
            $table->string("email",191);
            $table->string("course",191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stored_datas');
    }
};
