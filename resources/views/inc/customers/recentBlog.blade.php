<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Tin tức blog mới nhất</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($recentBlogs as $blog)

            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="blog-single.html" class="block-20" style="background-image: url('/apps/images/news/{{$blog->image}}');">
                    </a>
                    <div class="text py-4 d-block">
                        <div class="meta">
                            <div><a>Sept 10, 2018</a></div>
                            <!-- <div><a >Admin</a></div> -->
                            <!-- <div><a class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                        </div>
                        <h3 class="heading mt-2"><a href="{{route('customers.news.show', ['slug'=>$blog->slug])}}">{{$blog->title}}</a></h3>
                        <p>{{$blog->description}}</p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>