<?php
//
use Illuminate\Support\Facades\Route;
//
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('admin.blog');

//|------------------------------------------------------------------------
Route::get('/', function(){
    $posts=\App\Post::latest('created_at')->paginate(5);
    return view('index', ['params'=>$posts]);
})->name('index.blog');

Route::get('/single-post-{id?}', function(\App\Post $id){
    // //Вариант 1. Счетчик просмотров поста, с методом save()
    // $id->saw+=1;
    // $id->save();
    // //Вариант 2. Счетчик просмотров поста, с методом increment() (без метода save())
    $id->increment('saw');
    return view('pages.single-post', ['post'=>$id]);
})->name('single-post.blog');

Route::get('/category-{id?}', function(\App\Category $id){

    $categ = \App\Post::where('category_id', $id->id)
            ->latest('created_at')
            ->paginate(5);

    return view('index', ['params'=>$categ]);
})->name('category.blog');

Route::get('/tag-{id?}', function(\App\Tag $id){

    $posts_po_tag=$id->post->toArray();

    // // Вариант не работает. Разница формата дат по сравнению с вариантом использования моделью. Или что-то еще мешает.
    // $tag = DB::table('posts')
    // ->whereIn('id', $posts_po_tag)
    // ->latest('created_at')
    // ->paginate(5);

    // // Вариант работает отлично. Позволяет в полной мере реализовывать связи таблиц БД по внешним ключам.
    $tag = \App\Post::whereIn('id', $posts_po_tag)
            ->latest('created_at')
            ->paginate(5);

    // $tag = \App\Post::whereIn('id', $posts_po_tag)
    //         ->latest('created_at')
    //         ->get();

    return view('index', ['params'=>$tag]);
})->name('tag.blog');

Route::get('/archive-blog', function(){
    $posts=\App\Post::latest('created_at')->paginate(5);
    return view('pages.archive_blog', ['params'=>$posts]);
})->name('archive.blog');

Route::get('/autor-{id?}', function(\App\User $id){

    $auth=\App\Post::where('user_id',$id->id)
        ->latest('created_at')
        ->paginate(5);

    return view('index', ['params'=>$auth]);
})->name('autor.blog');

Route::get('/about-us', function(){
    return view('pages.about_us');
})->name('about-us.blog');

Route::get('/contact', function(){
    return view('pages.contact');
})->name('contact.blog');

Route::get('/typography', function(){
    return view('pages.typography');
})->name('typography.blog');

Route::get('/laravel', function(){
    return view('trash.welcome');
})->name('welcome.laravel');
//|------------------------------------------------------------------------
//|------------------------------------------------------------------------
//|------------------------------------------------------------------------
Route::get('/test', function(){
        // $tagies=[];
        // foreach(\App\Post::all() as $post_id){
        //     $limits=rand(3,6);
        //     $tagis=DB::table('tags')->inRandomOrder()->limit($limits)->get();

        //     foreach($tagis as $tag_id){
        //         $tagies[]=['post_id'=>$post_id->id, 'tag_id'=>$tag_id->id, 'created_at'=>date('Y-m-d h:i:s'), 'updated_at'=>date('Y-m-d h:i:s')];
        //     }
        // };
        
        // // echo '<pre>$tagies= ';
        // // print_r($tagies);
        // // echo '<br>';
        // // echo '</pre>';

        // foreach(\App\Post::all() as $post_id){
        //     $limit=rand(3,6);
        //     $tagsId=\App\Tag::inRandomOrder()->limit($limit)->get();

        //     foreach($tagsId as $tag_id){
        //         $postTags[]=['post_id'=>$post_id->id, 'tag_id'=>$tag_id->id, 'created_at'=>date('Y-m-d h:i:s'), 'updated_at'=>date('Y-m-d h:i:s')];
        //     }
        // }
        // // //DB::table('post_tag')->insert($postTags);

        // // echo '<pre>$postTags= ';
        // // print_r($postTags);
        // // echo '<br>';
        // // echo '</pre>';

        // $user = tap(\App\Post::all()->toArray(), function ($user) {
        //     //$user->id;
        // });
        // echo '<pre>$pold= ';
        // print_r(\App\Post::paginate(5)->toArray());
        // echo '<br>';
        // echo '</pre>';
});

Route::get('/n', function(){

    $taga = DB::table('posts')->get();
    $tagy = \App\Post::get();

    // $usera = DB::table('posts')
    //             ->orderBy('tag_id', 'desc')
    //             ->get();

    // $usera = DB::table('post_tag')
    //         ->where('tag_id', 1)
    //         ->get()
    //         ->sortBy('tag_id', 'desc');

    $usera = DB::table('post_tag')
            ->where('tag_id', 1)
            ->latest('created_at')
            ->paginate(5);


    return view('trash.n', [
        'taga'=>$taga,
        'tagy'=>$tagy,
        'usera'=>$usera,
    ]);
});

