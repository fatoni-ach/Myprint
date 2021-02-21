<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUserToProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id');
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->foreignId('kategori_id')->after('id');
        });

        Schema::table('gambar_produks', function (Blueprint $table) {
            $table->foreignId('produk_id')->after('id');
        });

        Schema::table('unggulan_produks', function (Blueprint $table) {
            $table->foreignId('produk_id')->after('id');
        });

        Schema::table('promos', function (Blueprint $table) {
            $table->foreignId('produk_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profils', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('produks', function (Blueprint $table) {
            $table->dropColumn('kategori_id');
        });
        Schema::dropIfExists('gambar_produks', function (Blueprint $table) {
            $table->dropColumn('produk_id');
        });
        Schema::dropIfExists('unggulan_produks', function (Blueprint $table) {
            $table->dropColumn('produk_id');
        });
        Schema::dropIfExists('promos', function (Blueprint $table) {
            $table->dropColumn('produk_id');
        });
    }
}
