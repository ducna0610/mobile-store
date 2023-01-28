
<footer class="footer">
	<div class="container-fluid">
		<nav class="pull-left">
			<ul>
				<li>
					<a href="http://www.creative-tim.com">
						Creative Tim
					</a>
				</li>
				<li>
					<a href="http://blog.creative-tim.com">
						Blog
					</a>
				</li>
				<li>
					<a href="http://www.creative-tim.com/license">
						Licenses
					</a>
				</li>
			</ul>
		</nav>
		<div class="copyright pull-right">
			&copy; 
			2022
			@if (date('Y') != 2022)
				- {{ date('Y') }}
			@endif
			, made with <i class="fa fa-heart heart"></i> by <a href="">{{ config('app.name') }}</a>
		</div>
	</div>
</footer>