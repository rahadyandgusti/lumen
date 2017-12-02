<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagesModel extends Model
{
    protected $table = 'pages';

	protected $guarded = ['id'];

	protected $primaryKey = "id"; 

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
