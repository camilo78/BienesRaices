<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

use App\Property;
use App\Message;
use App\Gallery;
use App\Comment;
use App\Rating;
use App\Post;
use App\User;

use Carbon\Carbon;
use Auth;
use DB;

class PagesController extends Controller
{
    public function properties()
    {
        $settings   = Setting::latest()->get();
        $cities     = Property::select('city','city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')->paginate(12);

        return view('pages.properties.property', compact('settings','properties','cities'));
    }

    public function propertieshow($slug)
    {
        $property = Property::with('features','gallery','user','comments')
                            ->withCount('comments')
                            ->where('slug', $slug)
                            ->first();

        $rating = Rating::where('property_id',$property->id)->where('type','property')->avg('rating');
        //dd($rating);
        $settings   = Setting::latest()->get();
        $relatedproperty = Property::latest()
                    ->where('purpose', $property->purpose)
                    ->where('type', $property->type)
                    ->where('bedroom', $property->bedroom)
                    ->where('bathroom', $property->bathroom)
                    ->where('id', '!=' , $property->id)
                    ->take(5)->get();

        $videoembed = $this->convertYoutube($property->video, 560, 315);

        $cities = Property::select('city','city_slug')->distinct('city_slug')->get();

        return view('pages.properties.single', compact('property','rating','relatedproperty','videoembed','cities','settings'));
    }


    // AGENT PAGE
    public function agents()
    {
        $settings   = Setting::latest()->get();
        $agents = User::latest()->where('role_id', 2)->paginate(12);

        return view('pages.agents.index', compact('settings','agents'));
    }

    public function agentshow($id)
    {
        $settings   = Setting::latest()->get();
        $agent      = User::findOrFail($id);
        $properties = Property::latest()->where('agent_id', $id)->paginate(10);

        return view('pages.agents.single', compact('settings','agent','properties'));
    }


    // BLOG PAGE
    public function blog()
    {
        $settings   = Setting::latest()->get();
        $month      = request('month');
        $year       = request('year');

        $posts      = Post::latest()->withCount('comments')
                                ->when($month, function ($query, $month) {
                                    return $query->whereMonth('created_at', Carbon::parse($month)->month);
                                })
                                ->when($year, function ($query, $year) {
                                    return $query->whereYear('created_at', $year);
                                })
                                ->where('status',1)
                                ->paginate(5);

        return view('pages.blog.index', compact('settings','posts'));
    }

    public function blogshow($slug)
    {
        $post = Post::with('comments')->withCount('comments')->where('slug', $slug)->first();
        $settings   = Setting::latest()->get();
        $blogkey = 'blog-' . $post->id;

        if(!Session::has($blogkey)){
            $post->increment('view_count');
            Session::put($blogkey,1);
        }
        // get previous post id
        $previous   = Post::get()->where('id', '=', $post->id - 1)->first();

        // get next post id
        $next       = Post::get()->where('id', '=', $post->id + 1)->first();

        return view('pages.blog.single', compact('post','settings'))->with('previous', $previous)->with('next', $next);;
    }


    // BLOG COMMENT
    public function blogComments(Request $request, $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $post = Post::find($id);

        $post->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // BLOG CATEGORIES
    public function blogCategories()
    {
        $posts = Post::latest()->withCount(['comments','categories'])
                                ->whereHas('categories', function($query){
                                    $query->where('categories.slug', '=', request('slug'));
                                })
                                ->where('status',1)
                                ->paginate(10);
        $settings   = Setting::latest()->get();
        return view('pages.blog.index', compact('posts','settings'));
    }

    // BLOG TAGS
    public function blogTags()
    {
        $posts = Post::latest()->withCount('comments')
                                ->whereHas('tags', function($query){
                                    $query->where('tags.slug', '=', request('slug'));
                                })
                                ->where('status',1)
                                ->paginate(10);
        $settings   = Setting::latest()->get();
        return view('pages.blog.index', compact('posts','settings'));
    }

    // BLOG AUTHOR
    public function blogAuthor()
    {
        $posts = Post::latest()->withCount('comments')
                                ->whereHas('user', function($query){
                                    $query->where('username', '=', request('username'));
                                })
                                ->where('status',1)
                                ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }



    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    
    // CONATCT PAGE
    public function contact()
    {
        $settings   = Setting::latest()->get();
        return view('pages.contact', compact('settings'));
    }

    public function messageContact(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        $message  = $request->message;
        $mailfrom = $request->email;
        
        Message::create([
            'agent_id'  => 1,
            'name'      => $request->name,
            'email'     => $mailfrom,
            'phone'     => $request->phone,
            'message'   => $message
        ]);
            
        $adminname  = User::find(1)->name;
        $mailto     = $request->mailto;

        Mail::to($mailto)->send(new Contact($message,$adminname,$mailfrom));

        if($request->ajax()){
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }


    // GALLERY PAGE
    public function gallery()
    {
        $settings   = Setting::latest()->get();
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery',compact('settings','galleries'));
    }


    // PROPERTY COMMENT
    public function propertyComments(Request $request, $id)
    {
        $request->validate([
            'body'  => 'required'
        ]);

        $property = Property::find($id);

        $property->comments()->create(
            [
                'user_id'   => Auth::id(),
                'body'      => $request->body,
                'parent'    => $request->parent,
                'parent_id' => $request->parent_id
            ]
        );

        return back();
    }


    // PROPERTY RATING
    public function propertyRating(Request $request)
    {
        $rating      = $request->input('rating');
        $property_id = $request->input('property_id');
        $user_id     = $request->input('user_id');
        $type        = 'property';

        $rating = Rating::updateOrCreate(
            ['user_id' => $user_id, 'property_id' => $property_id, 'type' => $type],
            ['rating' => $rating]
        );

        if($request->ajax()){
            return response()->json(['rating' => $rating]);
        }
    }


    // PROPERTY CITIES
    public function propertyCities()
    {
        $cities     = Property::select('city','city_slug')->distinct('city_slug')->get();
        $properties = Property::latest()->with('rating')->withCount('comments')
                        ->where('city_slug', request('cityslug'))
                        ->paginate(12);
        $settings   = Setting::latest()->get();
        return view('pages.properties.property', compact('properties','cities','settings'));
    }


    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 250, $h = 140) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }
    
}
