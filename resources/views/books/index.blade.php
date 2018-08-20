
@extends('layouts.master')
@section('styles')
<style type="text/css">
    .section-title{ 
        font-size: 25px;
        text-align: center;
        

} 
.jumbotron {
    background: linear-gradient(#006666, #ffff66);
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
    Books
@endsection
@section('content')
    @include('front.partials.nav')
    @include('front.partials.login-notice')
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
            <!-- recently added -->
            <div class="section-title">Recently Added</div>            
        <div class="row books-row">
        @foreach ($books as $book)
            @if ($book->is_new() == True)
                @include('front.partials.book-card')
            @endif
        @endforeach
        </div>  <!-- end of recently added-->        
         

        <!-- all books -->
        <div class="mt-4 section-title">All Books</div>        
        <div class="row books-row">
            @foreach ($books as $book)            
                @include('front.partials.book-card')  
            @endforeach
        </div>  <!-- end of all books-->
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
