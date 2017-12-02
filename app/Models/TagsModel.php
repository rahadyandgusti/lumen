<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    protected $table = 'tags';

	protected $guarded = ['id'];

	protected $primaryKey = "id"; 
}
