	<?php wp_footer(); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	(function($) {
	    $(document).ready(function() {
	        var idcount = 1;
	        $('.xoxo').children().each(function() {
	        	$(this).append('<a class="myhover"></a>');
	            $(this).addClass('classname');
	            $(this).attr('id', 'idname-'+idcount);
	            var index = $('.xoxo li').index($(this));
	            var a_href = $('.xoxo li a').eq(index-1).attr('href');
	            console.log(a_href);
	            $('.xoxo li a.myhover').attr('href', a_href );
	            idcount++;
	        });
	    });
	})(jQuery);
	</script>
</body>
</html>