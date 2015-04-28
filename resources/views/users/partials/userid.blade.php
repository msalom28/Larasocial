@if(Auth::check())
	<script> 
		var userId = <?php echo Auth::user()->id; ?>;
		var chatStatus = <?php echo Auth::user()->chatstatus; ?>;
		var userFirstname = <?php echo json_encode(Auth::user()->firstname); ?>;
		var userProfileImage = <?php echo json_encode(Auth::user()->profileimage); ?>;
	</script>
@endif
