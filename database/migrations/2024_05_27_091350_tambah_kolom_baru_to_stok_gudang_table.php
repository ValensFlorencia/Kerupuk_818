<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomBaruToStokGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stok_gudang', function (Blueprint $table) {
            $table->integer('stok_masuk')->nullable()->after('stok_gudang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stok_gudang', function (Blueprint $table) {
            $table->dropColumn([
                'stok_masuk'
            ]);
        });
    }
}
