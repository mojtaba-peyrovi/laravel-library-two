<style type="text/css">
  .book-card-img,
  .book-overlay{
    border-radius: 0.25rem 0.7rem 0.7rem 0.25rem;     
    width:120px;     
  } 
  .book-overlay{
    box-shadow: -10px 11px 8px -7px rgba(122,116,122,0.75);
  }
  .book-card-mask{
    background: rgba(153, 153, 153, 0.5);
  } 
  .book-card-mask p {
    font-size: 10px;
    color: white;
  }      
  .card-movie-title{
    font-size: 13px;
    font-weight: 600;
    margin-left: 15px;
    margin-top: -12px;
  }
  .card-movie-year{  
    margin-top: -12px;
    font-size: 13px;
  }
  .index-type-badge{
    z-index: 2;
    position: relative;
    top:150px;
    /*left:86px;*/
    /*width: 100%;*/
  }

</style>

<div class="mt-4 mr-4 ml-4">
    <span class="badge index-type-badge {{ $book->type['color'] }}">
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

    @include('front.partials.rate-stars')
    <a href="/books/{{ $book->id }}">
        <div class="row">
            <span class="card-movie-title">{{ str_limit($book->title, $limit = 10, $end = '...') }}</span>        
            <span class="card-movie-year">({{ $book->publish_year }})</span>
        </div>       
    </a>
</div>