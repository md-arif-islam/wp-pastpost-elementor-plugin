<?php

class Elementor_Slider_New_PastPost_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "PastPost_Slider_New";
	}

	public function get_title() {
		return __( "Slider New • PastPost", 'pastpostelementor' );
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
            <div class="owl-carousel owl-theme featured__hslider">
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

                        <div class="row featured__card flex-md-row-reverse">
                            <div class="col-md-6">
                                <div class="featured__card--img">
<<<<<<< HEAD
                                    <img src="<?php echo $img_url ?>" alt="" loading="lazy"/>
=======
                                    <img src="<?php echo $img_url ?>" alt=""/>
>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured__card--body">
									<?php if ( get_field( 'subtitle' ) ): ?>
                                        <h6><?php the_field( 'subtitle' ); ?></h6>
									<?php endif; ?>
                                    <h2><?php the_title() ?></h2>
									<?php the_content() ?>
                                </div>
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