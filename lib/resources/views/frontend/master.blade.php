<!DOCTYPE html>
<html>
<head>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-123557478-1');
	</script>
	<title>@yield('title')</title>


	<base href="{{asset('public/layout/frontend')}}/">
	<link rel="shortcut icon" href="{{ asset('public/layout/frontend/img/BUT.png') }}">
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta property="og:url" 		content="{{Request::url()}}" />

	<meta property="fb:app_id" 		content="1577563652342523" />
	<meta property="og:title" 		content="@yield('fb_title')" />
	<meta property="og:description" content="@yield('fb_description')" />
    <meta property="og:image" 		content="@yield('fb_image')" />
    <meta property="og:image:type" 	content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    {{-- <meta property="og:url" content="https://developers.zalo.me/" />
	<meta property="og:title" content="Zalo For Developers" />
	<meta property="og:image" content="https://developers.zalo.me/web/static/prodution/zalo.png" />
	<meta property="og:description" content="Trang thông tin về Zalo dành cho cộng đồng lập trình viên" />  --}}

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	{{-- <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:500|Roboto:400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/master.css">
	<link rel="stylesheet" type="text/css" href="css/layout/header.css">
	<link rel="stylesheet" type="text/css" href="css/layout/footer.css">
</head>

<body>
	<div class="currentUrl" style="display: none;">{{ asset('') }}</div>
	
	<div id="status">
	</div>
	
	<div class="masterError">
		<div class="masterErrorContent">
			@include('errors.note')
		</div>
	</div>
	<div class="loadingPage">
		<div class="loadingPageIcon">
			<img src="img/Pacman-0.8s-200px.gif">
		</div>
	</div>
	<input type="hidden" name="url" value="{{ asset('')}}">
   
	{{-- <div class="btnScrollTop">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</div> --}}
	@include('frontend.layout.header')
	
	


	{{-- <div class="giftShow">
		<div class="giftShowTop">
			<img src="img/king.png">
			<span class="giftShowTopContent">
				Nhận quà hấp dẫn từ Cedu
			</span>
			

		</div>
		<div class="giftShowBot">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</div>
	</div>
	<div class="giftHide">
		<div class="giftHideBtn">
			<div class="giftHideBtnLine"></div>
		</div>
		<div class="giftHideTitle">
			Nhận kho tài liệu khủng từ Cedu
		</div>
		<form method="post" action="{{ asset('gift') }}">
			<input type="email" name="email" class="giftHideInput" placeholder="Email">
			<input type="submit" name="sbm" class="giftHideSubmit" value="Gửi">
			{{csrf_field()}}
		</form>
	</div>  --}}
	<main>
		@yield('main')
	</main>

	@include('frontend.layout.footer')
	
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/master2.js"></script>
	<script type="text/javascript" src="js/index/index.js"></script>
	@yield('script')

	
	</script>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1577563652342523',
	      xfbml      : true,
	      version    : 'v2.12'
	    });
	    FB.AppEvents.logPageView();
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "https://connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>	
	
</body>
</html>