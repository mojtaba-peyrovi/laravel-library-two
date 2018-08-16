<!-- rating stars -->
<span class="rates">

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
