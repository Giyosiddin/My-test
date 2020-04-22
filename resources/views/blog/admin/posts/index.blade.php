@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-primary">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <h2>Post index</h2>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Автор</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Заголовок</th>
                                <th scope="col">Дата публикации</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($paginator as $item)
                                <tr @if(!$item->published_at) style="background: #ccc;" @endif>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->category->title}}</td>
                                    <td><a href="{{ route('blog.admin.posts.edit', [$item->id]) }}">{{$item->title}}</a></td>
                                    <td>{{$item->published_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{$paginator->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection