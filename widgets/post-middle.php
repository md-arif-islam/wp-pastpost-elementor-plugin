<?php

class Elementor_Post_Middle_PastPost_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "PastPost_Post_Middle";
	}

	public function get_title() {
		return __( "Post Middle • PastPost", 'pastpostelementor' );
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
        <div class="post">
            <div class="row">
				<?php

				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => - 1,
					'paged'          => - 1,
					'orderby'        => "date",
					'order'          => "DESC",
					'meta_query'     => array(
						array(
							'key'   => 'order',
							'value' => 'middle',
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
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="posts__card d-flex align-items-stretch">
                                <div class="posts__card--top">
                                    <div class="posts__card--img">
                                        <a href="<?php echo esc_url( $link ); ?>">
                                            <img src="<?php echo $img_url; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="posts__card--date">
                                        <p class="date"><?php echo get_the_time( "j M, Y" ) ?></p>
                                    </div>

                                </div>
                                <div class="posts__card--second">
                                    <div class="posts__card--author">
                                        <div class="avater">
                                            <img class="rounded-circle"
                                                 src="<?php echo get_avatar_url( $get_author_id ) ?>"
                                                 alt="">
                                        </div>
                                        <div class="credit">
                                            <p class="author"><?php _e( "Autor", "pastpostelementor" ) ?></p>
                                            <p class="name"><?php the_author_meta( "display_name" ) ?></p>
                                        </div>
                                    </div>
                                    <div class="posts__card--read">
                                        <p class="rtime"><?php echo estimateReadingTime( get_the_content() ) ?></p>
                                    </div>
                                </div>
                                <div class="posts__card--title">
                                    <a href="<?php echo esc_url( $link ); ?>">
                                        <h1>
											<?php echo mb_strimwidth( get_the_title(), 0, 30, "..." ); ?>
                                        </h1>

                                    </a>
                                </div>
                                <div class="posts__card--desc">
                                    <p><?php echo mb_strimwidth( get_the_excerpt(), 0, 90, '' ); ?>
                                        <a class="read_more"
                                           href="<?php echo esc_url( $link ) ?>"><?php _e( "Lectura", "pastpostelementor" ); ?></a>
                                    </p>
                                </div>
                                <div class="posts__card--bottom">

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