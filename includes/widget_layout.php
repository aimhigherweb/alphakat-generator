<?php

$word = strtolower($_POST['text']);
$letters = str_split($word);

$classes = '';

if($word == '') {
	$word = false;
	$classes = 'empty';
}

$posts = get_posts(array(
	'post_type' => 'letters',
	'post_name__in' => $letters,
	'post_status' => 'publish',
	'numberposts' => 9,
	'orderby' => 'post_name__in'
));

// var_dump($posts)

?>

<div class="alphakat_generator <?php echo $classes; ?>">

	<form action="/#design" method="post" id="design">
		<legend>Create Your Own Art</legend>

		<input id="text" type="text" name="text" maxlength="9" value="<?php echo $word; ?>" />

		<input type="submit" value="Go">
	</form>

	<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="create" class="product-form">
		<input type="hidden" name="action" value="add_art" />

		<input type="hidden" name="text" maxlength="9" value="<?php echo $word; ?>" />

		<fieldset class="letters">
			<?php for ($i = 0; $i<count($posts); $i++): 
				$post = $posts[$i];
				$images = get_field('letters', $post->ID);	
			?>

				<input 
					type="hidden"
					name="letters[]" 
					data-index="<?php echo $i; ?>"
					value="<?php echo $images[0]['ID']; ?>"
				/>
				<button 
					type="button" 
					onclick="changeImage('<?php echo $i; ?>')" 
					data-index="<?php echo $i; ?>"
				>
					<img src="<?php echo $images[0]['url']; ?>" />
				</button>

				<div data-index="<?php echo $i; ?>" class="lightbox">
					<button type="button" class="close" onclick="closeLightbox('<?php echo $i; ?>')"><span>Close</span></button>
					<h2>Click to Select Image</h2>
					<div class="options">
						<?php foreach ($images as $image): ?>
						
							<button 
								type="button" 
								onclick="chooseImage('<?php echo $image['ID']; ?>', '<?php echo $image['url']; ?>', '<?php echo $i; ?>')"
							>
								<img src="<?php echo $image['url']; ?>" />
							</button>
						
						<?php endforeach; ?>
					</div>
				</div>

			<?php endfor; ?>

		</fieldset>

		<fieldset class="boards">
			<input type="radio" name="board" id="white" value="white" checked />
			<label for="white" data-colour="white">
				White Board
			</label>

			<input type="radio" name="board" id="black" value="black" />
			<label for="black" data-colour="black">
				Black Board
			</label>
			
			<input type="radio" name="board" id="navy" value="navy" />
			<label for="navy" data-colour="navy">
				Navy Board
			</label>
			
		</fieldset>

		<fieldset class="colour">
			<input type="checkbox" name="bw" id="bw" value="bw" />
			<label for="bw">
				Black and White
			</label>
		</fieldset>

		<input type="submit" value="Add to Cart" />

	</form>

</div>