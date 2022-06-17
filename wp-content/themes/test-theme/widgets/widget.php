<?php
// register Foo_Widget widget
function register_foo_widget() {
    register_widget( 'About_Widget' );
    register_widget( 'Posts_Widget' );
    register_widget( 'Categories_Widget' );
    register_widget( 'Contact_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );