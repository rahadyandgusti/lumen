<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagPagesModel extends Model
{
    protected $table = 'tag_pages';

	protected $guarded = ['id'];

	protected $primaryKey = "id"; 

	public $timestamps = false;

    public function page() {
        return $this->hasOne(
            'App\Models\PagesModel', 
            'id', 'page_id'
        );
    } 

    public function tag() {
        return $this->hasOne(
            'App\Models\TagsModel', 
            'id', 'tag_id'
        );
    } 
}
