<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInPages extends Migration
{
    protected $table = 'pages';
    protected $column1 = 'status';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn($this->table,$this->column1)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->enum($this->column1,['draft','publish','hidden'])->default('draft');
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
    }
}
