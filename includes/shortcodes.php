<?php

function staff_members_shortcode() {

  ?>
  <ul class="staff-member-headers">
  	<li class="staff-member-header-name">Name</li>
  	<li class="staff-member-header-title">Title</li>
  	<li class="staff-member-header-contact">Contact</li>
	</ul>
  <?php

  $args = array(
    'posts_per_page' => -1,
    'numberposts'	=> -1,
    'post_type'		=> 'staff-member'
  );

  $the_query = new WP_Query( $args );
  ?>
  <?php if( $the_query->have_posts() ): ?>
    <ul class="staff-member-list">
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <li class="staff-member">
        <div class="staff-member-row">
          <div class="staff-member-title">
            <div class="staff-member-avatar">
              <?php
              if (has_post_thumbnail())
              the_post_thumbnail( 'thumbnail' );
              ?>
            </div>

            <div class="staff-member-name">
              <h3><?php the_title(); ?></h3>
              <a href="javascript:void(0);" class="staff-member-bio-link">Bio <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            </div>
          </div>

          <div class="staff-member-role">
            <?php the_field( 'staff_member_title' ); ?>
          </div>

          <div class="staff-member-contact">
            <div class="staff-member-email">
              <a href="mailto:<?php the_field( 'staff_member_email' ); ?>">
              <?php the_field( 'staff_member_email' ); ?>
            </a>
            </div>

            <div class="staff-member-phone">
              <?php the_field( 'staff_member_phone'); ?>
            </div>

            <div class="staff-member-location">
              <?php the_field( 'staff_member_location' ); ?>
            </div>
          </div>
        </div>

        <div class="staff-member-bio-content">
          <?php the_content(); ?>
        </div>
      </li>
    <?php endwhile; ?>
    </ul>
  <?php endif; ?>

  <?php wp_reset_query();
}

function staff_members_register_shortcodes() {
  add_shortcode( 'staff-members', 'staff_members_shortcode' );
}

add_action( 'init', 'staff_members_register_shortcodes' );
