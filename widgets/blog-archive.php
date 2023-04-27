<?php

class Elementor_Blog_Archive_PastPost_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return "PastPost_BlogArchive";
	}

	public function get_title() {
		return __( "Blog Archive • PastPost", 'pastpostelementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'options_section',
			[
				'label' => __( 'Options', 'pastpostelementor' ),
			]
		);

		/*$this->add_control(
		'category',
		[
		'label'   => __( 'Category', 'pastpostelementor' ),
		'type'    => \Elementor\Controls_Manager::SELECT,
		'options' => ( 'slide-types' ),
		'default' => "",
		]
		);*/

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'pastpostelementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date'  => __( 'Date', 'pastpostelementor' ),
					'title' => __( 'Title', 'pastpostelementor' ),
					'rand'  => __( 'Random', 'pastpostelementor' ),
				),
				'default' => "date",
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'pastpostelementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC'  => __( 'Ascending', 'pastpostelementor' ),
					'DESC' => __( 'Descending', 'pastpostelementor' ),
				),
				'default' => "DESC",
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'advanced_section',
			[
				'label' => __( 'Advanced', 'pastpostelementor' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => __( 'Style', 'pastpostelementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					''            => __( 'Default', 'pastpostelementor' ),
					'flat'        => __( 'Flat', 'pastpostelementor' ),
					'description' => __( 'Flat with title and description', 'pastpostelementor' ),
					'carousel'    => __( 'Flat carousel with titles', 'pastpostelementor' ),
					'center'      => __( 'Center mode', 'pastpostelementor' ),
				),
				'default' => '',
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'pastpostelementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					''            => __( 'Default', 'pastpostelementor' ),
					'hide-arrows' => __( 'Hide Arrows', 'pastpostelementor' ),
					'hide-dots'   => __( 'Hide Dots', 'pastpostelementor' ),
					'hide'        => __( 'Hide', 'pastpostelementor' ),
				),
				'default' => '',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		if ( ! function_exists( "estimateReadingTime" ) ) {
			function estimateReadingTime( $text = "", $wpm = 200 ) {
				$totalWords = str_word_count( strip_tags( $text ) );
				$minutes    = floor( $totalWords / $wpm );
				$seconds    = floor( $totalWords % $wpm / ( $wpm / 60 ) );

				return sprintf( "%s min read", $minutes );
			}
		}

		?>

        <div class="blog row">

			<?php
			$category      = get_the_category();
			$category_slug = $category[0]->slug;

			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => - 1,
				'paged'          => - 1,
				'orderby'        => "date",
				'order'          => "DESC",
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $category_slug,
					),
				),
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {

				while ( $query->have_posts() ) {
					$query->the_post();

					$img_url       = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					$link          = get_permalink( get_the_ID() );
					$get_author_id = get_the_author_meta( 'ID' );
					?>
                    <div class="col-md-6">
                        <div style="height: 90%!important;" class="blogs__card d-flex align-items-stretch">
                            <div class="blogs__card--top">
                                <div class="blogs__card--img">
                                    <a href="<?php echo esc_url( $link ); ?>"><img src="<?php echo $img_url; ?>" alt=""></a>
                                </div>
                                <div class="blogs__card--author">
                                    <div class="credit">
                                        <p class="author"><?php _e( "Autor", "pastpostelementor" ) ?></p>
                                        <p class="name"><?php the_author_meta( "display_name" ) ?></p>
                                    </div>
                                    <div class="avater">
                                        <img class="rounded-circle"
                                             src="<?php echo get_avatar_url( $get_author_id ) ?>"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="blogs__card--title">
                                <a href="<?php echo esc_url( $link ) ?>"><h1><?php the_title() ?></h1></a>
                            </div>
                            <div class="blogs__card--desc">
                                <p>
									<?php
									$read_more = __( "Lectura", "pastpostelementor" );
									echo mb_strimwidth( get_the_excerpt(), 0, 200, "<a class='read_more' href='${link}'>{$read_more}</a>" );

									?>
                                </p>
                            </div>
                            <div class="blogs__card--bottom">
                                <div class="blogs__card--cat">
									<?php
									$categories  = get_the_category( get_the_ID() );
									$categoriesS = array_slice( $categories, 0, 2 );
									foreach ( $categoriesS as $category ) {
										$category_link = get_category_link( $category->cat_ID );
										echo "<a href='${category_link}' title='{$category->name}'><p>{$category->name}</p></a>";
									}
									?>
                                </div>
                                <div class="blogs__card--date">
                                    <p class="rtime"><?php echo estimateReadingTime( get_the_content() ) ?></p>
                                    <p class="date"><?php echo get_the_time( "j M, Y" ) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
				}
			}
			wp_reset_query();
			?>


        </div>
		<?php

	}

}