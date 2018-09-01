@extends('frontend.master')
@section('title','Tin tức')
@section('main')
<link rel="stylesheet" type="text/css" href="css/news/news.css">
	<section id="news-details">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-12">
					<div id="content-left">
						<h1>{{$news->news_title}}</h1>
						<div class="thong-ke">
							<div class="date"><i class="far fa-clock"></i>{{$news->created_at}}<i class="far fa-eye"></i>{{$news->news_view}} view</div>
							<div class="like-share">
								<a href="" class="like"><i class="fas fa-thumbs-up"></i> Like</a>
								<a href="" class="like">Share</a>
							</div>
						</div>
						<div class="content">
							{!!$news->news_content!!}
						</div>

						<div class="comment">
							<h5>Comment</h5>
							<div class="list-cmt">
								<div class="cmt">
									<img src="img/anh-1.png">
									<div class="noi-dung">
										<p class="name">Robby de Leon</p>
										<span>( 2 months ago )</span>
										<p class="feel">Tim is a great Instructor. I just started to watch the course few weeks ago, but I can say that I already know many things about Java programming. It's great that he's also making a Quizzes and Challenges for us to apply what we've learned. But the reason why it's 4 STARS</p>
									</div>
								</div>
								<div class="cmt">
									<img src="img/anh-1.png">
									<div class="noi-dung">
										<p class="name">Robby de Leon</p>
										<span>( 2 months ago )</span>
										<p class="feel">Tim is a great Instructor. I just started to watch the course few weeks ago, but I can say that I already know many things about Java programming. It's great that he's also making a Quizzes and Challenges for us to apply what we've learned. But the reason why it's 4 STARS</p>
									</div>
								</div>
							</div>
							<div class="write-cmt">
								<div class="avatar">
									<img src="img/anh-1.png"></br>
									<p class="name">Robby de Leon</p>
								</div>
								<textarea></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-12">
					<div id="content-right">
						<h2>Bài viết liên quan</h2>
						@foreach($newsList as $item)
						<a href="" class="news">
							<div class="img" style="background:url('{{ asset('lib/storage/app/news/'.$item->news_img)}}');"></div>
							<p>{{$item->news_title}}</p>
						</a>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
	</section>

@stop
@section('script')

@stop