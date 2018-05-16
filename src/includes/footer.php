<!-- footer -->
<button onclick="topFunction()" id="ng-btn-top">
	<span class="glyphicon glyphicon-chevron-up"></span>
</button>

<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
	<div class="row">
		<footer class="footer">
			<div class="ng-footer">
				<p class="text-center"> Ngpictures &copy;<?= date("M-Y")?> </p>
			</div>
		</footer>
	</div>
</div>

<script type="text/javascript">

	window.onscroll = function(){scrollFunction()};

		function scrollFunction()
		{
			if(document.body.scrollTop > 200 || document.documentElement.scrollTop > 200 ){
				document.querySelector('#ng-btn-top').style.opacity = "1";
			}
			else{
				document.querySelector('#ng-btn-top').style.opacity="0";
			}
		}
		function topFunction(){
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}

</script>
<!-- / footer -->