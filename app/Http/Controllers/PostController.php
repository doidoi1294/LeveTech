<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
        //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    // 投稿作成画面
    public function store(Post $post, PostRequest $request){
        // リクエストパラメータの取得
        $input = $request['post'];
        // Postインスタンスのプロパティの値を保存する処理
        $post->fill($input)->save();
        // リダイレクト
        return redirect('/posts/'.$post->id);
    }
    // 編集画面(idの値の受け渡し)
    public function edit(Post $post){
        return view('posts.edit')->with(['post' => $post]);
    }
    // 編集画面(投稿作成画面と同様の処理)
    public function update(PostRequest $request, Post $post){
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    // 削除処理
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
}
?>