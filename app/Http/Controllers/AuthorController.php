<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use Auth;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function index(Request $request)
    {
        $this->validate($request, [
          'sort' =>'in:name,created_at',
          'order' =>'in:asc,desc'
        ]);
        if ($request->query('sort') && $request->query('order')) {
            $authors = Author::orderBy($request->query('sort'), $request->query('order'))->paginate(10);
            $order = ($request->query('order') == 'asc') ? 'desc' : 'asc';
        } else {
            $authors = Author::paginate(10);
            $order = 'asc';
        }
        return view('author.index')->with('authors', $authors)->with('order', $order);
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['admin']);
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::User()->authorizeRoles(['admin']);
        $this->validate($request, [
        'name' => 'required',
        'dob' => 'date|nullable',
        'bio' => 'string|nullable',
        'image' => 'image|nullable|max:1999'
      ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('author_images', 's3');
        } else {
            $path = 'author_images/noimage.jpg';
        }
        $author = new Author;
        $author->name = $request->input('name');
        $author->dob = $request->input('dob');
        $author->bio = $request->input('bio');
        $author->image = $path;
        $author->save();
        return redirect('/author/'.$author->id)->with('success', 'Author created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        return view('author.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::User()->authorizeRoles(['admin']);
        $author = Author::find($id);
        return view('author.edit')->with('author', $author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Auth::User()->authorizeRoles(['admin']);
        $this->validate($request, [
        'name' => 'required',
        'dob' => 'date|nullable',
        'bio' => 'string|nullable',
        'image' => 'image|nullable|max:1999'
        ]);
        $author = Author::find($id);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('author_images', 's3');
            if ($author->image != 'author_images/noimage.jpg') {
                Storage::disk('s3')->delete($author->image);
            }
            $author->image=$path;
        }
        $author->name = $request->input('name');
        $author->dob = $request->input('dob');
        $author->bio = $request->input('bio');
        $author->save();
        return redirect('/author/'.$author->id)->with('success', 'Author updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::User()->authorizeRoles(['admin']);
        $author = Author::find($id);
        if ($author->image != 'author_images/noimage.jpg') {
            Storage::disk('s3')->delete($author->image);
        }
        $author->delete();
        return redirect('/author')->with('success', 'Author deleted');
    }
}
