<?php
/**
 * Widget API: WP_TSH_Widget_Find_Scholarship class
 *
 * @package thescholarshiphub
 */

class WP_TSH_Widget_Find_Scholarship extends WP_Widget {

	/**
	 * Sets up a new Find Scholarship widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_find_scholarship',
			'description' => __( 'Find Scholarship.', THEME_DOMAIN ),
		);
		parent::__construct( 'custom_find_scholarship', __( 'Find Scholarship', THEME_DOMAIN ), $widget_ops );
	}

	/**
	 * Outputs the content for the Find Scholarship widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Find Scholarship widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Find Scholarship', THEME_DOMAIN );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$title_btn = ( ! empty( $instance['title_btn'] ) ) ? $instance['title_btn'] : __( 'Search Now!', THEME_DOMAIN );		
		echo $args['before_widget'];
		
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <select id="scholarship_list">
                                    <?php
                                    $args1 = array(
                                            'taxonomy' => 'tsh_tax_subject',
                                            'hide_empty' => false,
                                    );
                                    $terms = get_terms( $args1 );
                                    $html = '<option value="">--'. __('Study Location', THEME_DOMAIN) .'--</option>';
    
                                    if( !empty($terms) ){
                                        if (!is_user_logged_in()) {
                                            foreach ($terms as $term) {
                                                $html .= '<option value="register">'. $term->name .'</option>';
                                            }
                                        }else{
                                            foreach ($terms as $term) {
                                                $html .= '<option value="'. $term->slug .'">'. $term->name .'</option>';
                                            }
                                        }
                                    }                                    
                                    echo $html; ?>
                                </select>
                            </div>
                            <?php 
                            if ( $title_btn ) { ?>
                                <div class="col-md-12" id="scholarship_form_btn">
                                    <input type="hidden" name="redirect_path" value="<?php echo home_url('find-a-scholarship'); ?>"/>
                                    <input type="button" name="submit" value="<?php echo $title_btn; ?>"/>
                                </div>
                            <?php } ?>
                        </div>
                        
                        
                    </form>		
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Find Scholarship widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['title_btn'] = sanitize_text_field( $new_instance['title_btn'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Find Scholarship widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$title_btn = isset( $instance['title_btn'] ) ? esc_attr( $instance['title_btn'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'title_btn' ); ?>"><?php _e( 'Button title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title_btn' ); ?>" name="<?php echo $this->get_field_name( 'title_btn' ); ?>" type="text" value="<?php echo $title_btn; ?>" /></p>
<?php
	}
}
