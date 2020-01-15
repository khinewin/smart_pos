<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use App\Postimage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function updatePost(Request $request){
        $id=$request['id'];
        $post=Post::whereId($id)->firstOrFail();
        $post->item_name=$request['item_name'];
        $post->price=$request['price'];
        $post->category_id=$request['category'];
        $post->dsc=$request['description'];
        $post->update();

        $img=$request->file('image');
        if($img){
            foreach ($img as $i){
                $img_name=date("dmyhis")."-".$i->getClientOriginalName();
                $pi=new Postimage();
                $pi->post_id=$id;
                $pi->image=$img_name;
                $pi->save();
                Storage::disk('post_image')->put($img_name, File::get($i));

            }
        }

        return redirect()->route('posts');
    }
    public function getDeletePostImage($id){
        $img=Postimage::whereId($id)->firstOrFail();
        Storage::disk('post_image')->delete($img->image);
        $img->delete();
        return redirect()->back();
    }
    public function getEditPost($id){
        $post=Post::whereId($id)->firstOrFail();
        $cats=Category::get();
        return view ('backend.posts.edit')->with(['cats'=>$cats,'post'=>$post]);
    }
    public function getDeletePost($id){
        $post=Post::whereId($id)->firstOrFail();
        $post->delete();

        $images=Postimage::where('post_id', $id)->get();
        foreach ($images as $img){
            $img->delete();
        }
        return redirect()->back()->with('info', 'The selected post have been deleted.');
    }
    public function getPostImage($img_name){
        $file=Storage::disk('post_image')->get($img_name);
        return response($file);
    }
    public function allPosts(){
        $posts=Post::OrderBy('id','desc')->paginate("10");
        return view('backend.posts.all-post')->with(['posts'=>$posts]);
    }

    public function postNewPost(Request $request){
        $this->validate($request,[
           'image'=>'required',
           'item_name'=>'required',
           'price'=>'required',
           'description'=>'required',
           'category'=>'required'
        ]);
        $post=new Post();
        $post->item_name=$request['item_name'];
        $post->price=$request['price'];
        $post->dsc=$request['description'];
        $post->category_id=$request['category'];
        $post->user_id=Auth::User()->id;
        $post->save();

        $imgs=$request->file('image');
        foreach ($imgs as $img){
            $img_name=date("dmyhis")."-".$img->getClientOriginalName();
            $pi=new Postimage();
            $pi->post_id=$post->id;
            $pi->image=$img_name;
            $pi->save();
            Storage::disk('post_image')->put($img_name, File::get($img));

        }
        return redirect()->back()->with('info', 'The new post have been created.');

    }
    public function getNewPost(){
        $cats=Category::get();
        return view ('backend.posts.new-post')->with(['cats'=>$cats]);
    }

    public function getCategories(){
        $cats=Category::paginate("10");
        return view ("backend.posts.categories")->with(['cats'=>$cats]);
    }
    public function newCategory(Request $request){
        $this->validate($request,[
           'category_name'=>'required|unique:categories'
        ]);
        $c=new Category();
        $c->category_name=$request['category_name'];
        $c->save();
        return redirect()->back()->with('info', 'The category have been created.');
    }
    public function removeCategory($id){
        $cat=Category::whereId($id)->firstOrFail();
        $cat->delete();
        return redirect()->route('categories')->with('info', 'The selected category have been deleted.');
    }
    public function updateCategory(Request $request){
        $id=$request['id'];
        $cat=Category::whereId($id)->firstOrFail();
        $cat->category_name=$request['category_name'];
        $cat->update();
        return redirect()->back()->with("info", "The selected category have been updated.");
    }
}
