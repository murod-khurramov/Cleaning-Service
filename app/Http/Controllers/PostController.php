<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Mail\PostCreated as MailPostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Notifications\PostCreated as NotificationPostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\table;

class PostController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth')->except(['index', 'show']);
//    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $posts = Post::latest()->paginate(9);
        return view('posts.index')->with('posts', $posts);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
//        return view('posts.create')->with([
//            'categories', Category::all(),
//            'tags' => Tag::all(),
//        ]);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('photo')) {
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name); // post-photos/photo.jpg
        }

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => $path ?? null,
        ]);

        if (isset($request->tags)){
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);

//        UploadBigFile::dispatch($request->file('photo'));

        ChangePost::dispatch($post)->onQueue('uploading');

        Mail::to($request->user())->later(now()->addSeconds(10), (new MailPostCreated($post))->onQueue('sending-mails'));

        Notification::send(auth()->user(), new NotificationPostCreated($post));

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function edit(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        Gate::authorize('update', $post);

        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(StorePostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('update', $post);

        if ($request->hasFile('photo')) {

            if(isset($post->photo)){
                Storage::delete($post->photo);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name); // post-photos/photo.jpg
        }

        $post->update([
            'title' => $request->input('title'),
            'short_content' => $request->input('short_content'),
            'content' => $request->input('content'),
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
