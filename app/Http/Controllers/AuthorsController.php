<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('authors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Image $image)
    {
         //image upload
        if(Input::hasFile('image'))
        {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(260, 346);
            $image_resize->save(public_path('img/authors/' .$filename));
        };

        Author::create([
            'name' => ucfirst(request('name')),
            'last_name' => ucfirst(request('last_name')),
            'birthday' => Carbon::parse(request('birthday')),
            'birthday_place' => request('birthday_place'),
            'occupation' => request('occupation'),
            'nationality' => request('nationality'),
            'photo' => '/img/authors/'. $filename,
            'favorite' => request('favorite'),
            'wiki' => request('wiki'),
            'desc' => request('desc')
        ]);




        flash('<i class="fa fa-comment-o" aria-hidden="true"></i> Author Added!')->success();
        return redirect('/authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $related_books = $author->books;
        return view('authors.show', compact('author','related_books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
         return view('authors.edit',compact('author','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        $author->name = $request->get('name');
        $author->last_name = $request->get('last_name');
        $author->birthday = $request->get('birthday');
        $author->birthday_place = $request->get('birthday_place');
        $author->occupation = $request->get('occupation');
        $author->nationality = $request->get('nationality');
        $author->photo = $request->get('photo');
        $author->desc = $request->get('desc');
        $author->save();
        flash('<i class="fa fa-comment-o" aria-hidden="true"></i> Changes Saved!')->success();

        // return view('authors.show', ['author' => Author::find($id), 'related_books'=> $author->books]);
        return redirect()->route('authors.show',[$author]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        flash('<i class="fa fa-comment-o" aria-hidden="true"></i> Successfully Removed!')->success();
        return redirect('/authors');
    }


}
