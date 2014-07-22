<?php

class RaiseTheMoneyWidget extends WP_Widget {

  function RaiseTheMoneyWidget() {
    // Instantiate the parent object
    parent::__construct( false, 'Raise The Money', array('description' => __( 'Embed your contribution form.', 'raisethemoney_widget' )));
  }

  // Widget output
  function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $shortcode = $instance['shortcode'];

    echo $before_widget;
    // Display the widget
    echo '<div class="widget-text wp_widget_plugin_box">';

    // Check if title is set
    if ( $title ) {
      echo $before_title . $title . $after_title;
    }

    // Check if text is set
    if( $shortcode ) {
      echo do_shortcode( $shortcode );
    }
  }

  // update widget
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    // Fields
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['shortcode'] = strip_tags($new_instance['shortcode']);
    return $instance;
  }

  // widget form creation
  function form($instance) {

    $title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
    $shortcode = isset( $instance['shortcode'] ) ? esc_attr($instance['shortcode']) : '';
    ?>

    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'raisethemoney_widget'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode', 'raisethemoney_widget'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" type="text" value="<?php echo $shortcode; ?>" />
    </p>

    <?php
  }
}
function myplugin_register_widgets() {
  register_widget( 'RaiseTheMoneyWidget' );
}
add_action( 'widgets_init', 'myplugin_register_widgets' );
