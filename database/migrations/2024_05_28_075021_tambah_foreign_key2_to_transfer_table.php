<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahForeignKey2ToTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfer', function (Blueprint $table) {
            $table->unsignedInteger('id_stokgudang')->change();
            $table->foreign('id_stokgudang')
                ->references('id_stokgudang')
                ->on('stok_gudang')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer', function (Blueprint $table) {
            $table->integer('id_stokgudang')->change();
            $table->dropForeign('transfer_id_stokgudang_foreign');
        });
    }
}
