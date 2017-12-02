<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagesModel;
use App\Models\TagsModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PagesModel $page, TagsModel $tag)
    {
        $this->page = $page;
        $this->tag = $tag;
        // $this->form     = CategoryWisataForm::class;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['new'] = $this->page
                        // ->where('status', 'publish')
                        ->orderBy('id','desc')->get()->take(6);
        $data['views'] = $this->page
                        // ->where('status', 'publish')
                        ->orderBy('hit','desc')->get()->take(6);
        $data['tags'] = $this->tag
                        ->orderBy('id','desc')->get()->take(10);

        return view('home',$data);
    }
}
