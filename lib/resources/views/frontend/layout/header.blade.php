
<header>
	<div class="headerLeft">
		<div class="headerLeftLogo">
			<a href="{{ asset('') }}">
				<img src="img/LOGO_CEDU1.png">
			</a>
		</div>

		<div class="headerLeftItem">
			<a href="{{ asset('courses') }}">
				Khóa học
			</a>
		</div>
		<div class="headerLeftItem {{ Request::segment(1) != '' ? 'd-none' : '' }}">
			<a href="{{ asset('courses') }}">
				Tài liệu
			</a>
		</div>
		<div class="headerLeftItem {{ Request::segment(1) != '' ? 'd-none' : '' }}">
			<a href="{{ asset('courses') }}">
				Tin tức
			</a>
		</div>
		<div class="headerLeftItem {{ Request::segment(1) != '' ? 'd-none' : '' }}">
			<a href="{{ asset('courses') }}">
				Trở thành đối tác
			</a>
		</div>
		<div class="headerLeftItem {{ Request::segment(1) == '' ? 'd-none' : '' }} searchHeader">
			<form>	
				<input type="text" name="" class="inputSearchHead" placeholder="Search">
			</form>
		</div>

	</div>

	<div class="headerRight">
		
		<div class="headerRightItem cart" >
			<a href="{{ asset('cart/show') }}">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			</a>
			@if(Cart::count() > 0)
			<div class="headerRightItemNum">
				{{ Cart::count() }}
			</div>
			@endif
		</div>
		<div class="headerRightItem noti">
			<a href="">
				<i class="fa fa-bell" aria-hidden="true"></i>
			</a>
		</div>
		<div class="headerRightItem codeActive">
			<a href="{{ asset('code') }}">
				Kích hoạt mã code
			</a>
		</div>
		@if(Auth::check())
			<div class="headerRightItem ">
				<a href="{{ asset('user') }}">
					{{ Auth::user()->name }}
				</a>
			</div>
			<div class="headerRightItem ava">
				<a href="{{ asset('user') }}" style="background: url('{{ asset('lib/storage/app/avatar/resized-'.Auth::user()->img) }}') no-repeat center /cover">
				</a>
			</div>


		@else
			<div class="headerRightItem login">
				<a href="{{ asset('login') }}">
					Đăng nhập
				</a>
			</div>
			<div class="headerRightItem register">
				<a href="{{ asset('login') }}">
					Đăng ký
				</a>
			</div>
		@endif
	</div>
</header>