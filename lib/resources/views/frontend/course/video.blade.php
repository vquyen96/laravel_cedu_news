@extends('frontend.master')
@section('title','Danh sách khóa học')
@section('fb_title','Top khóa học hàng đầu')
@section('fb_description','Nơi cung cấp cho bạn những khóa học tốt nhất, rẻ nhất. Tạo lên một môi trường học tập trên cuộc cách mạng công nghệ 4.0')
@section('fb_image',asset('public/layout/frontend/img/dayne-topkin-60559-unsplash.png'))
@section('main')
<link rel="stylesheet" href="css/owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="css/owlcarousel/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="css/course/detail.css">
<link href="css/plugins/video-js.css" rel="stylesheet">

<div class="instruction">

	<div class="instruction_body">
		<a href="{{ asset('courses') }}" class="instruction_item">
			Khóa học
		</a>
		<a class="instruction_item">
			>
		</a>
		<a href="{{ asset('courses/'.Request::segment(2)) }}" class="instruction_item">
			Ngoại ngữ
		</a>
		<a class="instruction_item">
			>
		</a>
		<a href="{{ asset('courses/detail/'.Request::segment(3)) }}" class="instruction_item">
			{{ $course->cou_name }}
		</a>
		<a class="instruction_item">
			>
		</a>
		<a href="{{ Request::url() }}" class="instruction_item">
			Bài {{ Request::segment(5) }}
		</a>
		
	</div>
	
