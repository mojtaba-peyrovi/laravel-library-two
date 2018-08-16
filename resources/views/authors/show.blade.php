@extends('layouts.master')
@section('title')
    {{ $author->fullName() }}
@endsection
@section('content')
    @include('front.partials.nav')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="/authors">Authors</a></li>
        <li class="breadcrumb-item active">
            {{ $author->fullName() }}
        </li>
    </ol>
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center flex-column">
                  <img src="{{ $author->photo }}" alt="" class="img-thumbnail shadow-md" style="width:65%; height:auto;">
                  <h4 class="mt-4">About {{ $author->fullName() }} :</h4>
                  <ul class="list-group mt-3">
                    <li class="list-group-item">
                        <strong>Birthday:</strong> {{ $author->birthday }}
                        <span class="float-right"> ({{ $author->getAge()}} years old)</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Birth Place:</strong> {{ $author->birthday_place }}
                    </li>
                    <li class="list-group-item">
                        <strong>Nationality:</strong> {{ $author->nationality }}
                    </li>
                    <li class="list-group-item">
                        <strong>Occupation:</strong> {{ $author->occupation }}

                    </li>
                    <li class="list-group-item">
                        <strong>Wikipedia:</strong>
                          <a href="{{ $author->wiki }}" target="_blank">
                              Page
                          </a>
                    </li>
                  </ul>
            </div>
            <div class="col-md-6 bg-grey-lighter">

                    <h1 class="font-bold">
                        {{ $author->fullName() }} <span><small class="text-muted"> - ({{ $author->occupation }})</small></span>
                    </h1>

                    <div class="d-flex justify-content-end">

                        <form method="get" action="/authors/{{ $author->id }}/edit">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                EDIT
                            </button>
                        </form>
                        <form class="pull-right" action="{{ action('AuthorsController@destroy', $author->id) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">

                            <button class="btn btn-sm btn-danger" data-toggle="confirmation"
                                    data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
                                    data-btn-ok-icon-class="" data-btn-ok-icon-content=""
                                    data-btn-cancel-label="" data-btn-cancel-class="btn-danger"
                                    data-btn-cancel-icon-class="" data-btn-cancel-icon-content="close"
                                    data-title="Are You Sure?" data-content="You will lose this author forever!">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    DELETE
                            </button>
                        </form>
                    </div>


                @if (! $author->books->count())
                    <div class="bg-yellow m-2 p-2">
                        You haven't added any book for
                        <strong>{{ $author->name }}</strong>
                        yet!
                        <a href="{{ route('books.create')}}" class="float-right text-info font-bold">
                            Add a book now!
                        </a>
                    </div>
                @endif


                <hr>
                <a href="/authors" class="text-orange font-bold d-flex justify-content-end mr-2 mb-3" target="_blank">
                    All Authors
                </a>
                <p class="mb-3">{{ $author->desc }}</p>
            </div>

            @if ($author->books->count())
                <div class="col-md-10 bg-grey-lighter mt-4">
                    <h2>All {{ $author->name }}'s Books:</h2>
                    <hr>
                    <div class="row">
                        @foreach ($related_books as $book)
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
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
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
