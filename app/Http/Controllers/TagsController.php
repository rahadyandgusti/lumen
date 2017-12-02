<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TagsModel as Model;
// use App\Http\Requests\PagesRequest as Request;

class TagsController extends Controller
{
    
    public function __construct(Model $model)
    {
        $this->model = $model;
        // $this->form     = CategoryWisataForm::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request) {
    	// return $request->all();
    	$data = $this->model->select('name as text','id')
    			->where(\DB::raw('LOWER(name)'),'like','%'.strtolower($request->search).'%')
    			->offset((intval($request->page)-1)*10)
    			->paginate(10);
    	return $data->toArray();
    }
}
