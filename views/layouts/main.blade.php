<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{$name}} &raquo; {{$title}}</title>
	{{Asset::styles()}}
	{{Asset::scripts()}}
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/admin">{{$name}}</a>
				<ul class="nav">
					<li>
						<a href="/admin">Dashboard</a>
					</li>
					@if(!empty($models))
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Models
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							@foreach($models as $model)
							<li>
								<a href="/admin/models/{{$model}}">{{$model}}</a>
							</li>
							@endforeach
						</ul>
					</li>
					@endif
				</ul>
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							{{Auth::user()->name}}
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/admin/login/logout"><i class="icon-off"></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="well well-white main-cont">
			{{$content}}
		</div>
		<footer id="page-footer">
			Adminify from Cocoon
		</footer>
	</div>
</body>
</html>