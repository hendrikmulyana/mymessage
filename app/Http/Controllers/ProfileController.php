<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($slug){

        $userData = DB::table('admin')
            ->leftJoin('profile','profile.admin_id','admin.id')
            ->where('slug', $slug)
            ->get();

        return view('profile.index',compact('userData'))->with('data', Auth::user()->profile);
    }

    public function changePhoto(){

        return view('profile.avatar',array('user'=> Auth::user()));
    }

    public function editProfile(){

        return view('profile.edit')->with('data', Auth::user()->profile);
    }

    public function updateProfile(Request $request){

       $admin_id = Auth::user()->id;
       DB::table('profile')->where('admin_id', $admin_id)->update($request->except('_token'));
       return back();
    }

    public function updateavatar(Request $request)
    {

        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time().'.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/image/avatar/'.$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('profile.avatar',array('user' => Auth::user()));
    }

    public function findFriends(){

            $aid = Auth::user()->id;
            $allUsers = DB::table('profile')->leftJoin('admin','admin.id', '=', 'profile.admin_id')->where('admin.id', '!=', $aid)->get();

            return view('profile.findfriend', compact('allUsers'));
    }

    public function sendRequest($id){

        Auth::user()->addFriend($id);
        return back();
    }

    public function requestRemove($id){

        DB::table('friendships')
            ->where('user_requested', Auth::user()->id)
            ->where('requester', $id)
            ->delete();

        return back()->with('msg','Request has been deleted');
    }

    public function friends(){

        $uid = Auth::user()->id;

        $friends1 = DB::table('friendships')
            ->leftJoin('admin','admin.id', 'friendships.user_requested')
            ->where('status',1)
            ->where('requester', $uid)
            ->get();

        $friends2 = DB::table('friendships')
            ->leftJoin('admin','admin.id', 'friendships.requester')
            ->where('status',1)
            ->where('user_requested', $uid)
            ->get();

        $friends = array_merge($friends1->toArray(),$friends2->toArray());

        return view('profile.friends', compact('friends', $friends));
    }

    public function request(){

        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
            ->rightJoin('admin','admin.id', '=', 'friendships.requester')
            ->where('status', 0)
            ->where('friendships.user_requested', '=', $uid)->get();
        return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($username, $id){

        $uid = Auth::user()->id;
        $checkRequest = Friendship::where('requester', $id)
            ->where('user_requested', $uid)
            ->first();

        if ($checkRequest){

            $updateFriends = DB::table('friendships')
                ->where('user_requested', $uid)
               ->where ('requester', $id)
               ->update(['status' => 1]);

            $notifications = new notifications;
            $notifications->user_hero = $id;
            $notifications->user_logged = Auth::user()->id;
            $notifications->status = '1';
            $notifications->note = 'accepted your friend request';
            $notifications->save();

           if ($notifications){

               return back()->with('msg','Now Friends with '.$username);
           }
        } else {

            return back()->with('msg','Now Friends with user');
        }

    }

    public function notifications($id){

        $uid = Auth::user()->id;
        $notes = DB::table('notifications')
            ->leftJoin('admin','admin.id','notifications.user_logged')
            ->where('notifications.id', $id)
            ->where('user_hero', $uid)
            ->orderBy('notifications.created_at','desc')
            ->get();

        $updateNoti = DB::table('notifications')
            ->where ('notifications.id', $id)
            ->update(['status' => 0]);

        return view('profile.notifications', compact('notes'));
    }

    public function unfriend($id){
        $loggedUser = Auth::user()->id;
        DB::table('friendships')
            ->where('requester', $loggedUser)
            ->where('user_requested', $id)
            ->delete();

        return back()->with('msg','You are not friend with this person');
    }

    public function sendMessage(Request $request){
        $conID = $request->conID;
        $msg = $request->msg;


        $checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
        if($checkUserId[0]->user_from== Auth::user()->id) {
            $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
                ->where('user_to', '!=', Auth::user()->id)
                ->get();
            $userTo = $fetch_userTo[0]->user_to;
        }else{
            $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
                ->get();
            $userTo = $fetch_userTo[0]->user_to;
        }
        $sendM = DB::table('messages')->insert([
            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'msg' => $msg,
            'status' => 1,
            'conversation_id' => $conID
        ]);
        if ($sendM){
            $userMsg = DB::table('messages')
                ->Join('admin','admin.id','messages.user_from')
                ->where('messages.conversation_id', $conID)->get();
            return $userMsg;
        }
    }

    public function newMessage(){
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
            ->leftJoin('admin', 'admin.id', 'friendships.user_requested')
            ->where('status', 1)
            ->where('requester', $uid)
            ->get();
        $friends2 = DB::table('friendships')
            ->leftJoin('admin', 'admin.id', 'friendships.requester')
            ->where('status', 1)
            ->where('user_requested', $uid)
            ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('newMessage', compact('friends', $friends));
    }
    public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
            ->where('user_two',$friend_id)->get();
        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
            ->where('user_one',$friend_id)->get();
        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());
        if(count($allCons)!=0){

            $conID_old = $allCons[0]->id;

            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_old,
                'status' => 1
            ]);
        }else {
            $conID_new = DB::table('conversation')->insertGetId([
                'user_one' => $myID,
                'user_two' => $friend_id
            ]);
            echo $conID_new;
            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_new,
                'status' => 1
            ]);
        }
    }

}
