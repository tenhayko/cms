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
	        //get filename with extension
	        $filenamewithextension = $request->file('file')->getClientOriginalName();
	  
	        //get filename without extension
	        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
	  
	        //get file extension
	        $extension = $request->file('file')->getClientOriginalExtension();
	  
	        //filename to store
	        $filenametostore = $filename.'_'.time().'.'.$extension;
	 
	        //small thumbnail name
	        $smallthumbnail = $filename.'_small_'.time().'.'.$extension;
	 
	        //medium thumbnail name
	        $mediumthumbnail = $filename.'_medium_'.time().'.'.$extension;
	 
	        //large thumbnail name
	        $largethumbnail = $filename.'_large_'.time().'.'.$extension;
	 
	        //Upload File
	        $request->file('file')->storeAs('public/profile_images', $filenametostore);
	        $request->file('file')->storeAs('public/profile_images/thumbnail', $smallthumbnail);
	        $request->file('file')->storeAs('public/profile_images/thumbnail', $mediumthumbnail);
	        $request->file('file')->storeAs('public/profile_images/thumbnail', $largethumbnail);
	  
	        //create small thumbnail
	        $smallthumbnailpath = public_path('storage/profile_images/thumbnail/'.$smallthumbnail);
	        $this->createThumbnail($smallthumbnailpath, 150, 93);
	 
	        //create medium thumbnail
	        $mediumthumbnailpath = public_path('storage/profile_images/thumbnail/'.$mediumthumbnail);
	        $this->createThumbnail($mediumthumbnailpath, 300, 185);
	 
	        //create large thumbnail
	        $largethumbnailpath = public_path('storage/profile_images/thumbnail/'.$largethumbnail);
	        $this->createThumbnail($largethumbnailpath, 550, 340);
	  
	        return response()->json(['smallthumbnailpath'=>$smallthumbnailpath,'status' => 200], 200);
	    }
	}

	public function createThumbnail($path, $width, $height)
	{
	    $img = Image::make($path)->resize($width, $height, function ($constraint) {
	        $constraint->aspectRatio();
	    });
	    $img->save($path);
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
