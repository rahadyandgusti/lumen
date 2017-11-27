<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagesModel;

class PagesController extends Controller
{
    protected $title = "Pages";
    protected $url = "page";
    protected $folder = "pages";
    protected $form;

    public function __construct(PagesModel $model)
    {
        $this->model = $model;
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
        $req = $request->all();

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

        $req['created_id'] = \Auth::user()->id;
        $req['updated_id'] = \Auth::user()->id;
        
        $result = $this->model
                    ->create($req);

        $id = $result->id;

        if ($result) {
            return [
            	'respond' => true,
            	'id' => $id
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
    public function show($id)
    {
    	$data = $this->model->find($id);

        return view($this->folder . '.show', [
            'title' => $this->title,
            'url' => $this->url,
            'data' => $data
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
        $data = $this->model->find($id);

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
        $req = $request->all();

        if($req['image_header']){
            $img = $this->model->find($id)->image_header;
            if (file_exists(public_path()."/".$img)) unlink($img);

            $image = \Image::make($request->image_header)->resize(945,325);
            $filename = md5($request->image_header.time()).'.jpg';
            $fileUrl = 'content/header/'.$filename;
            \Storage::disk('public')->put($fileUrl, $image->stream());
            $fileUrlThumb = 'content/header-thumb/'.$filename;
            $image = $image->crop(300,300);
            \Storage::disk('public')->put($fileUrlThumb, $image->stream());
            $req['image_header'] = $filename;
        }

        $req['updated_id'] = \Auth::user()->id;
        
        $result = $this->model->find($id)
                    ->update($req);

        if ($result) {
            return [
            	'respond' => true,
            	'id' => $id
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
        // $result = $this->model->find($id)->delete();

        // if ($result) {
        //     return ['respond' => true, 'message' => 'Successfully deleted'];
        // }

        // return ['respond' => false, 'message' => 'Failed to delete'];
        return '';
    }
}
