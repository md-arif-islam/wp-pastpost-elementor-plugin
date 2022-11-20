<?php

class Elementor_Slider_PastPost_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "PastPost_Slider";
	}

	public function get_title() {
		return __( "Slider • PastPost", 'pastpostelementor' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function register_controls() {

	}


	protected function render() {

		?>
        <div class="featured">
            <div class="owl-carousel owl-theme featured__slider">
	            <?php

	            $args = array(
		            'post_type'      => 'slider',
		            'posts_per_page' => - 1,
		            'orderby'        => "date",
		            'order'          => "ASC",
	            );


	            $query = new WP_Query( $args );

	            if ( $query->have_posts() ) {

		            while ( $query->have_posts() ) {
			            $query->the_post();


			            $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			            ?>
                        <div class="featured__card">
                            <div class="featured__card--img">
                                <img src="<?php echo $img_url?>" alt="">
                            </div>
                            <div class="featured__card--body">
                                <h2><?php the_title() ?></h2>
                               <?php the_content() ?>
                            </div>
                        </div>
			            <?php
		            }
	            }
	            wp_reset_query();
	            ?>

            </div>
        </div>
		<?php

	}

}