@extends('frontend.master')
@section('title','Top thành viên')
@section('main')
<link rel="stylesheet" type="text/css" href="css/user/top_user.css">

<section id="body">
	<div class="container">
		<div class="heading">
			<h1>Top các cộng tác viên nổi bật</h1>
			<p>Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất</p>
		</div>
		<div id="list">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><p class="tieu-de">#</p></th>
						<th><p class="tieu-de">Avatar</p></th>
						<th><p class="tieu-de">Tên</p></th>
						<th><p class="tieu-de">Số đơn</p></th>
						<th><p class="tieu-de">Thu nhập</p></th>
					</tr>
				</thead>

				<tbody>

					<tr>
						<td>
							<p>1</p>
						</td>
						<td>
							<div class="img">
								<img src="http://sohanews.sohacdn.com/thumb_w/660/2017/photo1486969199024-1486969199175-0-32-308-529-crop-1486969281069.jpg">
							</div>
						</td>
						<td>
							<p>Cao T. Linh</p>
						</td>
						<td>
							<p>1234</p>
						</td>
						<td>
							<p>1234</p>
						</td>
					</tr>

					<tr>
						<td>
							<p>1</p>
						</td>
						<td>
							<div class="img">
								<img src="http://sohanews.sohacdn.com/thumb_w/660/2017/photo1486969199024-1486969199175-0-32-308-529-crop-1486969281069.jpg">
							</div>
						</td>
						<td>
							<p>Cao T. Linh</p>
						</td>
						<td>
							<p>1234</p>
						</td>
						<td>
							<p>1234</p>
						</td>
					</tr>

					<tr>
						<td>
							<p>1</p>
						</td>
						<td>
							<div class="img">
								<img src="http://sohanews.sohacdn.com/thumb_w/660/2017/photo1486969199024-1486969199175-0-32-308-529-crop-1486969281069.jpg">
							</div>
						</td>
						<td>
							<p>Cao T. Linh</p>
						</td>
						<td>
							<p>1234</p>
						</td>
						<td>
							<p>1234</p>
						</td>
					</tr>

				</tbody>
			</table>
			{{-- {!! $top_user->links('layout.paginate') !!} --}}
		</div>
	</div>
</section>

@stop
@section('script')

@stop