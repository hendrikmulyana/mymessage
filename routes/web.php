<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::group(['middleware'=>['web']],function (){

Route::get('/', function () {
    $posts = DB::table('posts')
        ->leftJoin('profile','profile.admin_id','posts.user_id')
        ->leftJoin('admin','admin.id','posts.user_id')
        ->get();
    return view('welcome', compact('posts'));
    });

Route::post('sendMessage','ProfileController@sendMessage');

Route::get('newMessage','ProfileController@newMessage');

Route::post('sendNewMessage', 'ProfileController@sendNewMessage');

    Route::get('message', function () {
        return view('message');
    });

    Route::get('/getMessages', function () {
        $allUsers1 = DB::table('admin')
            ->Join('conversation','admin.id','conversation.user_one')
            ->where('conversation.user_two', Auth::user()->id)->get();

        $allUsers2 = DB::table('admin')
            ->Join('conversation','admin.id','conversation.user_two')
            ->where('conversation.user_one', Auth::user()->id)->get();

        return array_merge($allUsers1->toArray(), $allUsers2->toArray());
    });

    Route::get('/getMessages/{id}', function ($id) {
        /*$checkCon = DB::table('conversation')->where('user_one', Auth::user()->id)
            ->where('user_two', $id)->get();
        if (count($checkCon)!=0){
           // echo $checkCon[0]->id;
            $userMsg =DB::table('messages')->where('messages.conversation_id', $checkCon[0]->id)->get();
            return $userMsg;
        }else{
            echo "no messages";
        }*/
        $userMsg = DB::table('messages')
            ->Join('admin','admin.id','messages.user_from')
            ->where('messages.conversation_id', $id)->get();
        return $userMsg;
    });

    Route::get('/beranda', function () {
        /*  $posts =  DB::table('users')
  ->rightJoin('profiles', 'profiles.user_id','admin.id')
  ->rightJoin('posts', 'posts.user_id' , 'admin.id')
  ->orderBy('posts.created_at', 'desc')
  ->get();
  return view('beranda', compact('posts'));
  */
        $posts = App\Post::with('user')->orderBy('created_at','DESC')->get();
        return view('beranda', compact('posts'));
    });

    Route::get('/posts', function () {
         $posts_json = DB::table('posts')
          ->rightJoin('profile', 'profile.admin_id','admin.id')
          ->rightJoin('posts',  'posts.user_id' , 'admin.id')
          ->orderBy('posts.created_at', 'desc')->take(2)
          ->get();
              return $posts_json;
    });

    Route::get('/likes',function(){
        return App\Likes::all();
    });

    Route::get('beranda',function(){
        $likes = App\Likes::all();
        return view('beranda', compact('likes'));
    });

    Route::get('/deletePost/{id}','PostsController@deletePost');

    Route::get('/likePost/{id}','PostsController@likePost');

Route::group(['midleware' => 'auth'],function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('profile/{slug}','ProfileController@index');

    Route::get('changePhoto','ProfileController@changePhoto');

    Route::post('updateavatar','ProfileController@updateavatar');

    Route::get('editProfile/{slug}','ProfileController@editProfile');

    Route::post('updateProfile','ProfileController@updateProfile');

    Route::get('findFriend/{slug}','ProfileController@findFriends');

    Route::get('addFriend/{id}','ProfileController@sendRequest');

    Route::get('request/{slug}','ProfileController@request');

    Route::get('accept/{username}/{id}','ProfileController@accept');

    Route::get('friends/{slug}','ProfileController@friends');

    Route::get('requestRemove/{id}','ProfileController@requestRemove');

    Route::get('notifications/{id}','ProfileController@notifications');

    Route::get('unfriend/{id}','ProfileController@unfriend');

});

Route::post('addPost', 'PostsController@addPost');

Route::get('posts', 'HomeController@index');

Route::get('/register', 'RegisterController@index');

Route::resource('admin','AdminController');

Route::resource('client','ClientController');

Auth::routes();

});
