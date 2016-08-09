<?php

if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class Featured_Members extends WP_Widget {
  /**
   * @since    1.0.0
   * @var      string
   */
  protected $widget_slug = 'featured-members';

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		parent::__construct(
			$this->get_widget_slug(), 'Featured Members',
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => 'A list of featured staff members.'
			)
		);

	} // end constructor

  /**
   * Return the widget slug.
   *
   * @since    1.0.0
   *
   * @return    Plugin slug variable.
   */
  public function get_widget_slug() {
      return $this->widget_slug;
  }

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		// Check if there is a cached output
		$cache = wp_cache_get( $this->get_widget_slug(), 'widget' );
		if ( !is_array( $cache ) )
			$cache = array();
		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;
		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];

		// go on with your widget logic, put everything into a string and …
		extract( $args, EXTR_SKIP );
		$widget_string = $before_widget;
		ob_start();

    $args = array(
      'numberposts'	=> -1,
      'post_type'		=> 'staff-member',
      'meta_key'		=> 'staff_member_feature',
      'meta_value'	=> true
    );

    $the_query = new WP_Query( $args );
    ?>
    <h2 class="widget-title">Featured Lawyer</h2>
    <?php if( $the_query->have_posts() ): ?>
      <ul>
      <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li>
          <div class="widget-staff-member-avatar">
            <?php
            if (has_post_thumbnail())
            the_post_thumbnail( 'thumbnail' );
            ?>
          </div>

          <div class="widget-staff-member-name">
            <?php the_title(); ?>
          </div>

          <div class="widget-staff-member-short-bio">
            <?php the_field( 'staff_member_short_bio' ); ?>
          </div>
        </li>
      <?php endwhile; ?>
      </ul>
    <?php endif; ?>

    <?php wp_reset_query();

		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;
		$cache[ $args['widget_id'] ] = $widget_string;
		wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );
		print $widget_string;
	} // end widget


	public function flush_widget_cache()
	{
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// TODO: Here is where you update your widget's old values with the new, incoming values
		return $instance;
	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
		// TODO: Define default values for your variables
		$instance = wp_parse_args(
			(array) $instance
		);
		// TODO: Store the values of the widget in their own variable
		// Display the admin form
		// include( plugin_dir_path(__FILE__) . 'views/admin.php' );
	} // end form


} // end class

add_action( 'widgets_init', create_function( '', 'register_widget("Featured_Members");' ) );
