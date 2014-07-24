<?php

/**
 * Tiny Coffee Widget
 */
class Tiny_Coffee_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'coffee_widget',
			__( 'Coffee Widget', 'tinycoffee' ),
			array( 'description' => __( 'Ask for coffee in your sidebar', 'tinycoffee' ) )
		);
	}


	public function widget( $args, $instance ) {
		$instance['widget'] = true;
		?>
		<?php echo $args['before_widget']; ?>
			<?php
				$title = apply_filters( 'widget_title', $instance['title'] );
				if ( ! empty( $title ) ) :
			?>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
			<?php endif; ?>
			<?php echo Tiny_Coffee::tag( $instance ); ?>
		<?php echo $args['after_widget'];
	}


	public function form( $instance ) {
		$instance = $this->update( $instance );
		?>
		<p>
			<?php printf(
				'<label for="%s">%s</label>',
				esc_attr( $this->get_field_id( 'title' ) ),
				esc_html_e( 'Title:', 'tinycoffee' )
			) ?>
			<?php printf(
				'<input class="widefat" id="%s" name="%s" type="text" value="%s" />',
				esc_attr( $this->get_field_id( 'title' ) ),
				esc_attr( $this->get_field_name( 'title' ) ),
				esc_attr( $instance['title'] )
			) ?>
		</p>
		<p>
			<?php printf(
				'<label for="%s">%s</label>',
				esc_attr( $this->get_field_id( 'text' ) ),
				esc_html_e( 'Text:', 'tinycoffee' )
			) ?>
			<?php printf(
				'<textarea class="widefat" id="%s" name="%s">%s</textarea>',
				esc_attr( $this->get_field_id( 'text' ) ),
				esc_attr( $this->get_field_name( 'text' ) ),
				esc_html( $instance['text'] )
			) ?>
		</p>
		<?php
	}


	public function update( $new_instance, $old_instance = array() ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

		return $instance;
	}
}
