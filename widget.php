<?php

class Coffee_widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'coffee_widget',
      __('Coffee Widget', 'tinycoffee'),
      array( 'description' => __( 'Ask for coffee in your sidebar', 'tiny_coffee' ) )
    );
  }
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    $instance['widget'] = true;
    foreach($instance as $key=>$val) {
      if(!$val)
        unset($instance[$key]);
    }
    echo Coffee::tag($instance);
    echo $args['after_widget'];
  }
  public function form( $instance ) {
	$instance = wp_parse_args(
		$instance,
		array( 'title' => '', 'text' => true )
	);
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tiny_coffee' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:','tiny_coffee' ); ?></label>
      <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_html( $instance['text'] ); ?></textarea>
    </p>
    <?php
  }
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
    return $instance;
  }
}
