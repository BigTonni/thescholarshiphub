<?php
/**
 * Widget API: WP_TSH_Widget_List_Post_Types class
 *
 * @package thescholarshiphub
 */

class WP_TSH_Widget_List_Post_Types extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'tsh_list_post_types',
			'description' => __( 'Custom List Post Types.', THEME_DOMAIN ),
		);
		parent::__construct( 'tsh_list_post_types', __( 'TSH List', THEME_DOMAIN ), $widget_ops );
	}

	/**
	 * Outputs the content for the widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );		
		echo $args['before_widget'];
		
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
                if(isset( $instance['tsh_post_type_ids'] ) && !empty($instance['tsh_post_type_ids'])){
                    $arr_ids = $instance['tsh_post_type_ids'];
                    $html = '<ul>';
                    foreach ($arr_ids as $key => $id) {
                        $post = get_post($id);
                        $html .= '<li class="tsh_post_type_item"><a href="'. $post->guid .'">'. $post->post_title .'</a></li>';
                    }
                    $html .= '</ul>';
                    echo $html;
                }
                
		
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['tsh_post_type_ids'] = $new_instance['tsh_post_type_ids'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';                
		$arr_ids     = isset( $instance['tsh_post_type_ids'] ) ? ( $instance['tsh_post_type_ids'] ) : array();
              
                $arr = get_posts( array(
                        'numberposts' => -1,
                	'orderby'     => 'ID',
                	'order'       => 'ASC',
                        'post_type'   => array('post','page')
                ) );
                ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'tsh_post_type_ids' ); ?>"><?php _e( 'Choose resources:' ); ?></label></p>
                <?php
                if( !empty($arr) ){ ?>
                    <p><select class="widefat" id="<?php echo $this->get_field_id( 'tsh_post_type_ids' ); ?>" name="<?php echo $this->get_field_name( 'tsh_post_type_ids' ); ?>[]" multiple size="10">
                        <?php
                        foreach( $arr as $obj ){
                                setup_postdata($obj); ?>
                                <option value="<?php echo $obj->ID; ?>" <?php echo in_array($obj->ID, $arr_ids) ? 'selected="selected"' : ''; ?>><?php echo $obj->post_title; ?></option>
                            <?php
                        } ?>
                    </select></p>
                    <?php
                    wp_reset_postdata();
                }                
	}
}
