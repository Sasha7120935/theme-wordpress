<?php
/**
 * Adds Contact_Widget widget.
 */
class Contact_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'contact_widget', // Base ID
            esc_html__( 'Contact Us', 'text_domain' ), // Name
            array( 'description' => esc_html__( 'Contact Us for Test Theme', 'text_domain' ), ) // Args
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
        if ( ! empty( $instance['title'] || ['tel'] || ['email'] || ['text'] ) ) {
            ?>
            <div class="contact-widget">
                <div>
                   <h3 style="font-size: 1em;"><?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];?></h3>
                </div>
                <div>
                   <p class="contact-widget-text"><?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['text'] ) . $args['after_title']; ?></p>
                </div>
                <div>
                   <p><?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['tel'] ) . $args['after_title']; ?></p>
                </div>
                <div>
                  <p><?php echo $args['before_title'] . apply_filters( 'widget_title', $instance['email'] ) . $args['after_title']; ?></p>
                </div>
            </div>
            <?php
        }
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( 'New text', 'text_domain' );
        $tel = ! empty( $instance['tel'] ) ? $instance['tel'] : esc_html__( 'New tel', 'text_domain' );
        $email = ! empty( $instance['email'] ) ? $instance['email'] : esc_html__( 'New email', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input class="contact-title" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tel' ) ); ?>"><?php esc_attr_e( 'tel:', 'text_domain' ); ?></label>
            <input class="contact-number" id="<?php echo esc_attr( $this->get_field_id( 'tel' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tel' ) ); ?>" type="tel" value="<?php echo esc_attr( $tel ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_attr_e( 'Email:', 'text_domain' ); ?></label>
            <input class="contact-email" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_attr_e( 'Text:', 'text_domain' ); ?></label>
            <input class="contact-text" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
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
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['tel'] = ( ! empty( $new_instance['tel'] ) ) ? sanitize_text_field( $new_instance['tel'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? sanitize_text_field( $new_instance['email'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? sanitize_text_field( $new_instance['text'] ) : '';

        return $instance;
    }

} // class Foo_Widget