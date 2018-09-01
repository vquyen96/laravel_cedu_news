@extends('frontend.master')
@section('title','Tin tức')
@section('main')
<link rel="stylesheet" type="text/css" href="css/news/list-news.css">
	<section id="body">
		<div class="heading">
			<div class="container">			
				<h1>Tin Tức</h1>
				<p>Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất</p>	
			</div>
		</div>
		<div id="list-news">
			<div class="container">
				<div class="row">
					@foreach($news as $item)
					<div class="col-md-4 col-sm-4 col-12">
						<div class="news">
							<a href="{{asset('news/detail/'.$item->news_slug)}}" class="img" style="background: url('{{ asset('lib/storage/app/news/'.$item->news_img)}}') no-repeat center/cover; "></a>
							<div class="text">
								<p>{{cut_string($item->news_title,70)}}</p>
								<a href="#" class="button">Mẹo học tập</a>
								<a href="#" class="button">Thiết kế</a>
								<a href="#" class="button">Color</a>			
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<div id="page-number">
			<div class="container">
				{!! $news->links('layout.paginate') !!}	
			{{-- 	<a class="number" href="">01</a>
				<a class="number" href="">02</a>
				<a class="number" href="">03</a>
				<a class="number" href="">04</a>
				<a class="number" href="">05</a>
				<a class="number" href=""><i class="fas fa-angle-right"></i></a> --}}
			</div>
		</div>
	</section>

@stop
@section('script')

@stop