				
<section class="select-phone-apps">
	<div class="container">
		<h2 class="title-bar">Select Phones And Apps</h2>
		<div class="row">
			<div class="card-deck">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 4
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			
			 global $product;
				//wc_get_template_part( 'content', 'product' )
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
				
				 $attributes = $product->get_attributes();
				
					 
				?>

				
				<div class="card" class="col-md-3">
				  <img src="<?=$featured_img_url?>" class="card-img-top" alt="...">
				  <div class="card-body">
				  	<h5 class="card-title"><?=get_the_title()?></h5>
				    <p class="card-text">
						<ul id="product-attr" class="list-group feature-list flex-grow">
					<?php 
						
						 foreach ($attributes as $taxonomy => $attribute_obj ) {
							// Get the attribute label
							$attribute_label_name = wc_attribute_label($taxonomy);
							
							$product_values = $product->get_attributes($attribute_label_name)["attribute"]->get_data()['options'];
							
								/* echo "<pre>";
								print_r($product_values ); */
							
							  foreach ($product_values as $key => $value ) {
								 echo "<li>".$value."</li>";
							 } 
						}
					
					?>
					</ul>
					</p>
				    <hr>
				    <div class="form-group">
				    	<a href="?add-to-cart=<?=get_the_ID()?>" onclick="" class="add_to_cart">
						add to cart
				<i class="fas fa-cart-plus"></i>
			</a>
			<div class="flex-column border-top"><h1 class="feature-price"><?=$product->get_price();?></h1></div>
			
				    </div>
				  </div>
				</div>
			
				
				<?php 
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
	
			</div>
		</div>
	</div>
</section>



				
		

	

