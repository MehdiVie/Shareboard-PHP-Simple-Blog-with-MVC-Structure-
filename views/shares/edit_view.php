<div>
    <?php if (isset($_SESSION['is_logged_in'])) : ?>
        <div class="well mt-5">
        <?php 
        
        if (!empty($viewmodel['share'])) : ?>
            <?php 
            $item = $viewmodel['share'];
            
            if ( (string)($viewmodel['edit']) ==='0' ) : 

            	?> 
                <h3><?php echo $item['title']; ?></h3>
                <h5>(by: <?php echo $item['user'] ?>)</h5>
                <small><?php echo $item['create_date']; ?></small>
                <hr />
                <p><?php echo $item['body']; ?></p>
                <br />
                <?php if (isset($_SESSION['user_data']['id']) && ($_SESSION['user_data']['id'] == $item['user_id'])) : ?>
                    <form action="<?php echo ROOT_PATH; ?>shares/delete" method="post">
                        <input type="hidden" name="postId" value="<?php echo $item['id']; ?>">
                        <input type="submit" class="btn btn-danger" value="Delete? Sure?">
                    </form>
                <?php endif; ?>
            
            <?php else : ?>
            	<?php if (isset($_SESSION['user_data']['id']) && ($_SESSION['user_data']['id'] == $item['user_id'])) : ?>
            	<div class="panel-body">
				    <form method="post" action="<?php echo ROOT_PATH; ?>shares/edit">
				    	<input type="hidden" name="postId" value="<?php echo $item['id']; ?>">
				    	<div class="form-group">
				    		<label>Share Title</label>
				    		<input type="text" name="title" class="form-control" value="<?php echo $item['title']; ?>" />
				    	</div>
				    	<div class="form-group">
				    		<label>Body</label>
				    		<textarea name="body" class="form-control" rows="7"><?php echo $item['body']; ?></textarea>
				    	</div>
				    	<div class="form-group">
				    		<label>Link</label>
				    		<input type="text" name="link" class="form-control" value="<?php echo $item['link']; ?>" />
				    	</div>
				    	<br>
				    	<input class="btn btn-primary" name="submit" type="submit" value="Save" />
				        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>shares">Cancel</a>
				    </form>
  				</div>
  				<?php endif; ?>
            <?php endif; ?>
        <?php else : ?>
            <h3>Post not found or you don't have permission.</h3>
        <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
