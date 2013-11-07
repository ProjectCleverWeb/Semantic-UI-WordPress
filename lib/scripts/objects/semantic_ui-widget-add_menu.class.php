<?php
namespace semantic_ui\widget;

/**
 * Allows users to easily add Semantic UI menus as
 * widgets within the theme.
 */
class add_menu extends \semantic_ui\widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->settings = &$settings;
		$this->ref = \semantic_ui\vars::$ref;
		$this->data_class = \semantic_ui\vars::$data_class;
		parent::__construct(
			'semantic_ui-add_menu', // Base ID
			__('Semantic UI Menu'), // Name
			array( 'description' => __( 'Add a menu as a widget'), ) // Args
		);
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$menu_id = $instance['menu_id'];

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
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

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags( $new_instance['title'] ) : '';
		$instance['title'] = (!empty($new_instance['title'])) ? (string) ((int) $new_instance['title']) : '';

		return $instance;
	}

} // class Foo_Widget