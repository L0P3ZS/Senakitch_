<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.comments.index')->only('index');
        $this->middleware('can:admin.comments.store')->only('store');
        $this->middleware('can:admin.comments.update')->only('update');
        $this->middleware('can:admin.comments.destroy')->only('destroy');
    }
    public function index()
    {
        $comments = Comment::all();
        return view('admin.cruds.comments',compact('comments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description'=> 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id; // Recuperar el ID del usuario autenticado
        Comment::create($data);
        return redirect()->route('admin.comments.index');

        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
           return redirect()->route('admin.comments.index');
        //  return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
    
}
