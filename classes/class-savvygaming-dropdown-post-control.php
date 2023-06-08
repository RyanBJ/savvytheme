<?php

if (class_exists('WP_Customize_Control')) {
    class Dropdown_Post_Control extends WP_Customize_Control {

        public $type = 'dropdown-posts';

        public function render_content() {

            $post_query = new WP_Query( array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => -1
            ));

            if ( ! empty( $this->label ) ) :
                ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
            endif;

            if ( ! empty( $this->description ) ) :
                ?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
            endif;
            ?>

            <select <?php $this->link(); ?>>
                <option value="0">-- Select --</option>

            <?php while($post_query->have_posts()) {
                $post_query->the_post();
                echo "<option " . selected($this->value(), get_the_ID()) . " value='" . get_the_ID() . "'>"
                    . the_title('', '', false) . "</option>";
            } wp_reset_postdata();
            ?>

            </select>

            <?php
        }
    }
}