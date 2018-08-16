@extends('layouts.master')
@section('title')
    Books
@endsection
@section('content')
    @include('front.partials.nav')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Books</li>
    </ol>
    <div class="container mt-4">
            @include('flash::message')
            <!--Jumbotron-->
                <div class="jumbotron">
                    <h1 class="h1-reponsive mb-3 blue-text"><strong class="text-white">
                        <i class="fa fa-book"></i>
                        Books</strong></h1>
                    <p class="lead text-white">
                        Find books you like here.
                    </p>
                    <hr class="my-4">
                    <!-- search form -->
                    <form class="form-inline d-flex justify-content-center">
                      <label class="sr-only" for="inlineFormInputName2">Name</label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

                      <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                      </div>

                      <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                        <label class="form-check-label" for="inlineFormCheck">
                          Remember me
                        </label>
                      </div>

                      <button type="submit" class="btn btn-warning btn-sm mb-2">Search</button>
                    </form>
                </div>
            <!--Jumbotron-->
            <a href="books/create" class="text-orange font-bold d-flex justify-content-end" target="_blank">
                New Book
            </a>
            <h6>Recently Added:</h6>
            <hr>
        <div class="row">
        @foreach ($books as $book)
            @if ($book->is_new() == True)
                <div class="col-md-2 mt-4">
                    <span class="badge {{ $book->type['color'] }}">
                        {{ $book->type['title'] }}
                    </span>
                    @if ($book->is_new() == True)
                        <img src="img/new-book-tag.svg" alt=""style="width:5em;height:auto;z-index:2;position:absolute;left:113px;top:10px;">
                    @endif
                    <div class="mb-3">
                        <div class="view overlay">

                            <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">

                            <a href="{{ $book->path() }}">
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
        </div>
       
        <h6 class="mt-4">All Books:</h6>
        <hr>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-2 mt-4">
                    <span class="badge {{ $book->type['color'] }}">
                        {{ $book->type['title'] }}
                    </span>                    
                    <div class="mb-3">
                        <div class="view overlay">
                            <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">
                            <a href="{{ $book->path() }}">
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
                    
            @endforeach
        </div>



        <span class="d-flex justify-content-center mt-3">
            {{ $books->links() }}
        </span>

        
    </div>


@endsection
@section('script')
    <script>
        $('div.alert').not('.alert-important').delay(2000).fadeOut(450);
    </script>

@endsection
