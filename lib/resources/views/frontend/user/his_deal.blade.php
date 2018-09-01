@extends('frontend.master')
@section('title','Lịch sử giao dịch')
@section('main')
<link rel="stylesheet" type="text/css" href="css/user/top_user.css">

<section id="body">
	<div class="container">
		<div class="heading">
			<h1>Lịch sử giao dịch</h1>
			<p>Chúng tôi cung cấp cho các bạn những khoá học đa dạng và chất lượng nhất</p>
		</div>
		<div id="list">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><p class="tieu-de">#</p></th>
						<th><p class="tieu-de">Avatar</p></th>
						<th><p class="tieu-de">Tên khóa học</p></th>
						<th><p class="tieu-de">Giá</p></th>
						<th><p class="tieu-de">Trạng thái</p></th>
						<th><p class="tieu-de">Ngày</p></th>
					</tr>
				</thead>

				<tbody>
					@foreach($orderDeTable as $key=>$item)
					<tr>
						<td>
							<p>{{$item->orderDe_id}}</p>
						</td>
						<td>
							<div class="image">
								<img src="{{asset('lib/storage/app/course/'.$item->course->cou_img)}}">
							</div>
						</td>
						<td>
							<p>{{cut_string($item->course->cou_name, 60)}}</p>
						</td>
						<td>
							<p>{{number_format($item->course->cou_price,0,',','.')}} VND</p>
						</td>
						<td>
							<p>@if($item->order->ord_status == 0) Xong @else Chưa @endif</p>
						</td>
						<td>
							<p>{{$item->created_at->format('h:m d/m/Y')}}</p>
						</td>
					</tr>
					@endforeach
					

				</tbody>
			</table>
			
		</div>
		{!! $orderDeTable->links('layout.paginate') !!}
	</div>
</section>

@stop
@section('script')

@stop