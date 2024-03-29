<?php

class Elementor_Post_Last_PastPost_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "PastPost_Post_Last";
	}

	public function get_title() {
		return __( "Post Last • PastPost", 'pastpostelementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return array( 'general' );
	}


	protected function render() {

		if ( ! function_exists( "estimateReadingTime" ) ) {
			function estimateReadingTime( $text = "", $wpm = 200 ) {
				$totalWords = str_word_count( strip_tags( $text ) );
				$minutes    = floor( $totalWords / $wpm );
				$seconds    = floor( $totalWords % $wpm / ( $wpm / 60 ) );

				return sprintf( "%s min lectura", $minutes );
			}
		}

		?>
        <div class="post post__last">
            <div class="row d-flex align-items-center">
				<?php

				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 1,
					'paged'          => - 1,
					'orderby'        => "date",
					'order'          => "DESC",
					'meta_query'     => array(
						array(
							'key'   => 'order',
							'value' => 'last',
						)

					)
				);


				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {

					while ( $query->have_posts() ) {
						$query->the_post();


						$img_url       = get_the_post_thumbnail_url( get_the_ID(), 'large' );
						$link          = get_permalink( get_the_ID() );
						$get_author_id = get_the_author_meta( 'ID' );
						?>
                        <div class="col-md-6 col-sm-12">
                            <div class="post__last--right">
                                <div class="post__last--title">
                                    <a href="<?php echo esc_url( $link ); ?>">
                                        <h1>
<<<<<<< HEAD
											<?php echo mb_strimwidth( get_the_title(), 0, 70, "..." ); ?>
=======
											<?php echo mb_strimwidth( get_the_title(), 0, 50, "..." ); ?>
>>>>>>> 9a2101edf2e7d9060c7cfc61a9ff9a0f50bfa837
                                        </h1>

                                    </a>
                                </div>
                                <div class="post__last--desc">
                                    <p><?php echo mb_strimwidth( get_the_excerpt(), 0, 120, '' ); ?>
                                        <a class="read_more"
                                           href="<?php echo esc_url( $link ) ?>"><?php _e( "Lectura", "pastpostelementor" ); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="post__last--top">
                                <div class="post__last--img">
                                    <a href="<?php echo esc_url( $link ); ?>">
                                        <img src="<?php echo $img_url; ?>" alt="">
                                    </a>
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