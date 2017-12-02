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
                        ->where('status', 'publish')
                        ->orderBy('id','desc')->get()->take(6);
        $data['views'] = $this->page
                        ->where('status', 'publish')
                        ->orderBy('hit','desc')->get()->take(6);
        $data['tags'] = $this->tag
                        ->withCount('pages')
                        ->orderBy('id','desc')->get()->take(50);
        $data['sumTagCount'] = $data['tags']->sum('pages_count');
        return view('home',$data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function draft()
    {
        $user = \Auth::user();
        $data['draft'] = $this->page
                        ->where('status', 'draft')
                        ->where('created_id', $user->id)
                        ->orderBy('id','desc')->get()->take(6);
        $data['tags'] = $this->tag
                        ->whereHas('pages.page', function($query) use ($user){
                            $query->where('created_id', $user->id);
                        })
                        ->orderBy('id','desc')->get()->take(50);
        $data['sumTagCount'] = $data['tags']->sum('pages_count');
        return view('pages.show-draft',$data);
    }
}
