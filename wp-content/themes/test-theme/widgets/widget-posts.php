<?php
/**
 * Adds Posts_Widget widget.
 */
class Posts_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'posts_widget',
            esc_html__( 'Posts', 'text_domain' ),
            array( 'description' => esc_html__( 'Posts for Test Theme', 'text_domain' ), )
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
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
            $args = [
                'post_type' => 'portfolio',
                'posts_per_page' => $instance['number']
            ];
            $events_query = new WP_Query($args);
        }
        ?>
        <div class="posts-widget">
            <?php
        if ( $events_query->have_posts() ) :
            while ( $events_query->have_posts() ) : $events_query->the_post();
        ?>
                <div class="post-image"><?php
                    if ( has_post_thumbnail() ) {
                       the_post_thumbnail( 'homepage-thumb' );
                    } ?>
                </div>
            <div>
                <h3 class="post-custom-widget" style="color: white;width: 220px;"><a href="<?php the_permalink();?>"><?php echo get_the_content() ?></a></h3>
            </div>
            <div>
                <p class="post-date-custom"><?php echo get_the_date() ?></p>
            </div>
            <?php
            endwhile;
        else:
            return '<p><strong>' . _e('not found','text_domain') . '</strong></p>';
        endif;
        ?>
        </div>
        <?php
        wp_reset_query();
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $number = @ $instance['number'] ? : '';
        $instance = wp_parse_args((array)$instance);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',''); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo $instance['title']; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number') ?>">
                <?php _e( 'Quantity:', 'text_domain' ); ?>
            </label>
            <input class="ats-text"
                   id="<?php echo $this->get_field_id('number') ?>"
                   name="<?php echo $this->get_field_name('number') ?>"
                   type="number"
                   step="1"
                   min="1"
                   value="<?php echo absint($number) ?>"
                   size="3"
            />
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
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        return $instance;
    }

} // class Foo_Widget
