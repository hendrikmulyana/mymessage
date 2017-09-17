<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->get();
        return view('posts',compact('posts'));
    }

    public function addPost(Request $request){
        echo $content = $request->content;
        $createPost = DB::table('posts')
            ->insert(['content' =>$content, 'user_id' => Auth::user()->id,
                'status' =>0, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);
        if($createPost){
            $posts_json = DB::table('admin')
                ->rightJoin('profile', 'profile.admin_id','admin.id')
                ->rightJoin('posts',  'posts.user_id' , 'admin.id')
                ->orderBy('posts.id', 'desc')
                ->get();
            return $posts_json;
        }
    }
    public function deletePost($id){
        $deletePost = DB::table('posts')->where('id',$id)->delete();
        if($deletePost){
            $posts_json = DB::table('admin')
                ->rightJoin('profiles', 'profiles.user_id','admin.id')
                ->rightJoin('posts',  'posts.user_id' , 'admin.id')
                ->orderBy('posts.id', 'desc')
                ->get();
            return $posts_json;
        }
    }
}
