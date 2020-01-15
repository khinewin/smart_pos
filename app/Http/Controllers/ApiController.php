<?php

namespace App\Http\Controllers;

use App\Category;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    public function newCategory(Request $request){
        $v=Validator::make($request->all(),[
            'category_name'=>'required|unique:categories'
        ]);
        if($v->fails()){
            return response()->json($v->errors());
        }else{
            /*
            $c=new Category();
            $c->category_name=$request['category_name'];
            $c->save();
            */
            Category::created(['category_name'=>$request['category_name']]);

            return response()->json(['message'=>"The category have been created."]);
        }
    }
    public function getPostOne($id){
        $post=Post::whereId($id)->first();
        if($post){
            return response()->json($post);
        }else{
            return response()->json(['error'=>'The post you request was not found.']);
        }

    }
    public function getPosts(){
        $posts=Post::
        with('category')
            ->with('user')
            ->with('postimage')

        ->paginate("2");
        return response()->json($posts);
    }
    public function getCategory(){
        $cats=Category::get();
        return response()->json($cats);
    }
}
