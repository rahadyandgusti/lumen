<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as RequestDefault;
use App\Models\PagesModel;
use App\Models\TagPagesModel;
use App\Models\TagsModel;
use App\Http\Requests\PagesRequest as Request;

class PagesController extends Controller
{
    protected $title = "Pages";
    protected $url = "page";
    protected $folder = "pages";
    protected $form;

    public function __construct(PagesModel $model,TagPagesModel $tagPageModel,TagsModel $tagModel)
    {
        $this->model = $model;
        $this->tagPageModel = $tagPageModel;
        $this->tagModel = $tagModel;
        // $this->form     = CategoryWisataForm::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	// $data['title'] = $this->title;
     //    $data['url'] = $this->url;

     //    return $dataTable->render($this->folder . '.index', $data);
    	return '';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \SEO::setTitle('Buat Content');
        \SEO::setDescription('Buat content yang dari user '.\Auth::user()->name);
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 

        return view($this->folder . '.form', [
            'title' => $this->title,
            'url' => $this->url,
            'urlForm' => route($this->url. '.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = $request->except('tags');

        if($req['image_header']){
            $image = \Image::make($request->image_header)->resize(945,325);
            $filename = md5($request->image_header.time()).'.jpg';
            $fileUrl = 'content/header/'.$filename;
            \Storage::disk('public')->put($fileUrl, $image->stream());
            $fileUrlThumb = 'content/header-thumb/'.$filename;
            $image = $image->crop(300,300);
            \Storage::disk('public')->put($fileUrlThumb, $image->stream());
            $req['image_header'] = $filename;
        }

        $req['slug'] = str_slug(str_limit(strip_tags($request->title), 100));

        $req['created_id'] = \Auth::user()->id;
        $req['updated_id'] = \Auth::user()->id;

        $validator = \Validator::make($req, [
            'slug' => 'required|unique:pages,slug',
        ]);

        if ($validator->fails()) {
            return [
                'respond' => false,
                'message' => 'Title already in database'
            ];
        }
        $result = $this->model
                    ->create($req);

        if (count($request->tags)) {
            foreach ($request->tags as $key => $value) {
                if (is_numeric($value)) {
                    $inputId = $value;
                } else {
                    $inputId = 0;
                    $checkId = $this->tagModel->select('id')
                                ->where(\DB::raw('name'),'like',"%".strtolower($value)."%")->first();
                    if (count($checkId)) {
                        $inputId = $checkId;
                    } else {
                        $tmpInputTag = $this->tagModel->create(['name' => strtolower($value)]);
                        $inputId = $tmpInputTag->id;
                    }

                }
                $this->tagPageModel->create([
                    'page_id' => $result->id,
                    'tag_id' => $inputId
                ]);
            }
        }
        

        $id = $result->id;

        if ($result) {
            return [
            	'respond' => true,
            	'id' => $req['slug']
            ];
        }

        return [
            	'respond' => false,
            	'message' => 'Create data failed'
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    	$data = $this->model->with('tags.tag:id,name')->where('slug',$slug)->first();

        \SEO::setTitle(str_limit($data->title, 160));
        \SEO::setDescription(str_limit(strip_tags($data->content), 160));
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 
        $tags = [];
        foreach ($data->tags as $value) {
            $tags[] = $value->tag->name;
        }
        \SEOMeta::addKeyword($tags); 
        if($data->image_header){
            \SEO::opengraph()->addImage(\ImageHelper::getContentHeader($data->image_header), ['height' => 300, 'width' => 300]);
            \SEO::opengraph()->addImage(\ImageHelper::getContentHeaderThumb($data->image_header), ['height' => 300, 'width' => 300]);
        }

        if(count($data) == 0){
            abort(404);
        }
        if($data->status == 'publish'){
            $this->model->find($data->id)->update([
                'hit' => intval($data->hit)+1
            ]);
        }

        return view($this->folder . '.show', [
            'title' => $this->title,
            'url' => $this->url,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data = $this->model->with('tags.tag:id,name')->find($id);

        \SEO::setTitle('Ubah Content dengan judul: '.str_limit($data->title, 140));
        \SEO::setDescription('Ubah content yang dari user '.\Auth::user()->name);
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 
        $tags = [];
        foreach ($data->tags as $value) {
            $tags[] = $value->tag->name;
        }
        \SEOMeta::addKeyword($tags); 
        if($data->image_header){
            \SEO::opengraph()->addImage(\ImageHelper::getContentHeader($data->image_header), ['height' => 300, 'width' => 300]);
            \SEO::opengraph()->addImage(\ImageHelper::getContentHeaderThumb($data->image_header), ['height' => 300, 'width' => 300]);
        }

        return view($this->folder . '.form', [
            'title' => $this->title,
            'url' => $this->url,
            'urlForm' => route($this->url. '.update', $id),
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $req = $request->except('tags');

        if($req['image_header']){
            $img = $this->model->find($id)->image_header;
            if (file_exists(public_path()."/content/header/".$img)) unlink(public_path()."/content/header/".$img);
            if (file_exists(public_path()."/content/header-thumb/".$img)) unlink(public_path()."/content/header-thumb/".$img);

            $image = \Image::make($request->image_header)->resize(945,325);
            $filename = md5($request->image_header.time()).'.jpg';
            $fileUrl = 'content/header/'.$filename;
            \Storage::disk('public')->put($fileUrl, $image->stream());
            $fileUrlThumb = 'content/header-thumb/'.$filename;
            $image = $image->crop(300,300);
            \Storage::disk('public')->put($fileUrlThumb, $image->stream());
            $req['image_header'] = $filename;
        }

        $req['slug'] = str_slug(str_limit(strip_tags($request->title), 100));

        $req['updated_id'] = \Auth::user()->id;

        $validator = \Validator::make($req, [
            'slug' => 'required|unique:pages,slug,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors([
                            'title' => 'Title already in database'
                        ])
                        ->withInput();
        }
        
        $result = $this->model->find($id)
                    ->update($req);
        if (count($request->tags)) {
            $notDelId = [];

            foreach ($request->tags as $key => $value) {
                $inputId = 0;
                if (is_numeric($value)) {
                    $inputId = $value;
                } else {
                    $checkId = $this->tagModel->select('id')
                                ->where(\DB::raw('name'),'like',"".strtolower($value)."")->first();
                    if (count($checkId)) {
                        $inputId = $checkId;
                    } else {
                        $tmpInputTag = $this->tagModel->create(['name' => strtolower($value)]);
                        $inputId = $tmpInputTag->id;
                    }

                }
                $checkData = $this->tagPageModel->select('id')
                            ->where('page_id',$id)
                            ->where('tag_id',$inputId)
                            ->first();
                if (count($checkData) == 0) {
                    $r = $this->tagPageModel->create([
                        'page_id' => $id,
                        'tag_id' => $inputId
                    ]);
                    $notDelId[] = $r->id;
                } else {
                    $notDelId[] = $checkData->id;
                }
            }

            $this->tagPageModel->where('page_id',$id)->whereNotIn('id',$notDelId)->delete();
        }
        

        if ($result) {
            return [
            	'respond' => true,
            	'id' => $req['slug']
            ];
        }

        return [
            	'respond' => false,
            	'message' => 'Update data failed'
            ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->find($id)->delete();

        if ($result) {
            return ['respond' => true, 'message' => 'Successfully deleted'];
        }

        return ['respond' => false, 'message' => 'Failed to delete'];
    }

    public function search(RequestDefault $request) {
        \SEO::setTitle('Pencarian');
        \SEO::setDescription('List pencarian content');
        \SEO::opengraph()->setUrl(\Request::url());
        \SEO::setCanonical(\Request::url());
        \SEO::opengraph()->addProperty('type', 'articles');
        \SEO::opengraph()->setSiteName(config('app.name')); 
        \SEOMeta::addKeyword([$request->get('keyword')]); 

        if($request->get('keyword')){
            $data['data'] = $this->model
                        ->where('status', 'publish')
                        ->select('id', 'slug', 'title','created_id')
                        ->groupBy('id')
                        ->search($request->get('keyword'), null, true)
                        ->with('tags')
                        ->with('createduser')
                        ->paginate(15);
        } else {
            $data['data'] = $this->model
                        ->where('id', 0)
                        ->paginate(15);
        }

        return view($this->folder . '.search', $data);
    }

    public function tags($tag) {
        $data['data'] = $this->model
                        ->whereHas('tags.tag', function($query) use ($tag){
                            $query->where('name', $tag);
                        })
                        ->paginate(15);
        $data['tag'] = $tag;
        return view($this->folder . '.tags', $data);
    }

    public function getSearch(RequestDefault $request) {
        if($request->get('keyword')){
            return $this->model
                        ->select(\DB::raw('distinct id'), 'title', 'content','image_header')
                        ->where('status', 'publish')
                        ->search($request->get('keyword'), null, true)
                        ->with('tags')
                        ->paginate(15);
        } else {
            return $this->model
                        ->where('id', 0)
                        ->paginate(15);
        }

        return view($this->folder . '.search', $data);
    }

    public function getData($id) {
        return $this->model->with('createduser:id,name','tags.tag:id,name')->find($id)->toArray();
    }
}
