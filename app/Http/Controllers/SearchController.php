<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\Author;
use App\Genre;

class SearchController extends Controller
{
    /**
     * Show the search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search')->with('type', "");
    }

    /**
     * Show the search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->validate($request, [
          'query' =>'sometimes|required',
          'type' =>'required_with:query|in:catalog,author,genre'
        ]);
        $query = $request->input('query');
        $type = $request->input('type');
        if ($type=="catalog") {
            $result = Catalog::where('title', 'like', '%'.$query.'%')->paginate(10);
        }
        if ($type=="author") {
            $result = Author::where('name', 'like', '%'.$query.'%')->paginate(10);
        }
        if ($type=="genre") {
            $result = Genre::where('title', 'like', '%'.$query.'%')->paginate(10);
        }
        $request->flash();
        return view('search')->with('result', $result)->with('type', $type);
    }
}
