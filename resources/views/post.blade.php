@extends('layouts.blog-post')

@section('content')
@section('blog-post')

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{$post->photo->file ? $post->photo->file : 'http://placehold.it/900x300'}}"
             alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">{{$post->title}}</p>
        <p>{{$post->body}}</p>

        <hr>

    @if(Session::has('comment_message'))
        {{session('comment_message')}}
    @endif

    <!-- Blog Comments -->
    @if(Auth::check())
        <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}

                <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    {!! Form::label('body', ' ') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Comment', ['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        @endif

        <hr>

        <!-- Posted Comments --

        <!-- Comment -->
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="65px" class="media-object"
                         src="{{$comment->photo ? $comment->photo : 'http://placehold.it/64x64'}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                {{$comment->body}}
                <!-- Nested Comment -->
                    @if($comment->replies)
                        <div id="nested-comment">
                            @foreach($comment->replies as $reply)
                                <div class="media">

                                    <a class="pull-left" href="#">
                                        <img height="64px" class="media-object"
                                             src="{{$reply->photo ? $reply->photo : 'http://placehold.it/64x64'}}"
                                             alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        {{$reply->body}}
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div>
                        {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@createReply']) !!}

                        <div class="form-group">
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                            {!! Form::label('body', ' ') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>
        @endforeach

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
            <!-- /.input-group -->
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        @if($categories)
                            @foreach($categories as $category)
                                <li><a href="#">{{$category->name}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                        <li><a href="#">Category Name</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus
                laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
        </div>

    </div>
@stop
@stop