</div>
<div class="main_body">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="courseTitle">
					<h1>{{ $course->cou_name }}</h1>
					<div class="courseTitleContent">
						The only course you need to learn web development - HTML, CSS, JS, Node, and More and More!!!
					</div>
				</div>
				<div class="courseRate">
					<div class="courseRateStar">
						@for($i=0;$i<5;$i++)
							@if($course->cou_star > $i)
								<i class="fa fa-star starActive" aria-hidden="true"></i>
							@else
								<i class="fa fa-star" aria-hidden="true"></i>
							@endif
						@endfor
					</div>
					<div class="courseRateContent">
						{{ $course->cou_star }} ( {{ $course->rating->count() }} người bình chọn)
					</div>
				</div>

				<div class="courseHeadVideo">
					<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
					<video id="my-video" class="video-js" controls preload="auto"
				  poster="img/poster.png" data-setup="{}"  src="">
					    <source src="{{ asset('lib/public/uploads/1528794961.mp4') }}" type='video/webm'>
					    <p class="vjs-no-js">
					      	<a href="{{ asset('') }}" target="_blank"></a>
					    </p>
				 	</video>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 col-sm-7">
				
				<div class="lesson">
					<div class="lessonTitle">
						<h2>Cấu trúc bài giảng</h2>
						<div class="numOfLesson">
							356 bài giảng
						</div>
						<div class="timeOfLesson">
							{{gmdate("H:i", $course->cou_video)}}p 
						</div>
					</div>
					<div class="lessonMain">
						<?php $video = 0 ?>
						@foreach($course->part as $item)
							<div class="lessonMainPart">
								<div class="lessonMainPartIcon">
									<i class="fas fa-minus"></i>
									<i class="fas fa-minus"></i>
								</div>
								<div class="lessonMainPartTitle">
									{{$item->part_name}}
								</div>
								<div class="lessonMainPartTime">
									4:30
								</div>
							</div>
							<div class="lessonMainVideo">
								@foreach($item->lesson as $itemTiny)	
									<div class="lessonMainVideoItem">
										<div class="lessonMainVideoIcon">
											<i class="fas fa-video"></i>
										</div>
										<div class="lessonMainVideoTitle">
											{{$itemTiny->les_name}}
										</div>
										<div class="lessonMainVideoTime">
											{{$itemTiny->les_video_duration}}
										</div>
									</div>
								<?php $video++ ?>
								@endforeach
							</div>
								
						@endforeach
					</div>
				</div>
				
				
				<div class="rate">
					<div class="rateTitle">
						Đánh giá nhận xét
					</div>
					<div class="rateChart">
						<div class="rateChartLeft">
							<div class="rateChartLeftNum">
								{{ number_format($course->cou_star, 1,'.','.') }}
							</div>
							<div class="rateChartLeftStar">
								@for($i=0;$i<5;$i++)
									@if($course->cou_star > $i)
										<i class="fa fa-star starActive" aria-hidden="true"></i>
									@else
										<i class="fa fa-star" aria-hidden="true"></i>
									@endif
								@endfor
							</div>
						</div>
						<div class="rateChartRight">

							@for($i = 5; $i > 0; $i--)
							<div class="rateChartRightItem">
								<div class="rateChartRightItemLine">
									<div class="rateChartRightItemLineActive">
										
									</div>
								</div>
								<div class="rateChartRightItemNum">
									{{ $i }} <i class="fa fa-star starActive" aria-hidden="true"></i>
								</div>
								<div class="rateChartRightItemValue">
									<?php $count = 0; $total = 0?>

									@foreach($course->rating as $item)
										@if($item->rat_star == $i)
											<?php $count++?>
										@endif
										<?php $total++?>
									@endforeach
									{{ $total != 0 ? $count/$total : 0}}
								</div>
							</div>
							@endfor
						</div>

					</div>
					<div class="rateMain">
						@foreach($course->rating as $item)
							<div class="rateMainItem">
								<div class="rateMainItemAva">
									<div class="rateMainItemAvaImg" style="background: url('{{ asset('lib/storage/app/avatar/'.$item->acc->img) }}') no-repeat center /cover" >
										
									</div>
									<div class="rateMainItemAvaName">
										{{ $item->acc->name }}
									</div>
									<div class="rateMainItemAvaTime">

										{{ $item->updated_at == null ? time_format($item->created_at) : time_format($item->updated_at) }}
									</div>
								</div> 
								<div class="rateMainItemContent">
									<div class="rateMainItemContentStar">
										<div class="rateMainItemContentStarContent">

											@for($i=0;$i<5;$i++)
												@if($item->rat_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
									</div>
									<div class="rateMainItemContentBody">
										{{ $item->rat_content }}
									</div>
										
								</div>
							</div>
						@endforeach
						<div class="rateMainItem">
							<div class="rateMainItemAva">
								<div class="rateMainItemAvaImg" style="background: url('{{ asset('lib/storage/app/avatar/'.Auth::user()->img) }}') no-repeat center /cover" >
									
								</div>
								<div class="rateMainItemAvaName">
									{{ Auth::user()->name }}
								</div>
								
							</div> 
							<div class="rateMainItemContent">
								<div class="rateMainItemContentTitle">
									Nhận xét của bạn
								</div>
								<div class="rateMainItemContentStar">
									<div class="rateMainItemContentStarContent last">
										@for($i=0;$i<5;$i++)
											<i class="fa fa-star startLast" aria-hidden="true" value="{{ $i }}"></i>
										@endfor
									</div>
									<div class="rateMainItemContentStarText">
										(Đánh giá khóa học)
									</div>	
								</div>
									

								<div class="rateMainItemContentBody">
									<textarea class="" rows="5"></textarea>
								</div>
								<div class="cou_id" style="display: none;">{{ $course->cou_id }}</div>
								<div class="rateMainItemContentBtn">
									Nhận xét
								</div>
									
							</div>
						</div>


					</div>
				</div> 
			</div>
			<div class="col-md-1 col-sm-1"></div>
			<div class="col-md-4 col-sm-4">
				<div class="courseTag">
					<div class="courseTagDoc">
						<div class="courseTagDocTitle">
							Tài liệu
						</div>
						<div class="courseTagDocBody">
							@foreach($course->rating as $item)
							<div class="courseTagDocBodyItem">
								<div class="courseTagDocBodyItemIcon">
									<i class="fas fa-download"></i>
								</div>
								<a href="{{ asset('') }}" class="courseTagDocBodyItemContent">
									Các bài văn mẫu của giảng viên đại học ha - vớt
								</a>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('script')
	<script src="js/plugins/video.js"></script>
	<script type="text/javascript" src="js/courses/detail.js"></script>
@stop