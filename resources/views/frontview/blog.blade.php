@extends('layouts.front')
@section('content')

<style>
     /* Section */
/*.blog-section{*/
/*  padding:80px 15px;*/
/*}*/

/* Header */
.blog-header{
  margin-bottom:50px;
}

.blog-header h2{
  font-size:36px;
  font-weight:700;
}

.blog-header p{
  color:#666;
}

/* Card */
.blog-card{
  background:#fff;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.06);
  transition:0.4s;
  height:100%;
}

.blog-card:hover{
  transform:translateY(-8px);
  box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

/* Image */
.blog-img{
  position:relative;
  overflow:hidden;
}

.blog-img img{
  width:100%;
  height:220px;
  object-fit:cover;
  transition:0.4s;
}

.blog-card:hover img{
  transform:scale(1.1);
}

/* Category */
.category{
  position:absolute;
  top:15px;
  left:15px;
  background:#000;
  color:#fff;
  padding:6px 12px;
  border-radius:20px;
  font-size:12px;
}

/* Content */
.blog-content{
  padding:25px;
}

.meta{
  display:flex;
  gap:20px;
  font-size:13px;
  color:#777;
  margin-bottom:12px;
}

.blog-content h4{
  font-size:15px !important;
  margin-bottom:10px;
}

.blog-content p{
  color:#555;
  line-height:1.6;
}

/* Read More */
.read-more{
  display:inline-flex ;
  align-items:center;
  gap:6px;
  color:#000;
  font-weight:600;
  text-decoration:none;
  margin-top:10px;
  font-size:14px;
}

.read-more:hover{
  text-decoration:underline !important;
  color:#ff6800 !important;
}

/* Mobile */
@media(max-width:600px){
  .blog-header h2{
    font-size:28px;
  }
}


/* Pagination */
.blog-pagination .page-link{
  border:none;
  margin:0 6px;
  padding:10px 16px;
  border-radius:8px;
  color:#333;
  font-weight:600;
  box-shadow:0 6px 15px rgba(0,0,0,0.06);
  transition:0.3s;
}

.blog-pagination .page-link:hover{
  background:#ff6800;
  color:#fff;
}

/* Active Page */
.blog-pagination .page-item.active .page-link{
  background:#ff6800;
  color:#fff;
  box-shadow:0 10px 25px rgba(255,104,0,0.4);
}

/* Disabled */
.blog-pagination .page-item.disabled .page-link{
  background:#eee;
  color:#999;
  pointer-events:none;
}

</style>

 
<!-- pagebanner -->
    <!--<section id="pagebanner">-->
    <!--    <div class="page-title">-->
    <!--        <h2 class="white text-center">Blogs</h2>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- End Pagebanner -->

    <!-- breadcrumb -->
    <!--<div class="breadcrumb-main">-->
    <!--    <div class="container">-->
    <!--        <ul class="breadcrumb">-->
    <!--            <li><a href="{{ route('FrontIndex') }}"><i class="fa fa-home"></i></a></li>-->
    <!--            <li class="active">Blogs</li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</div><!-- End breadcrumb -->
<section class="blog-section">
    <div class="head-menu-s">
            <h3 class="fr-head">Blog</h3>
            <!--<p><a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontBlog') }}">Blog</a></p>-->
        </div>
  <div class="container">

    <!-- Header -->
    <!--<div class="blog-header text-center">-->
    <!--  <h2>Our Blog</h2>-->
    <!--  <p>Latest news, tips & articles</p>-->
    <!--</div>-->

    <!-- Blog Grid -->
    <div class="row g-4 mt-5">

      <!-- Blog Card -->
      @foreach($blogs as $blog)

<div class="col-lg-4 col-md-6 " style="margin-bottom:15px !important">
    <div class="blog-card">

        <div class="blog-img">
            <img src="{{ asset('blog/'.$blog->strPhoto) }}" alt="{{ $blog->strTitle }}">
        </div>

        <div class="blog-content">

            <div class="meta">
                <span>
                    <i class="bi bi-calendar"></i>
                    {{ date('M d, Y', strtotime($blog->created_at)) }}
                </span>
            </div>

            <h4>{{ $blog->strTitle }}</h4>

            <p>{!! Str::limit(strip_tags($blog->strDescription),120) !!}</p>

            <a href="{{ route('FrontBlogdetail',$blog->strSlug) }}" class="read-more">
                Read More <i class="bi bi-arrow-right"></i>
            </a>

        </div>
    </div>
</div>

@endforeach
      <!--<div class="col-lg-4 col-md-6">-->
      <!--  <div class="blog-card">-->
      <!--    <div class="blog-img">-->
      <!--      <img src="{{ asset('/Front/assets/images/exhibitor/1.jpg')}}" alt="">-->
            <!--<span class="category">Technology</span>-->
      <!--    </div>-->

      <!--    <div class="blog-content">-->
      <!--      <div class="meta">-->
      <!--        <span><i class="bi bi-calendar"></i> Feb 10, 2026</span>-->

      <!--      </div>-->

      <!--      <h4>Top Web Development Trends in 2026</h4>-->
      <!--      <p>Discover the most important web development trends shaping the future.</p>-->

      <!--      <a href="#" class="read-more">-->
      <!--        Read More <i class="bi bi-arrow-right"></i>-->
      <!--      </a>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

      <!-- Blog Card -->

    </div>

    <!-- Pagination -->
   @if($blogs->total() > 6)

<div class="row mt-5">
    <div class="col-12">
        <nav class="blog-pagination">
            <ul class="pagination justify-content-center">

                {{-- Previous --}}
                <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $blogs->previousPageUrl() ?? '#' }}">
                        Previous
                    </a>
                </li>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                    <li class="page-item {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $blogs->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $blogs->nextPageUrl() ?? '#' }}">
                        Next
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>

@endif


    

  </div>
</section>


@endsection