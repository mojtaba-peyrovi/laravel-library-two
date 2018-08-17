<style type="text/css">
    .book-img {
        border-radius: 6px;
        box-shadow: -11px 19px 38px -15px rgba(122,116,122,0.75);
    }    
    .fav-badge {
        z-index: 10;
        position: relative;
    }     
    .container {
       /* margin-bottom:100px; 
        margin-top:100px; */ 
    }  

    
</style>


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
    <div class="container"> 
            <!-- favorite badge -->
            @if(! $favorites_exist == null)       
           <span class="badge badge-success fav-badge" style="top:320px;">Favorited</span>  
           @endif
           <!-- type badge -->     
            <span class="badge {{ $book->type['color'] }} mt-3" style="position: relative; top:30px; left: 160px;">
                {{ $book->type['title'] }}
            </span>           

            <div class="row">       
                <div class="col-md-4">
                    @include('flash::message')                
                    <img src="{{ $book->photo }}" alt="" class="book-img">
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
                
                <!-- rating stars -->
                    @include('front.partials.rate-stars')
                    
                    

                <span class="hidden">{{ $book_user = $book->user->id }}</span>
                @if ($book_user == Auth::user()['id'])
                    <div class="d-flex justify-content-end">
                        
                        <!-- edit button -->    
                        <form method="get" action="/books/{{ $book->id}}/edit">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                EDIT
                            </button>
                        </form> <!-- end of edit button -->

                        <!-- delete button -->
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
                        </form>  <!-- end of delete butoon -->

                        <!-- favorite button-->
                        @if(! $favorites_exist == null) 
                            @include('front.partials.unfav-button')
                        @else
                            @include('front.partials.fav-button')   
                        @endif                       
                        <!-- end of favorite button --->

                    </div>
                @endif
    
                <!-- created by-->
                <span class="text-muted font-small ml-4">Created by:
                    <a href="/users/{{ $book->user->id}}">
                     {{ $book->user['name'] }}
                     </a>
                 </span>  
                <span class="text-muted font-small ml-4">({{ $book->created_at->DiffForHumans() }})</span>
                <!-- end of created by -->
                
                <hr style="margin-top:-2px;">
                <h6 class="font-bold mb-2">About the book:</h6>
                <p>{{ $book->desc }}</p>
            </div>
             <!-- quotes section -->   
            <div class="col-md-6 offset-md-4 bg-grey-lighter mt-4 p-4">
                <h6 class="font-bold mb-2">Quotes:</h6>
                <p>{{ $book->quotes }}</p>
            </div>
            <!-- end of quotes section -->
        </div>
        <!-- related books -->
        @if ($final_related->count())
            <div class="col-md-12 bg-grey-lighter mt-4 pt-3">
                <h2>Related Books:</h2>
                <hr>                
                <div class="row">
                    @foreach ($final_related as $book)
                    @include('front.partials.book-card')
                </div>                
            </div>
                @endforeach                   
                        
        @endif  <!-- end of related books -->
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

