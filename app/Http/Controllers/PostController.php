<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    public function posts(){
        $posts= Post::with('category','user')->get();
        return response()->json([
            'posts' => $posts
        ],200);        
    }

    public function store(Request $request){
        
        $exp1= explode(";",$request->photo);
        $exp2= explode('/', $exp1[0]);
        $ext= $exp2[1];
        $imageName= time().'.'.$ext;
        
        $img = Image::make($request->photo)->resize(800, 600);
        $img->save(public_path('uploads/images/').$imageName);

        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'category'  => 'required',
            'photo'     => 'required'
        ]);

        $post= new Post;
        $post->title    = $request->title;
        $post->body    = $request->body;
        $post->category_id    = $request->category;
        $post->user_id    = auth()->id();
        $post->photo    = $imageName;
        $post->save();

        return ['status' => 200];
    }

    public function delete($id){
        $post= Post::find($id);
        $imagepath= public_path('uploads/images/').$post->photo;
        if(file_exists($imagepath)){
            unlink($imagepath);
        }

        $post->delete();

        return ['status' => 200];
    }

    public function post($id){
        $post= Post::find($id);
        return response()->json([
            'post' => $post
        ],200);
    }

    public function update(Request $request, $id){
        $post= Post::find($id);
        $imageName= $post->photo;
        if($request->photo != $post->photo){

            $imagepath= public_path('uploads/images/').$post->photo;
            if(file_exists($imagepath)){
                unlink($imagepath);
            }

            $exp1= explode(";",$request->photo);
            $exp2= explode('/', $exp1[0]);
            $ext= $exp2[1];
            $imageName= time().'.'.$ext;
            
            $img = Image::make($request->photo)->resize(800, 600);
            $img->save(public_path('uploads/images/').$imageName);
        }  


        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'category_id'  => 'required'
        ]);

        
        $post->title    = $request->title;
        $post->body    = $request->body;
        $post->category_id    = $request->category_id;
        $post->user_id    = auth()->id();
        $post->photo    = $imageName;
        $post->save();

        return ['status' => 200];
    }
}
