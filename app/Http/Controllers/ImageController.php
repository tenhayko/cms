<?php

namespace App\Http\Controllers;

use Image;
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

	public function fileupload(Request $request)
	{
		if($request->hasFile('file')) {
	        $filenamewithextension 	= $request->file('file')->getClientOriginalName();
	        $filename 				= pathinfo($filenamewithextension, PATHINFO_FILENAME);
	        $extension 				= $request->file('file')->getClientOriginalExtension();
	        $filenametostore 		= $filename.'_'.time().'.'.$extension;
	        $filepath 				= 'storage/attactments/';
	        $smallthumbnailpath 	= public_path('storage/attactments/thumbnail/small/'.$filenametostore);
	        $mediumthumbnailpath 	= public_path('storage/attactments/thumbnail/medium/'.$filenametostore);
	        $largethumbnailpath 	= public_path('storage/attactments/thumbnail/large/'.$filenametostore);
	        $request->file('file')->storeAs('public/attactments', $filenametostore);
	        $request->file('file')->storeAs('public/attactments/thumbnail/small/', $filenametostore);
	        $request->file('file')->storeAs('public/attactments/thumbnail/medium/', $filenametostore);
	        $request->file('file')->storeAs('public/attactments/thumbnail/large/', $filenametostore);
	        $this->createThumbnail([
	        	[
	        		'path' 		=> $largethumbnailpath,
	        		'width' 	=> 550,
	        		'height' 	=> 340,
	        	],
	        	[
	        		'path' 		=> $mediumthumbnailpath,
	        		'width' 	=> 300,
	        		'height' 	=> 185,
	        	],
	        	[
	        		'path' 		=> $smallthumbnailpath,
	        		'width' 	=> 150,
	        		'height' 	=> 93,
	        	],
	        ]);
	        return response()->json(['message'=>'Upload success!','status' => 200], 200);
	    }
	}

	public function createThumbnail(array $thumbnails = [])
	{
		foreach ($thumbnails as $key => $thumbnail) {
			$img = Image::make($thumbnail['path'])->resize($thumbnail['width'], $thumbnail['height'], function ($constraint) {
		        $constraint->aspectRatio();
		    });
		    $img->save($thumbnail['path']);
		}
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
