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
        \SEO::setTitle('Home');
        \SEO::setDescription('ini hanya web catatan kecil coding. karena developer adalah seorang programmer yang sering lupa akan hal-hal kecil yang biasanya sangat penting. daripada mencari dari awal masih mending ditulis aja. ');
        \SEO::opengraph()->setUrl(url('/'));
        \SEO::setCanonical(url('/'));
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 

        $data['new'] = $this->page
                        ->where('status', 'publish')
                        ->select('id', 'slug', 'title','created_id')
                        ->with('tags.tag:id,name','createduser:id,name')
                        ->orderBy('id','desc')->get()->take(6);
        $data['views'] = $this->page
                        ->where('status', 'publish')
                        ->select('id', 'slug', 'title','created_id')
                        ->with('tags.tag:id,name','createduser:id,name')
                        ->orderBy('hit','desc')->get()->take(6);
        $data['tags'] = $this->tag
                        ->withCount('pages')
                        ->whereHas('pages')
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
        \SEO::setTitle('Draft');
        \SEO::setDescription('List content draft yang sudah ditulis namun belum di publish ke umum dari user '.$user->name);
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 

        $data['draft'] = $this->page
                        ->where('status', 'draft')
                        ->where('created_id', $user->id)
                        ->with('tags.tag:id,name')
                        ->orderBy('id','desc')->get()->take(6);
        $data['tags'] = $this->tag
                        ->whereHas('pages.page', function($query) use ($user){
                            $query->where('created_id', $user->id);
                        })
                        ->orderBy('id','desc')->get()->take(50);
        $data['sumTagCount'] = $data['tags']->sum('pages_count');
        return view('pages.show-draft',$data);
    }

    public function testHome(){
        $data['data'] = $this->page
                        ->select('id','image_header')
                        ->where('status', 'publish')
                        ->orderBy('id','desc')->get();
        return view('pages.testHome', $data);
    }
    public function getData($id){
        $data = $this->page
                        ->find($id);
        return $data;
    }
    public function testPage($test){
        return view('pages.testPage');
    }
}
