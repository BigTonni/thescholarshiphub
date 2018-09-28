<?php
/**
 * Widget API: WP_TSH_Widget_Recent_Posts class
 *
 * @package thescholarshiphub
 */

class WP_TSH_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'custom_widget_recent_entries',
			'description' => __( 'Your site&#8217;s most recent Posts.' ),
//			'customize_selective_refresh' => true,
		);
		parent::__construct( 'custom_recent-posts', __( 'Custom Recent Posts' ), $widget_ops );
//		$this->alt_option_name = 'custom_widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_content = isset( $instance['show_content'] ) ? $instance['show_content'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args     An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
                        'meta_query' => array(
                            array(
                                    'key'     => '_tsh_featured',
                                    'value'   => 'yes',
                                    'compare' => '!=',
                            )
                        )
		), $instance ) );

		if ( ! $r->have_posts() ) {
			return;
		}
		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul id="custom_recent_post_list">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title = get_the_title( $recent_post->ID );
				$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
				?>
				<li class="row">
                                    <span class="col-md-4">
                                        <?php echo get_the_post_thumbnail( $recent_post->ID, 'thumbnail'); ?>					
                                    </span>
                                    <span class="col-md-8">
                                        <a href="<?php the_permalink( $recent_post->ID ); ?>" class="post-title"><?php echo $title ; ?></a><br />
					<?php if ( $show_date ) : ?>
						<span class="post-date"><?php echo get_the_date( 'd M Y', $recent_post->ID ); ?></span>
					<?php endif; ?>
                                        <?php if ( $show_content ) : ?>
						<p class="post-excerpt"><?php echo $recent_post->post_excerpt ? $recent_post->post_excerpt : ''; ?></p>
					<?php endif; ?>
                                                
                                    </span>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_content'] = isset( $new_instance['show_content'] ) ? (bool) $new_instance['show_content'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_content = isset( $instance['show_content'] ) ? (bool) $instance['show_content'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
                
                <p><input class="checkbox" type="checkbox"<?php checked( $show_content ); ?> id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Display post content?' ); ?></label></p>
<?php
	}
}
