<?php

// Creating the widget 
class add_menu extends WP_Widget {
	
	function __construct() {
		$this->settings = &$settings;
		$this->ref = \semantic_ui\vars::$ref;
		$this->data_class = \semantic_ui\vars::$data_class;
		parent::__construct(
		// Base ID of your widget
		'semantic_ui-widget-add_meu', 
		
		// Widget name will appear in UI
		__('Semantic UI Menu', 'semantic_ui'), 
		
		// Widget description
		array(
			'description' => __( 'Allows you to use SUI menus as widgets', 'semantic_ui' ), )
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$menu_id = $instance['menu_id'];

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		
		echo $args['after_widget'];
	}
	
	// Widget Backend 
	public function form( $instance ) {
		if (isset($instance['title'])) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '';
		}
		if (isset($instance['menu_id'])) {
			$menu_id = $instance[ 'menu_id' ];
		}
		else {
			$menu_id = '1';
		}
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'menu_id' ); ?>"><?php _e( 'The menu id (A Number 1 - 10)' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'menu_id' ); ?>" name="<?php echo $this->get_field_name( 'menu_id' ); ?>" type="text" value="<?php echo esc_attr( $menu_id ); ?>" />
</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags( $new_instance['title'] ) : '';
		$instance['menu_id'] =
			(!empty($new_instance['menu_id'])) ?
				(string) ((int) $new_instance['menu_id'])
			:
				'';

		return $instance;
	}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'add_menu' );
}
add_action( 'widgets_init', 'wpb_load_widget' );