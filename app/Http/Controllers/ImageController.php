<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageModel;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Str;
use File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allImages = ImageModel::orderBy('created_at', 'desc')->get();

        if(!$allImages->isEmpty()){

            $images = [];

            for($i = 0; $i<count($allImages); $i++){
                $temp = [
                    'id' => $allImages[$i]["id"],
                    'user_ip' => $allImages[$i]["user_ip"],
                    'image_path' => url('uploads/'.$allImages[$i]["image_path"]),
                ];
    
                array_push($images, $temp);
            }

            $data = [
                'status' => true,
                'data' => $images,
            ];

        }else{
            $data = [
                'status' => false,
                'message' => 'No images found',
            ];
        }

        return response($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ImageRequest $request)
    {
        
        $user_ip = $request->input('user_ip');

        $image_path = $request->file('image_path');
        $fileName = time().$image_path->getClientOriginalName();
        $fileName = Str::replace(' ', '_', $fileName);
        
        $image_path->move(public_path('uploads'), $fileName);
        
        $data = [
            'image_path' => $fileName,
            'image_extension' => $image_path->getClientMimeType(),
            'image_url' => url('uploads/'.$fileName),
            'user_ip' => $user_ip
        ];

        ImageModel::create($data);
            
        return response([
            "status"=>true, 
            "message"=>"Data inserted success",
            "data"=> $data 
        ], 200);

    }

    public function getImageByIp(string $ip)
    {
        $image = ImageModel::where('user_ip', $ip)->orderBy('created_at', 'desc')->get();

        if(!$image->isEmpty()){

            $data = [
                "status"=>true, 
                "data"=> $image 
            ];

        }else{
            $data = [
                "status"=>false, 
                "message"=> "No image found" 
            ];
        }

        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $get_image_path = ImageModel::where('id', $id)->get();

        if(!$get_image_path->isEmpty()){

            $image_path = "uploads/".$get_image_path[0]["image_path"];
            $del_image = ImageModel::where('id', $id)->delete();

            if(File::exists($image_path)) {
               File::delete($image_path);
            }

            $data = [
                "status"=>true, 
                "message"=> "Image deleted success" 
            ];

        }else{
            $data = [
                "status"=>false, 
                "message"=> "No Image found in this id" 
            ];
        }

        
        return response($data, 200); 
        
    }
}