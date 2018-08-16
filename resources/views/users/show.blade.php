@extends('layouts.master')
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    @include('front.partials.nav')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/users">Users</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ol>
    <div class="container mt-4">
        <!--Jumbotron-->
            <div class="jumbotron">
                <h1 class="h1-reponsive mb-3 blue-text"><strong class="text-white">
                    <i class="fa fa-user"></i>
                    {{ $user->name }}</strong></h1>
                <p class="lead text-white">
                    Here is your profile!
                </p>
                <hr class="my-4">
            </div>

        <!--Jumbotron-->

        <!-- personal info -->
        <h6 class="text-indigo">Personal Info</h6>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <img src="/img/empty-user.jpg" alt="" class="img-thumbnail" style="width:150px;height:150px;">
            </div>
            <div class="col-md-9">
                <strong>Name: </strong>
                {{ $user->name }}<br>
                <strong>Email: </strong>
                {{ $user->email }}
            </div>
        </div> <!-- end of personal info-->

        @if ($user->books->count())

            <!-- created by user -->
            <h6 class="text-indigo mt-4">Created by {{ $user->name }}</h6>
            <hr>
            <div class="col-md-12 bg-grey-lighter mt-4 pt-3">
                <div class="container">
                    <div class="row">
                        @foreach ($user->books as $book)
                        <div class="col-md-2 mt-4">
                            @include('flash::message')
                            <div class="mb-3">
                                <div class="view overlay">
                                    <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">
                                    <a href="/books/{{ $book->id }}">
                                    <div class="mask flex-center rgba-teal-strong">
                                    <p class="white-text">Read More...</p>
                                    </a>
                                </div>
                            </div>
                            <a href="/books/{{ $book->id }}" class="mt-2">
                                {{ $book->title }}
                                ( {{ $book->publish_year }})
                            </a>
                        </div>                        
                        @endforeach
                    </div>
                </div>
            </div>  <!-- end of created by user -->

            <!-- favorites section -->
                 <h6 style="margin-top:50px;">Favorites:</h6>
                 <hr>
                 <div class="row">
                 @foreach($books as $book)    
                    @foreach ($book->favorites as $favorite)
                        @if ($favorite->user_id == auth()->user()->id && $favorite->fav == 1)
                            <div class="col-md-2 mt-4">
                                <span class="badge {{ $book->type['color'] }}">
                                    {{ $book->type['title'] }}
                                </span>                            
                                <div class="mb-3">
                                    <div class="view overlay">
                                        <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">
                                        <a href="">
                                            <div class="mask flex-center rgba-teal-strong">
                                                <p class="white-text">Read More...</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @include('front.partials.rate-stars')
                                <a href="/books/{{ $book->id }}">
                                    <h6 class="font-bold font-small">{{ $book->title }}
                                    </h6>
                                    <small>({{ $book->publish_year }})</small>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endforeach
                </div>  <!-- end of favorites section -->

                <!-- last month section -->
                 <h6 style="margin-top:50px;">Read last month:</h6>
                 <hr>
                 <div class="row">
                 @foreach($books as $book)
                        @if ($book->read_last_month() == True)
                            <div class="col-md-2 mt-4">
                                <span class="badge {{ $book->type['color'] }}">
                                    {{ $book->type['title'] }}
                                </span>   
                                <span class="float-right font-small">{{ \Carbon\Carbon::parse($book->read_date)->diffForHumans()}}</span>                         
                                <div class="mb-3">
                                    <div class="view overlay">
                                        <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">
                                        <a href="">
                                            <div class="mask flex-center rgba-teal-strong">
                                                <p class="white-text">Read More...</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @include('front.partials.rate-stars')
                                <a href="/books/{{ $book->id }}">
                                    <h6 class="font-bold font-small">{{ $book->title }}
                                    </h6>
                                    <small>({{ $book->publish_year }})</small>
                                </a>
                            </div>
                        @endif                    
                @endforeach
                </div>  <!-- end of last month section -->
            </div>        
        @endif      
    </div>
@endsection
    
