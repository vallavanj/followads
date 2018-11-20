 <footer class="main-footer">
    <strong>Copyright &copy; 2014-2018 <a href="{{url('dashboard')}}">followads</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     <!-- <b>Version</b> 3.0.0-alpha-->
    </div>
  </footer>
   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<script>
  $.widget.bridge('uibutton', $.ui.button)
  
  $('a').on('click', function () {
  $(this).tooltip('hide')
  /* $('#sidebar').slide() // replace with slide animation */
})

$('button').on('click', function () {
  $(this).tooltip('hide')
  /* $('#sidebar').slide() // replace with slide animation */
})


/* $(function () {
    var isIE = window.ActiveXObject || "ActiveXObject" in window;
    if (isIE) {
        alert($('.modal').attr('class'));
    }
}); */

$(function () {
    var isIE = window.ActiveXObject || "ActiveXObject" in window;
    if (isIE) {
		$('.add_page,.edit').click(function(){
			/* alert( $('.modal').attr('class')); */
		/* 	$('.modal').removeClass('fade'); */
			 $('#modal-default_1').attr('style','display: block');
		});
		$('#status,.view').click(function(){
			/* alert( $('.modal').attr('class')); */
		/* 	$('.modal').removeClass('fade'); */
			 $('#modal-default').attr('style','display: block');
		});
		
		
		$('.close').click(function(){
			 $('.modal').attr('style','display: none');
		});
        $('.modal').removeClass('fade');
    }
});
</script>
