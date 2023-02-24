<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8,2);
            $table->enum('category', ['men', 'women', 'child']);
            $table->string('description', 300);
            $table->binary('thumbnail');
            $table->timestamps();
            
        });
        
        $sql = 'alter table shops change thumbnail thumbnail longblob';
        DB::statement($sql);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
};
