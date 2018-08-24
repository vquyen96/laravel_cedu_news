@extends('frontend.master')
@section('title','Danh sách khóa học')
@section('fb_title','Top khóa học hàng đầu')
@section('fb_description','Nơi cung cấp cho bạn những khóa học tốt nhất, rẻ nhất. Tạo lên một môi trường học tập trên cuộc cách mạng công nghệ 4.0')
@section('fb_image',asset('public/layout/frontend/img/dayne-topkin-60559-unsplash.png'))
@section('main')
<link rel="stylesheet" href="css/owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="css/owlcarousel/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="css/course/course.css">
<div class="header_main">
	<div class="header_main_body">
		<a href="{{ asset('courses/'.Request::segment(2)) }}" class="header_main_item {{ Request::segment(3) != 'all' ? 'active' : '' }}">
			Chủ đề
		</a>
		<a href="{{ asset('courses/'.Request::segment(2).'/all') }}" class="header_main_item {{ Request::segment(3) == 'all' ? 'active' : '' }}">
			Tất cả các khoá học
		</a>
	</div>

</div>
<div class="instruction">
	
	<div class="instruction_body">
		<a href="{{ asset('courses') }}" class="instruction_item">
			Khóa học
		</a>
		<a class="instruction_item">
			>
		</a>
		<a href="{{ asset('courses'.Request::segment(2)) }}" class="instruction_item">
			Ngoại ngữ
		</a>
		<a class="instruction_item">
			>
		</a>
		<a href="{{ asset('courses'.Request::segment(2)) }}" class="instruction_item">
			Chủ đề
		</a>
		{{-- <a class="instruction_item">
			>
		</a> --}}
	</div>
					
			
