<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	public function manager()
	{
		$storage = [
					  [
					    "url"=> "https://image.shutterstock.com/image-photo/colorful-flower-on-dark-tropical-260nw-721703848.jpg",
					    "thumb"=> "https://image.shutterstock.com/image-photo/colorful-flower-on-dark-tropical-260nw-721703848.jpg",
					    "tag"=> "flower",
					    "name"=> "Photo 2 Name",
    					"id"=> "1034542853"
					  ],
					  [
					    "url"=> "https://image.shutterstock.com/image-photo/large-beautiful-drops-transparent-rain-260nw-668593321.jpg",
					    "thumb"=> "https://image.shutterstock.com/image-photo/large-beautiful-drops-transparent-rain-260nw-668593321.jpg",
					    "tag"=> "sport",
					    "name"=> "Photo 1 Name",
    					"id"=> "103454285"
					  ]
					];
		return response()->json($storage, 200);
	}

	public function managerDelete(Request $request)
	{
		echo '<pre>';
		print_r($request->all());
		   die;
	}

    public function upload(Request $request)
    {
        $path   = $request->file('file')->store('public/posts');
        $url    = Storage::url($path);
        return response()->json(['secure_url'=>$url,'status' => 200], 200);
    }

    public function delete(Request $request)
    {
    	if ($request->url) {
    		$url = str_replace('storage', 'public', $request->url);
    		Storage::delete($url);
    	}
        return response()->json(['message'=>'ok','status' => 200], 200);
    }
}
