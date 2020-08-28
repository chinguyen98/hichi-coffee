<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Tin tức blog mới nhất</h2>
                <b style="color: peru; font-size: 30px;" class="slogan-index"><i>Cà phê tốt cho tài năng<br>Nhưng thiên tài cần lời cầu nguyện</i></b>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($recentBlogs as $blog)

            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch">
                    <a href="blog-single.html" class="block-20" style="background-image: url('/apps/images/news/{{$blog->image}}');">
                    </a>
                    <div class="text py-4 d-block">
                        <h3 class="heading mt-2" ><a href="{{route('customers.news.show', ['slug'=>$blog->slug])}}"><b style="color: peru; font-size: 18px;">{{$blog->title}}</b></a></h3>
                        <p><i style="color: white; font-size: 16px;">{{$blog->description}}</i></p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>