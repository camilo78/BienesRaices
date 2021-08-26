<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Comment;
use App\Message;
use App\User;
use Auth;
use Hash;
use Toastr;
use App\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $settings   = Setting::latest()->get();
        $comments = Comment::latest()
                           ->with('commentable')
                           ->where('user_id',Auth::id())
                           ->paginate(10);

        $commentcount = Comment::where('user_id',Auth::id())->count();

        return view('user.dashboard',compact('comments','commentcount','settings'));
    }

    public function profile()
    {
        $profile = Auth::user();
        $settings   = Setting::latest()->get();
        return view('user.profile',compact('profile','settings'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'about'     => 'max:250'
        ]);

        $user = User::find(Auth::id());

        $image = $request->file('image');
        $slug  = str_slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-user-'.Auth::id().'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('users')){
                Storage::disk('public')->makeDirectory('users');
            }
            if(Storage::disk('public')->exists('users/'.$user->image) && $user->image != 'default.png' ){
                Storage::disk('public')->delete('users/'.$user->image);
            }
            $userimage = Image::make($image)->stream();
            Storage::disk('public')->put('users/'.$imagename, $userimage);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imagename;
        $user->about = $request->about;

        $user->save();

        return back();
    }


    public function changePassword()
    {
        $settings   = Setting::latest()->get();
        return view('user.changepassword',compact('settings'));

    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            Toastr::error('message', 'Your current password does not matches with the password you provided! Please try again.');
            return redirect()->back();
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){

            Toastr::error('message', 'New Password cannot be same as your current password! Please choose a different password.');
            return redirect()->back();
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Toastr::success('message', 'Password changed successfully.');
        return redirect()->back();
    }


    // MESSAGE
    public function message()
    {
        $settings   = Setting::latest()->get();
        $messages = Message::latest()->where('agent_id', Auth::id())->paginate(10);

        return view('user.messages.index',compact('messages','settings'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);
        $settings   = Setting::latest()->get();
        return view('user.messages.read',compact('message','settings'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);
        $settings   = Setting::latest()->get();
        return view('user.messages.replay',compact('message','settings'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'user_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        Toastr::success('message', 'Message send successfully.');
        return back();

    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->messageid;

        if($status){
            $status = 0;
        }else{
            $status = 1;
        }
        $settings   = Setting::latest()->get();
        $message = Message::findOrFail($msgid);
        $message->status = $status;
        $message->save();

        return redirect()->route('user.message',compact('settings'));
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }

}