Route::get('/mir{tag_po_id?}', function(\App\Tag $tag_po_id){

    $tyga=$tag_po_id;
    // $taga = DB::table('posts')->get();
    // $tagy = \App\Post::get();

    //Формируем по связи массив из IP-адресов всех постов, которые соответствуют нашему тегу по его IP-адресу
    $posts_po_tag=$tag_po_id->post->toArray();

    // Вариант 1 (работает)
    $usera = \App\Post::whereIn('id', $posts_po_tag)
        ->latest('created_at')
        ->paginate(5);

    // // Вариант 2 (не работает)
    // $usera = DB::table('posts')
    // ->whereIn('id', $posts_po_tag)
    // ->latest('created_at')
    // ->paginate(5);

    // //------Варианты для учебы---------
    // $usera = DB::table('posts')
    //     //->select()
    //     ->where('id', '<', 10)
    //     ->latest('created_at')
    //     ->get();

    // $usera = DB::table('posts')
    //         ->orderBy('id', 'desc')
    //         ->paginate(5);

    // $usera = DB::table('posts')
    //             ->orderBy('id', 'desc')
    //             ->get();


    // $usera = DB::table('post_tag')
    //         ->where('tag_id', 1)
    //         ->get()
    //         ->sortBy('tag_id', 'desc');

    // $usera = DB::table('post_tag')
    //         ->where('tag_id', 1)
    //         ->latest('created_at')
    //         ->paginate(5);
    // //---------------------------------

    return view('trash.mir', [
        //'tyga'=>$tyga,
        //'tagy'=>$tagy,
        //'tag_post'=>$tag_post,
        'posts_po_tag'=>$posts_po_tag,
        'usera'=>$usera,
    ]);
});
//|------------------------------------------------------------------------
//|------------------------------------------------------------------------
//|------------------------------------------------------------------------
Route::get('/pagin', function(\App\Tag $id){

    // $posts_po_tag=$id->post->toArray();

    // // $tag = DB::table('posts')
    // // ->whereIn('id', $posts_po_tag)
    // // ->latest('created_at')
    // // ->paginate(5);

    // $tag = \App\Post::whereIn('id', $posts_po_tag)
    //         ->latest('created_at')
    //         ->paginate(5);

    // return view('index', ['params'=>$tag]);

    $modelPostPagin=\App\Post::paginate();
    $fasadDB= DB::table('posts')->get();
    $modelPost=\App\Post::get();

    //return '$fasadDB= <br><pre>'.$fasadDB.'</pre><br><br>$modelPost= <br><pre>'. $modelPost.'</pre><br>';
    return view('trash.pagin', [
        'modelPostPagin'=>$modelPostPagin,
        'fasadDB'=>$fasadDB,
        'modelPost'=>$modelPost,
    ]);
});

Route::get('/min', function(){

    // текущий каталог
    //echo getcwd() . "\n";

    // chdir('cvs');

    // // текущий каталог
    // echo getcwd() . "\n";

    // Результат выполнения
    //    /home/didou
    //    /home/didou/cvs

    //E:\openserver\openserver\domains\hillel\less22dz17\public\matrix-admin\html\ltr\index.html
    // return view('index', ['params'=>$posts]);
    // header('Location: \public\matrix-admin\html\ltr\index.html');\public\matrix-admin\html\ltr\index.html
    // header('Location: ../public/matrix-admin/html/ltr/index.html');


// $host  = $_SERVER['HTTP_HOST'];
// $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
// $extra = 'mypage.php';
//header("Location: http://less22dz17/public/matrix-admin/html/ltr/index.html");

$host=$_SERVER['DOCUMENT_ROOT'];//"E:/OpenServer/OpenServer/domains/hillel/less22dz17/public
$uri=$_SERVER['SCRIPT_FILENAME'];//E:/OpenServer/OpenServer/domains/hillel/less22dz17/public/index.php

    //dd($_SERVER['SCRIPT_NAME']);
    //dd(__DIR__);
    //header("Location: http://less21dz16/");


                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, "../public/matrix-admin/html/ltr/index.html");
                // curl_setopt($ch, CURLOPT_HEADER, 0);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $output = curl_exec($ch);
                // curl_close($ch);
                // return view('trash.admin',['content'=>$output]);





    ob_start();
    //require '../public/matrix-admin/html/ltr/index.html';
    require '../public/matrix-admin/mir.php';
    $content=ob_get_clean();
    require '../public/matrix-admin/admin.php';

    //return view('trash.admin',['content'=>$content]);
    //require '../public/matrix-admin/html/ltr/index.html';
});