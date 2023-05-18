<meta charset="UTF-8">
<meta name="description" content="Ogani Template">
<meta name="keywords" content="Ogani, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield("title", "Organic")</title>
<base href="/"/>
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
@yield("before_css")
<link rel="stylesheet" href="{{ asset('ace/css/bootstrap.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('ace/css/style.css') }}" type="text/css">
@yield("after_css")
