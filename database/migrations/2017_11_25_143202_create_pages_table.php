<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    protected $foreignTable = [
        [
            'table' => 'users',
            'localId' => 'created_id',
            'foreignId' => 'id',
            'update' => 'cascade',
            'delete' => 'set null',
            'null' => true,
        ],
        [
            'table' => 'users',
            'localId' => 'updated_id',
            'foreignId' => 'id',
            'update' => 'cascade',
            'delete' => 'set null',
            'null' => true,
        ],
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image_header')->nullable();
            $table->longText('content');
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
