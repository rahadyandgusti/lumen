<?php

use App\Models\TagsModel as tag;

class TagHelper {
	public static function getTagData(){
		$data = tag::select('name')
				->withCount('pages')
                ->whereHas('pages.page', function ($query) {
				    $query->where('status', '=', 'publish');
				})
                ->orderBy('id','desc')->get()->take(50);
        $total = $data->sum('pages_count');
		return [
			'tags' => $data,
			'total' => $total
		];
	}
}