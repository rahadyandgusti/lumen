<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagPagesTable extends Migration
{
    protected $foreignTable = [
        [
            'table' => 'tags',
            'localId' => 'tag_id',
            'foreignId' => 'id',
            'update' => 'cascade',
            'delete' => 'cascade',
            'null' => false,
        ],
        [
            'table' => 'pages',
            'localId' => 'page_id',
            'foreignId' => 'id',
            'update' => 'cascade',
            'delete' => 'cascade',
            'null' => false,
        ],
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_pages', function (Blueprint $table) {
            $table->increments('id');
            foreach($this->foreignTable as $f){
                if ($f['null']) {
                    $table->integer($f['localId'])->unsigned()->nullable();
                } else {
                    $table->integer($f['localId'])->unsigned();
                }
                $table->foreign($f['localId'])
                    ->references($f['foreignId'])->on($f['table'])
                    ->onDelete($f['delete'])->onUpdate($f['update']);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_pages');
    }
}
