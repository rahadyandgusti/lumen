<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request as RequestDefault;
use App\Models\PagesModel;
use App\Models\TagsModel;

class HomeController extends Controller
{
    protected $title = "Pages";
    protected $url = "page";
    protected $folder = "pages-new";
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

        $getUser = \Auth::user();
        $data['user'] = $getUser?str_replace(' ','_',strtolower($getUser->name)):'user';
        $data['path'] = '/home/search '.($getUser?'#':'$');
        return view('home-new', $data);
    }

    public function search(RequestDefault $request) {
        \SEO::setTitle('Pencarian');
        \SEO::setDescription('List pencarian content');
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 
        \SEOMeta::addKeyword([$request->get('keyword')]);

        $data = $this->getFunctionData(); 

        if($request->get('keyword')){
            $keyWord = $request->get('keyword');
            $data['data'] = $this->page
                        ->where('status', 'publish')
                        ->select('id', 'slug', 'title', 'created_id')
                        ->groupBy('id')
                        ->where(function($query) use ($keyWord){
                            $tmpKeyWoard = explode(' ',$keyWord);
                            foreach ($tmpKeyWoard as $key => $value) {
                                if($key==0)
                                    $query->where('title','ilike','%'.$value.'%');
                                else
                                    $query->orWhere('title','ilike','%'.$value.'%');

                                $query->orWhereHas('tags.tag',function($queryTag)use($value){
                                    $queryTag->where('name','ilike','%'.$value.'%');
                                });
                            }
                        })
                        ->with('tags')
                        ->with('createduser')
                        ->paginate(15);
        } else {
            $data['data'] = $this->page
                        ->where('id', 0)
                        ->paginate(15);
        }

        return view($this->folder . '.search', $data);
    }

    private function getFunctionData(){
        $getUser = \Auth::user();
        $data['user'] = $getUser?str_replace(' ','_',strtolower($getUser->name)):'user';
        $data['path'] = '/home/search '.($getUser?'#':'$');
        return $data;
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
