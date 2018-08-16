@extends('layouts.master')
@section('title')
    {{ $book->title }}
@endsection
@section('content')
    @include('front.partials.nav')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="/books">Books</a></li>
        <li class="breadcrumb-item active">
            {{ $book->title }}
        </li>
    </ol>
    <div class="container" style="margin-bottom:100px; margin-top:100px;">

            @include('flash::message')

        <div class="row">


            <div class="col-md-4">

                <img src="{{ $book->photo }}" alt="">
                <h6 class="p-3 m-2 bg-light col-md-8">
                    <strong>Read Date: </strong>
                            {{ $book->read_date }}
                </h6>
            </div>
            <div class="col-md-6 bg-grey-lighter p-4">
                <h1>
                    @include('front.partials.format-badges')
                    {{ $book->title }}
                    <span>
                        ({{ $book->publish_year }})
                    </span>

                </h1>


                <p>
                    by <a href="/authors/{{ $book->author['id'] }}">
                        {{ $book->author['name'] }}
                        {{ $book->author['last_name'] }},
                        (Author)
                        </a>
                        -
                        Publisher:
                        <a href="/publishers/{{ $book->publisher['id']}}">
                            {{ $book->publisher['name'] }}
                        </a>

                </p>
                <span class="badge {{ $book->type['color'] }} mt-3">
                    {{ $book->type['title'] }}
                </span>
                <!-- rating stars -->
                <span class="rates ml-2">
                    <span class="hidden">{{ $book_rate = $book->rate }}</span>
                    @for ($i=0; $i < $book_rate; $i++)
                        <img src="/img/star.png" style="width:15px;height:15px;">
                    @endfor
                    <span class="hidden">{{ $rate_off = 5 - ($book->rate) }}</span>
                    @for ($i=0; $i < $rate_off; $i++)
                        <img src="/img/star-off.png" style="width:15px;height:15px;">
                    @endfor
                    <small class="ml-2 text-muted">({{ $book->rate }}.0)</small>
                <!-- end of stars-->
                </span>

                <span class="hidden">{{ $book_user = $book->user->id }}</span>
                @if ($book_user == Auth::user()['id'])
                    <div class="d-flex justify-content-end">

                        <form method="get" action="/books/{{ $book->id}}/edit">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                EDIT
                            </button>
                        </form>
                        <form class="pull-right" action="{{ action('booksController@destroy', $book->id) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">

                            <button class="btn btn-sm btn-danger" data-toggle="confirmation"
                                    data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
                                    data-btn-ok-icon-class="" data-btn-ok-icon-content=""
                                    data-btn-cancel-label="" data-btn-cancel-class="btn-danger"
                                    data-btn-cancel-icon-class="" data-btn-cancel-icon-content="close"
                                    data-title="Are You Sure?" data-content="You will lose this book forever!">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    DELETE
                            </button>
                        </form>
                    </div>
                @endif


                <span class="text-muted font-small ml-4">Created by:
                    <a href="/users/{{ $book->user->id}}">
                     {{ $book->user['name'] }}
                     </a>
                 </span>
                <span class="text-muted font-small ml-4">({{ $book->created_at->DiffForHumans() }})</span>
                <hr style="margin-top:-2px;">
                <h6 class="font-bold mb-2">About the book:</h6>
                <p>{{ $book->desc }}</p>
            </div>
            <div class="col-md-6 offset-md-4 bg-grey-lighter mt-4 p-4">
                <h6 class="font-bold mb-2">Quotes:</h6>
                <p>{{ $book->quotes }}</p>
            </div>

        </div>

    </div>
    @if ($final_related->count())
        <div class="col-md-12 bg-grey-lighter mt-4 pt-3">
            <h2>Related Books:</h2>
            <hr>
            <div class="container">
                <div class="row">
                    @foreach ($final_related as $book)
                    <div class="col-md-2 mt-4">
                        @include('flash::message')
                        <div class="mb-3">

                                <div class="view overlay">
                                    <img class="z-depth-1-half" src="{{ $book->photo }}" alt="">
                                    <a href="/books/{{ $book->id }}">
                                    <div class="mask flex-center rgba-teal-strong">
                                    <p class="white-text">Read More...</p>
                                    </div>
                                    </a>
                                </div>
                                <a href="/books/{{ $book->id }}" class="mt-2">
                                    {{ $book->title }}
                                    ( {{ $book->publish_year }})
                                </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif



@endsection
@section('script')
    <script type="text/javascript">
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    // other options
    });
    </script>
    <script>
        $('div.alert').not('.alert-important').delay(1500).fadeOut(550);
    </script>
@endsection