</div>
<div class="main_body">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="carouselHeader">
					<div class="owl-carousel owl-theme groupChild">
						@foreach($group_child as $item)
						<div class="item">
							<div class="groupChildItem">
								<div  class="groupChildItemImg" style="background: url('{{ asset('lib/storage/app/group/'.$item->gr_img) }}') no-repeat center /cover ;">
									<span class="groupChildItemContent">
										<span class="bold">{{ $item->gr_name }}</span>
										<span>({{ $item->course->count() }})</span>
									</span>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="main_title">
					<h1>{{ $group->gr_name }}</h1>
					<div class="main_title_content">
						Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="carouselCourseTitle">
					<h2>Khoá học được mua nhiều nhất</h2>
					<div class="carouselCourseTitleContent">
						Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="carouselCourseMain">
					<div class="owl-carousel owl-theme carouselCourse1">
						@foreach($courseByMost as $item)
							<div class="item">
								<a href="{{ asset('courses/detail/'.$item->cou_slug.'.html') }}" class="courseMainItem">
									<div class="courseMainItemImg" style="background: url('{{ asset('lib/storage/app/course/'.$item->cou_img) }}') no-repeat center /cover;">
										@if ($item->cou_sale != 0)
											<div class="courseMainItemSale">
												{{$item->cou_sale}}%
											</div>
											
										@endif
										<div class="courseMainItemPrice">
											{{number_format($item->cou_price,0,',','.')}}
											<span class="courseMainItemTime">
												<i class="fa fa-circle" aria-hidden="true"></i>
												@if ($item->cou_price_old != null)
													<del>{{number_format($item->cou_price_old,0,',','.')}} đ</del>
												@endif
												{{-- {{time_format($item->updated_at)}} --}}
											</span>
											
										</div>
										
									</div>
									<div class="courseMainItemName">
										{{cut_string($item->cou_name , 100)}}
									</div>
									<div class="courseMainItemTeacher">
										<div class="courseMainItemTeacherAva" style="background: url('{{ asset('lib/storage/app/avatar/resized-'.$item->tea->img) }}') no-repeat center /cover;">
										</div>
										<div class="courseMainItemTeacherName">
											{{ $item->tea->name }}
										</div>
										<div class="courseMainItemStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="carouselCourseTitle">
					<h2>Khoá học mới ra mắt</h2>
					<div class="carouselCourseTitleContent">
						Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="carouselCourseMain">
					<div class="owl-carousel owl-theme carouselCourse1">
						@foreach($courseNewMost as $item)
							<div class="item">
								<a href="{{ asset('courses/detail/'.$item->cou_slug.'.html') }}" class="courseMainItem">
									<div class="courseMainItemImg" style="background: url('{{ asset('lib/storage/app/course/'.$item->cou_img) }}') no-repeat center /cover;">
										@if ($item->cou_sale != 0)
											<div class="courseMainItemSale">
												{{$item->cou_sale}}%
											</div>
											
										@endif
										<div class="courseMainItemPrice">
											{{number_format($item->cou_price,0,',','.')}}
											<span class="courseMainItemTime">
												<i class="fa fa-circle" aria-hidden="true"></i>
												@if ($item->cou_price_old != null)
													<del>{{number_format($item->cou_price_old,0,',','.')}} đ</del>
												@endif
												{{-- {{time_format($item->updated_at)}} --}}
											</span>
											
										</div>
										
									</div>
									<div class="courseMainItemName">
										{{cut_string($item->cou_name , 100)}}
									</div>
									<div class="courseMainItemTeacher">
										<div class="courseMainItemTeacherAva" style="background: url('{{ asset('lib/storage/app/avatar/resized-'.$item->tea->img) }}') no-repeat center /cover;">
										</div>
										<div class="courseMainItemTeacherName">
											{{ $item->tea->name }}
										</div>
										<div class="courseMainItemStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="carouselCourseTitle">
					<h2>Khoá học được đánh giá cao nhất</h2>
					<div class="carouselCourseTitleContent">
						Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="carouselCourseMain">
					<div class="owl-carousel owl-theme carouselCourse1">
						@foreach($courseVoteMost as $item)
							<div class="item">
								<a href="{{ asset('courses/detail/'.$item->cou_slug.'.html') }}" class="courseMainItem">
									<div class="courseMainItemImg" style="background: url('{{ asset('lib/storage/app/course/'.$item->cou_img) }}') no-repeat center /cover;">
										@if ($item->cou_sale != 0)
											<div class="courseMainItemSale">
												{{$item->cou_sale}}%
											</div>
											
										@endif
										<div class="courseMainItemPrice">
											{{number_format($item->cou_price,0,',','.')}}
											<span class="courseMainItemTime">
												<i class="fa fa-circle" aria-hidden="true"></i>
												@if ($item->cou_price_old != null)
													<del>{{number_format($item->cou_price_old,0,',','.')}} đ</del>
												@endif
												{{-- {{time_format($item->updated_at)}} --}}
											</span>
											
										</div>
										
									</div>
									<div class="courseMainItemName">
										{{cut_string($item->cou_name , 100)}}
									</div>
									<div class="courseMainItemTeacher">
										<div class="courseMainItemTeacherAva" style="background: url('{{ asset('lib/storage/app/avatar/resized-'.$item->tea->img) }}') no-repeat center /cover;">
										</div>
										<div class="courseMainItemTeacherName">
											{{ $item->tea->name }}
										</div>
										<div class="courseMainItemStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>	

		<div class="row">
			<div class="col-12">
				<div class="teacherTitle">
					<h2>Top giảng viên</h2>
					<div class="teacherTitleContent">
						Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="teacherCarousel">
					<div class="owl-carousel owl-theme teacherCarouselMain">
						@foreach($teacher as $item)
						<div class="item">
							<div class="teacherCarouselItem">
								<div  class="teacherCarouselItemImg" style="background: url('{{ asset('lib/storage/app/avatar/'.$item->acc->img) }}') no-repeat center /cover ;">
								</div>
								<div class="teacherCarouselItemName">
									{{ $item->acc->name }}
								</div>
								<div class="teacherCarouselItemGroup">
									Giao tiếp, Ielts
								</div>
								<div class="teacherCarouselItemNumCourse">
									{{ $item->acc->course->count() }} bài giảng
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section('script')
<script src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/courses/group.js"></script>
@stop