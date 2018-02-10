<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
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
        'sort' =>'in:title,created_at',
        'order' =>'in:asc,desc'
        ]);
        if ($request->query('sort') && $request->query('order')) {
            $genres = Genre::orderBy($request->query('sort'), $request->query('order'))->paginate(10);
            $order = ($request->query('order') == 'asc') ? 'desc' : 'asc';
        } else {
            $genres = Genre::paginate(10);
            $order = 'asc';
        }
        return view('genre.index')->with('genres', $genres)->with('order', $order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['admin']);
        return view('genre.create');
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
        'title' => 'required',
      ]);
        $genre = new Genre;
        $genre->title = $genre->input('title');
        $genre->save();

        return redirect('/genre/'.$genre->id)->with('success', 'Genre created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        return view('genre.show')->with('genre', $genre);
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
        $genre = Genre::find($id);
        return view('genre.edit')->with('genre', $genre);
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
        $genre = Genre::find($id);
        $genre->title = $request->input('title');
        $genre->save();

        return redirect('/genre/'.$genre->id)->with('success', 'Genre updated');
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
        $genre = Genre::find($id);
        $genre->delete();
        return redirect('/genre')->with('success', 'Genre deleted');
    }
}
