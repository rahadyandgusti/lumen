<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugInPages extends Migration
{
    protected $table = 'pages';
    protected $column1 = 'slug';
    protected $column2 = 'hit';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn($this->table,$this->column1)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string($this->column1,100)->unique()->nullable();
            });
        }
        if (! Schema::hasColumn($this->table,$this->column2)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->bigInteger($this->column2)->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn($this->table,$this->column1)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn($this->column1);
            });
        }
        if (Schema::hasColumn($this->table,$this->column2)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn($this->column2);
            });
        }
    }
}
