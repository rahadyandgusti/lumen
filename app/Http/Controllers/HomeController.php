<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagesModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PagesModel $model)
    {
        $this->model = $model;
        // $this->form     = CategoryWisataForm::class;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['new'] = $this->model
                        // ->where('status', 'publish')
                        ->orderBy('id','desc')->get()->take(6);

        return view('home',$data);
    }
}
