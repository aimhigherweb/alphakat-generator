<?php

$word = strtolower($_POST['text']);
$word_letters = str_split($word);

$classes = '';

if($word == '') {
	$word = false;
	$classes = 'empty';
}

$posts = get_posts(array(
	'post_type' => 'letters',
	'post_name__in' => $word_letters,
	'post_status' => 'publish',
	'numberposts' => 9,
	'orderby' => 'post_name__in'
));

$themes = [
	"beach",
	"nature",
	"architecture",
];

$letters = array();

foreach($word_letters as $letter) {
	array_filter($posts, function ($post) use ($letter, &$letters) {
		if($letter == $post->post_name) {
			array_push($letters, $post);
			return true;
		}
		else {
			return false;
		}
	});
}

?>	

<?php if(strpos($_SERVER['REQUEST_URI'], 'your-design')): ?>

<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="design" class="product-form">
		<input type="hidden" name="action" value="add_art" />

		<input type="hidden" name="text" maxlength="9" value="<?php echo $word; ?>" />

		

		<div class="letters fieldset">
			<div class="mobile-warning">
				Your screen isn't wide enough to show your artwork, try rotating your device or using a larger screen.
			</div>

			<?php for ($i = 0; $i<count($letters); $i++): 
				$post = $letters[$i];
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

					<div class="tags">
						<legend>Theme: </legend>
						<ul>
							<li>
								<input 
									type="radio"
									id="all<?php echo $i; ?>"
									value="all"
									name="theme<?php echo $i; ?>"
									checked
								/>
								<label for="all<?php echo $i; ?>" class="radio" data-theme="all" data-letter-index="<?php echo $i; ?>">All</label>
							</li>
							<?php foreach($themes as $theme): ?>
								<li>
									<input 
										type="radio"
										id="<?php echo $theme; ?><?php echo $i; ?>"
										value="<?php echo $theme; ?>"
										name="theme<?php echo $i; ?>"
										
									/>
									<label
										for="<?php echo $theme; ?><?php echo $i; ?>" 
										data-letter-index="<?php echo $i; ?>"
										   data-theme="<?php echo $theme; ?>"
										class="radio"
									><?php echo $theme; ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="options" data-letter-index="<?php echo $i; ?>">
						<?php foreach ($images as $image): 
							$tags = get_field('image_category', $image['ID']);

							if(!$tags) {
								$tags = [];
							}
						?>
						
							<button 
								type="button" 
								onclick="chooseImage('<?php echo $image['ID']; ?>', '<?php echo $image['url']; ?>', '<?php echo $i; ?>')"
								class="<?php echo join(" ", $tags) ?>"
							>
								<img src="<?php echo $image['url']; ?>" />
							</button>
						
						<?php endforeach; ?>
					</div>
				</div>

			<?php endfor; ?>

		</div>

		<div class="boards fieldset">
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
			
		</div>

		<p class="instruct">Click on a letter to change it</p>

		<div class="colour fieldset">
			<input type="radio" name="bw" id="bw" value="bw" />
			<label class="radio" for="bw">
				Black and White
			</label>
			<input type="radio" name="bw" id="colour" value="colour" checked />
			<label class="radio" for="colour">
				Colour
			</label>
		</div>

		<input type="submit" value="Add to Cart" />

	</form>

<?php endif; ?>