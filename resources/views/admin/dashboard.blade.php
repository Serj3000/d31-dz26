@extends('adminlte::page')

@section('title', 'hillel-31 AdminTLE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

        <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">93,139</span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->

        <!-- Apply any bg-* class to to the info-box to color it -->
        <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">41,410</span>
            <!-- The progress section is optional -->
            <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
            70% Increase in 30 Days
            </span>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->

    <table width="100%">
        <tr>
            <th>id</th>
            <th>Название Поста (Post)</th>
            <th>Категория</th>
            <th>Автор поста</th>
            <th>Дата создания</th>
        </tr>
        @foreach(\App\Post::latest('created_at')->paginate(5) as $post)
        <tr>
            <td width="5%">{{$post->id}}</td>
            <td width="45%">{{$post->title}}</td>
            <td width="20%">{{$post->category->name}}</td>
            <td widht="25%">{{$post->user->name}}</td>
            <td widht="15%">{{$post->created_at}}</td>
        </tr>
        @endforeach
    </table>
    {{view('layouts.paginate', ['params'=>\App\Post::latest('created_at')->paginate(5)])}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop