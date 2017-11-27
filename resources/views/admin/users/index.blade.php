@extends('layouts.admin')

{{--admin/users--}}

@section('content')

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>
    @endif

    <h1>Users</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>

        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>

                    {{--@if($user->photo)--}}
                    {{----}}
                    {{--@endif--}}

                    <td>
                        <img height="50px" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/50x50'}}"
                             alt="">
                    </td>
                    <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->is_active == 1 ? "Active" : "Not Active"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>{{$user->role->name}}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

@stop