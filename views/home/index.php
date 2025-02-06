
<div class="container d-flex flex-column justify-content-center align-items-center text-center center-content">
	<div class="text-center">
		<h1>Welcome To ShareBoard</h1>
		<p class="lead">Find something cool? Share it with our community. Look at other shares as well</p>
		<!--<a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>shares">Share Now</a>-->
	</div>
</div>
<div>
	<?php if (isset($_SESSION['is_logged_in'])) : ?>
		<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>shares/add">Share Something</a>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well mt-5">
			<h3><?php echo $item['title']; ?></h3><h5>(by: <?php echo $item['user'] ?>)</h5>
			<small><?php echo $item['create_date']; ?></small>
			<hr />
			<p><?php echo $item['body']; ?></p>
			<p>
			<a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['link']; ?></a>
			</p>
			<br />
			<?php if ( isset($_SESSION['user_data']['id']) && ($_SESSION['user_data']['id']==$item['user_id']) ) : ?>
				<div class="container d-flex gap-2">
					<form action="<?php echo ROOT_PATH; ?>shares/edit_view" method="post">
						<input type="hidden" name="controller" value="shares">
	    				<input type="hidden" name="action" value="edit_view">
	    				<input type="hidden" name="edit_mode" value="true">
	    				<input type="hidden" name="postId" value="<?php echo $item['id']; ?>">
						<input type="submit" class="btn btn-warning" value="Edit">
					</form>
					<form action="<?php echo ROOT_PATH; ?>shares/edit_view" method="post">
						<input type="hidden" name="controller" value="shares">
	    				<input type="hidden" name="action" value="edit_view">
	    				<input type="hidden" name="postId" value="<?php echo $item['id']; ?>">
						<input type="submit" class="btn btn-danger" value="Delete">
					</form>
				</div>
			<?php endif; ?>
			
		</div>
	<?php endforeach; ?>
</div>