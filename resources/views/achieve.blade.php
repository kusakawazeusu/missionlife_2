@section('achievement')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

// some jquery here
$(document).ready(function(){
	$('.achieve').delay(5000).fadeOut();
});

</script>

<style type="text/css">

.achieve {
	margin: 50px;
	height:300px;
	width:500px;
	background-color:#3c76e7;
	border-radius: 15px;
}

</style>

<div class="achieve">

</div>
@endsection
