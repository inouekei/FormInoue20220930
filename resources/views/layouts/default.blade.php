<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <style>
    .content{
    	display: flex;
        justify-content: center;
    }
    .h1-main{
    	text-align: center;
    }
    .btn-main{
    	width: 60px;
        border-radius: 5px;
        background-color: black;
        color: white;
    } 
    .btn-big{
    	width: 200px;
        height: 50px;
    } 
    .form-main{
    	display: flex;
        flex-direction: column;
        align-content: center;
    }
    .th-main{
    	text-align: left;
        valign: top;
    }
	.div-center-wrapper{
    display: flex;
    justify-content: center;
		text-align: center;
    }    
  </style>
</head>
<body>
  <div class="content">
    @yield('content')
  </div>
</body>
@yield('scripts')
</html>