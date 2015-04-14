@if(Auth::check())
	<script> 
		var userId = <?php echo Auth::user()->id; ?>;
		var chatStatus = <?php echo Auth::user()->chatstatus; ?>;
		var userFirstname = <?php echo json_encode(Auth::user()->firstname); ?>;
		var userProfileImage = <?php echo json_encode(Auth::user()->profileimage); ?>;
		console.log(chatStatus);
		console.log(userId);
		console.log(userFirstname);
	</script>
@endif
