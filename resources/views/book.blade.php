<!DOCTYPE html>
<html lang="en">
@include('include.book.head')

<body>
    @include('include.book.header')
    <main>
        <div class="container">
            {{-- @dd($book->title) --}}
            {{-- @foreach($book as $books) --}}
            <section id="book-info" class="book-info container-fluid">
                <!-- Book Short Description Start-->
                <section class="bk-srt-desc row">
                    <div class="bk-img-details d-flex gap-5 col-xl-7">
                        <div class="bk-info-name-img">
                            <!-- Book image -->
                            <div class="bk-img">
                                <img class="bk-img-tag" src="{{ $book->preview_link }}" alt="{{ $book->title }}" />
                            </div>
                        </div>
                        <!-- Book Short Info -->
                        <div class="bk-info-details">
                            <!-- Book name -->
                            <div class="info-name">
                                <h2 class="bk-info-head">{{ $book->title }}</h2>
                            </div>
                            <div class="info-authors d-flex">
                                <h4 class="info-ttl">Authors(s):</h4>
                                <h4 class="info-ans">{{ $book->author }}</h4>
                            </div>
                            <div class="info-publisher d-flex">
                                <h4 class="info-ttl">Publisher:</h4>
                                <h4 class="info-ans">{{ $book->publisher_name }}</h4>
                            </div>
                            <div class="info-language d-flex">
                                <h4 class="info-ttl">Language:</h4>
                                <h4 class="info-ans">{{ $book->language }}</h4>
                            </div>
                            <div class="info-pages d-flex">
                                <h4 class="info-ttl">Pages:</h4>
                                <h4 class="info-ans">{{ $book->pages }}</h4>
                            </div>
                            <div class="info-country d-flex">
                                <h4 class="info-ttl">Country of Origin:</h4>
                                <h4 class="info-ans">{{ $book->originCountry }}</h4>
                            </div>
                            <div class="info-age d-flex">
                                <h4 class="info-ttl">Age Range:</h4>
                                <h4 class="info-ans">{{ $book->lowerLimit }}-{{ $book->upperLimit }}</h4>
                            </div>
                            <div class="info-time d-flex">
                                <h4 class="info-ttl">Average Reading Time</h4>
                                <h4 class="info-ans">{{ $book->avgReadingTime }} mins</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Book price and buy option -->
                    <div class="bk-buy-con col-xl-4 col-lg-4">
                        <div class="bk-price-con d-flex align-items-center gap-3 mb-3">
                            <div class="price-radio">
                                <input class="input-radio-buy" type="radio" checked />
                            </div>
                            <div class="bk-price">
                                <h4>Buy Digital Copy</h4>
                                <div class="d-flex">
                                    <h5 class="me-2 bk-final-price">for</h5>
                                    {{-- <h5 class="bk-price-previous me-2 bk-final-price">
                                        &#8377;99
                                    </h5> --}}
                                    <h5 class="bk-price-new bk-final-price">&#8377;{{ $book->price }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="bk-buy">
                            <a target="_blank" href="{{ redirect('http://app.rachnaye.com/digital/book?id='.$book->b_id)->getTargetUrl() }}"><button class="w-100 bk-buy-btn">Buy Now</button></a>
                        </div>
                    </div>
                    <!-- Book Short Description End-->
                </section>
                <!-- Book Long Description starts -->
                <section class="bk-long-desc">
                    <div class="bk-head">
                        <h2 class="bk-head-ttl">Book Description</h2>
                    </div>
                    <div class="bk-summary">
                        <h4>
                            {{$book->description}}
                        </h4>
                    </div>
                </section>
                {{-- @dd($book->keywords) --}}
                <!-- Book Long Description ends -->
                <!-- Book Cover points start -->
                <section class="bk-cvr-pts d-flex">
                    @foreach($book->keywords as $keywords)
                    <div class="cvr-ptr-ctr">
                        <div class="cvr-pt">{{ $keywords->keywords }}</div>
                    </div>
                    @endforeach
                </section>
                <!-- Book Cover points end -->
                <!-- Publisher info start -->
                {{-- @dd($book) --}}
                <section class="publisher-info">
                    <div class="pub-abt">
                        <h2>About Publisher</h2>
                    </div>
                    <div class="pub-abt-info">
                        {{-- @dd($book->publisher->bio) --}}
                        {{-- @foreach($book->publisher as $publisher) --}}
                        <h4>
                            {{ $book->publisher->bio }}
                        </h4>
                        {{-- @endforeach --}}
                    </div>
                </section>
                <!-- Publisher info end -->
                <!-- More Books Section starts -->
                <section class="more-bks-sec">
                    <div class="more-bks-heading">
                        <h2>More Books from {{ $book->publisher->name }}</h2>
                    </div>
                    <div class="img-grid-container mt-3 row">
                        @foreach($publisher_books->books as $publisher_books)
                        <div class="img-grid-item col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ url('/book/'.$publisher_books->slug) }}">
                                <img class="bk-img-tag" src="{{ $publisher_books->preview_link }}" alt="Beyond the doors of chaos" />
                            </a>
                        </div>
                        {{-- @if($loop->iteration =='6')
                        @php break; @endphp
                        @endif --}}
                        @endforeach
                    </div>
                </section>
                <!-- More Books Section ends -->
            </section>
        </div>
    </main>
</body>

</html>
