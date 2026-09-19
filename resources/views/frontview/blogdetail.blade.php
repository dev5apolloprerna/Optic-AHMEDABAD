@extends('layouts.front')
@section('content')

<style>
    /* BLOG DETAIL */

.blog-detail-section{
  padding:80px 15px;
}

.blog-detail-card{
  background:#fff;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

.blog-detail-img{
  width:100%;
  height:380px;
  object-fit:cover;
}

.blog-detail-content{
  padding:35px;
}

.detail-category{
  background:#ff6800;
  color:#fff;
  padding:6px 14px;
  border-radius:20px;
  font-size:13px;
}

.blog-detail-content h1{
  margin:15px 0;
  font-size:32px;
}

.detail-meta{
  display:flex;
  gap:20px;
  font-size:14px;
  color:#777;
  margin-bottom:20px;
}

.blog-detail-content p{
  color:#555;
  line-height:1.8;
  margin-bottom:15px;
}

.blog-detail-content h3{
  margin:25px 0 10px;
}

.blog-detail-content blockquote{
  background:#f6f7fb;
  border-left:4px solid #ff6800;
  padding:15px 20px;
  margin:20px 0;
  font-style:italic;
}

/* RELATED BLOGS */

.related-wrapper{
  background:#fff;
  padding:25px;
  border-radius:14px;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
  /*height:100%;*/
}

.related-title{
  margin-bottom:20px;
  font-size:22px;
}

.related-card{
  display:flex;
  gap:15px;
  margin-bottom:18px;
  text-decoration:none;
  color:#000;
}

.related-card img{
  width:90px;
  height:70px;
  object-fit:cover;
  border-radius:8px;
}

.related-card h6{
  font-size:15px;
  margin-bottom:5px;
}

.related-card span{
  font-size:13px;
  color:#777;
}

.related-card:hover h6{
  color:#ff6800;
}

/* Mobile */

@media(max-width:768px){
  .blog-detail-img{
    height:250px;
  }

  .blog-detail-content{
    padding:25px;
  }
}

</style>



  <div class="head-menu-s">
            <h3 class="fr-head">Blog Detail</h3>
            <!--<p><a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontBlog') }}">Blog</a> / <a href="#">Blog Detail</a></p>-->
        </div>
<section class="blog-detail-section">
  <div class="container">
    <div class="row g-4">

      <!-- LEFT : BLOG DETAIL -->
      <div class="col-lg-8">

        <div class="blog-detail-card">

          <img src="{{ asset('blog/'.$blog->strPhoto) }}" class="blog-detail-img">

          <div class="blog-detail-content">

            <!--<span class="detail-category">Technology</span>-->

            <h1>{{ $blog->strTitle }}</h1>

            <div class="detail-meta">
              <span><i class="bi bi-calendar"></i> {{ date('M d, Y', strtotime($blog->created_at)) }}</span>
              
            </div>
            
            {!! $blog->strDescription !!}
            <!--<p>-->
            <!--  Web development is evolving rapidly. New technologies and frameworks-->
            <!--  are transforming how modern websites and applications are built.-->
            <!--</p>-->

            <!--<p>-->
            <!--  Developers are now focusing more on performance, accessibility,-->
            <!--  and user experience than ever before.-->
            <!--</p>-->

            <!--<h3>Why These Trends Matter</h3>-->

            <!--<p>-->
            <!--  Adopting modern tools helps businesses stay competitive and deliver-->
            <!--  better digital products.-->
            <!--</p>-->

            <!--<blockquote>-->
            <!--  “Good design is obvious. Great design is transparent.”-->
            <!--</blockquote>-->

            <!--<p>-->
            <!--  Staying updated with trends ensures scalability, security, and growth.-->
            <!--</p>-->

          </div>

        </div>

      </div>

      <!-- RIGHT : RELATED BLOGS -->
      <div class="col-lg-4">

        <div class="related-wrapper">

          <h4 class="related-title">Related Blogs</h4>

          @foreach($relatedBlogs as $rel)

        <a href="{{ route('FrontBlogdetail',$rel->strSlug) }}" class="related-card">
        
            <img src="{{ asset('blog/'.$rel->strPhoto) }}">
        
            <div>
                <h6>{{ $rel->strTitle }}</h6>
                <span>{{ date('M d, Y', strtotime($rel->created_at)) }}</span>
            </div>
        
        </a>
        
        @endforeach

          

        </div>

      </div>

    </div>
  </div>
</section>

@endsection
