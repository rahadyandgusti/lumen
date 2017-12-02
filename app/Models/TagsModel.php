<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    protected $table = 'tags';

	protected $guarded = ['id'];

	protected $primaryKey = "id"; 

	public function pages() {
        return $this->hasMany(
            'App\Models\TagPagesModel', 
            'tag_id', 'id'
        );
    } 
}
