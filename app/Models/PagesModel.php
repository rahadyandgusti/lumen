<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PagesModel extends Model
{
    use SearchableTrait;

    protected $table = 'pages';

	protected $guarded = ['id'];

	protected $primaryKey = "id"; 

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'pages.title' => 10,
            'pages.content' => 10,
            'tags.name' => 10,
        ],
        'joins' => [
            'tag_pages' => ['pages.id','tag_pages.page_id'],
            'tags' => ['tag_pages.tag_id','tags.id'],
        ],
    ];

    public function createduser() {
        return $this->hasOne(
            'App\Models\UsersModel', 
            'id', 'created_id'
        );
    } 

    public function updateduser() {
        return $this->hasOne(
            'App\Models\UsersModel', 
            'id', 'updated_id'
        );
    } 

	public function tags() {
        return $this->hasMany(
            'App\Models\TagPagesModel', 
            'page_id', 'id'
        );
    } 
}
