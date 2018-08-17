@extends('layouts.master')
@section('styles')
<style type="text/css">
    .section-title{ 
        font-size: 22px;
        text-align: center;
        font-family:'Raleway', sans-serif;
        color: #4d4d4d;
        margin-top: 30px;
        

} 
.jumbotron {
    background: linear-gradient(#006666, #ffff66);
}
.books-card img{
    height: 100px;
    width: auto;
}
 
 .book-card-img,
  .book-overlay{
    border-radius: 3px 15px 15px 3px;   
    box-shadow: 11px 18px 23px -6px rgba(194,194,194,1);
  } 
  .book-card-mask{
    background: rgba(230, 230, 230, 0.5);
  }    
  .read-days-ago {
    font-size: 10px;   
    position: relative;
    margin-right: 50px; 
    font-weight: 500;
    color:rgb(102, 102, 102)
    position: relative;
    left:20px;
    top:-40px;
    z-index: 2;
    background: rgba(255, 255, 255, 0.7);
    padding:3px;
    border-radius: 5px;
  } 

.books-row {
    background-color: rgb(242, 242, 242);
    border-radius: 5px;
    padding-bottom: 20px;
    box-shadow: -11px 19px 38px -18px rgba(122,116,122,0.75);
}


</style>
@endsection
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    @include('front.partials.nav')
    <ol class="breadcrumb blue-grey lighten-5">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
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
        <h6 class="section-title">Personal Info</h6>        
        <div class="row books-row">
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
            <h6 class="section-title">Created by {{ $user->name }}</h6>                       
            <div class="row books-row">
                @foreach ($user->books as $book)
                    @include('front.partials.book-card')                       
                @endforeach
            </div> <!-- end of created by user -->              
            

            <!-- favorites section -->
                 <h6 class="section-title">Favorites</h6>                 
                 <div class="row books-row">
                 @foreach($books as $book)    
                    @foreach ($book->favorites as $favorite)
                        @if ($favorite->user_id == auth()->user()->id && $favorite->fav == 1)    
                            @include('front.partials.book-card')
                        @endif
                    @endforeach
                @endforeach
                </div>  <!-- end of favorites section -->

                <!-- last month section -->
                 <h6 class="section-title">Read Last Month</h6>                 
                 <div class="row books-row">
                 @foreach($books as $book)
                        @if ($book->read_last_month() == True)
                           <div class="mt-4 mr-3 ml-3">
                            <span class="badge {{ $book->type['color'] }}">
                                {{ $book->type['title'] }}
                            </span> 
                            @if ($book->is_new() == True)  
                              @include('front.partials.new-badge')
                            @endif 
                                                       
                            <div class="mb-3">                                
                                <div class="view overlay book-overlay">                                 
                                    <img class="z-depth-1-half book-card-img" src="{{ $book->photo }}" alt="">
                                    <a href="/books/{{$book->id}}">
                                        <div class="mask flex-center book-card-mask">
                                            <p class="">Read More...</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="read-days-ago">Read {{ \Carbon\Carbon::parse($book->read_date)->diffForHumans() }} 
                            </div>
                            <div style="margin-top:-20px;">@include('front.partials.rate-stars')</div>
                            <a href="/books/{{ $book->id }}">
                                <div class="row">
                                    <span class="card-movie-title">{{ str_limit($book->title, $limit = 10, $end = '...') }}</span>        
                                    <span class="card-movie-year">({{ $book->publish_year }})</span>
                                </div>                               
                            </a>
                        </div>
                        @endif                    
                @endforeach
                </div>  <!-- end of last month section -->
            </div>        
        @endif      
    </div>
@endsection
    

