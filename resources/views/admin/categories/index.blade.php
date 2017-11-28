@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>
    <div class="row">
        <div class="col-sm-6">
            {!! Form::open(['method'=>'POST', 'action'=> 'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Category:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Create post', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>

        <div class="col-sm-6">
            @if($categories)
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @endif
        </div>
    </div>
@stop