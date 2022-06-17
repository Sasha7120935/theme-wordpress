<?php
/**
 * Adds Categories_Widget widget.
 */
class Categories_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'categories_widget', // Base ID
            esc_html__( 'Categories', 'text_domain' ), // Name
            array( 'description' => esc_html__( 'Categories for Test Theme', 'text_domain' ), ) // Args
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
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        $args = [
            'post_type' => 'post',
            'orderby' => 'slug',
            'hide_empty'   => 1,
        ];
        $categories = get_categories( $args );
        $events_query = new WP_Query( $args );
        ?>
        <div class="posts-widget">
            <?php
            if ( $events_query->have_posts() ) :
                while ( $events_query->have_posts() ) : $events_query->the_post();

                    foreach( $categories as $category ){
                    echo  '<a style="color: #696969;" href="' . get_category_link( $category->term_id ) . '">' . $category->name . '<span>' . ' - ' . $category->category_count . '</span><br></a><br>';
                    }
                    break;
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
        $instance = wp_parse_args((array)$instance);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',''); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo $instance['title']; ?>"/>
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

        return $instance;
    }

}