<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Catalog;
use App\Author;
use App\Genre;
use App\Borrow;
use Auth;

class CatalogController extends Controller
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
            $catalog = Catalog::orderBy($request->query('sort'), $request->query('order'))->paginate(10);
            $order = ($request->query('order') == 'asc') ? 'desc' : 'asc';
        } else {
            $catalog = Catalog::paginate(10);
            $order = 'asc';
        }
        return view('catalog.index')->with('catalogitems', $catalog)->with('order', $order);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::User()->authorizeRoles(['admin']);
        $allAuthors = Author::all();
        $allGenres = Genre::all();
        return view('catalog.create')->with('allAuthors', $allAuthors)->with('allGenres', $allGenres);
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
          'title' =>'required',
          'description' =>'required',
          'isbn' =>'required',
          'quantity' =>'required',
          'price' =>'required',
          'author' =>'required',
          'genre' =>'required',
          'image' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('catalog_images', 's3');
        } else {
            $path = 'catalog_images/noimage.jpg';
        }

        $item = new Catalog;
        $item->title=$request->input('title');
        $item->description=$request->input('description');
        $item->isbn=$request->input('isbn');
        $item->quantity=$request->input('quantity');
        $item->price=$request->input('price');
        $item->authorId=$request->input('author');
        $item->genreId=$request->input('genre');
        $item->image=$path;
        $item->save();

        return redirect('/catalog/'.$item->id)->with('success', 'Item created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Catalog::find($id);
        $quantity = $item->quantity-Borrow::where('catalogId', $item->id)->whereNull('returned_on')->count();
        return view('catalog.show')->with('item', $item)->with('quantity', $quantity);
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
        $item = Catalog::find($id);
        $allAuthors = Author::all();
        $allGenres = Genre::all();
        return view('catalog.edit')->with('item', $item)->with('allAuthors', $allAuthors)->with('allGenres', $allGenres);
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
          'title' =>'required',
          'description' =>'required',
          'isbn' =>'required',
          'quantity' =>'required',
          'price' =>'required',
          'author' =>'required',
          'genre' =>'required',
          'image' =>'image|nullable|max:1999'
        ]);

        $item = Catalog::find($id);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('catalog_images', 's3');
            if ($item->image != 'catalog_images/noimage.jpg') {
                Storage::disk('s3')->delete($item->image);
            }
            $item->image=$path;
        }
        $item->title=$request->input('title');
        $item->description=$request->input('description');
        $item->isbn=$request->input('isbn');
        $item->quantity=$request->input('quantity');
        $item->price=$request->input('price');
        $item->authorId=$request->input('author');
        $item->genreId=$request->input('genre');
        $item->save();
        return redirect('/catalog/'.$id)->with('success', 'Item updated');
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
        $item = Catalog::find($id);
        if ($item->image != 'catalog_images/noimage.jpg') {
            Storage::disk('s3')->delete($item->image);
        }
        $item->delete();
        return redirect('/catalog')->with('success', 'Item deleted');
    }
}
