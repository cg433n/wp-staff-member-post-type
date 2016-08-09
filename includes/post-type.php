<?php

function staff_members_create_post_type() {
  // set up labels
  $labels = array(
    'name' => 'Staff Members',
    'singular_name' => 'Staff',
    'add_new' => 'Add New Member',
    'add_new_item' => 'Add New Member',
    'edit_item' => 'Edit Staff Member',
    'new_item' => 'New Staff Member',
    'all_items' => 'All Members',
    'view_item' => 'View Staff Member',
    'search_items' => 'Search Staff Members',
    'not_found' =>  'No Staff Members Found',
    'not_found_in_trash' => 'No Staff Members found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Staff',
  );

  // register post type
  register_post_type( 'staff-member', array(
    'labels' => $labels,
    'has_archive' => true,
    'public' => true,
    'supports' => array( 'title', 'editor', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'post_tag', 'category' ),
    'exclude_from_search' => true,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'staff' ),
    'menu_icon' => 'dashicons-groups',
    )
  );
}

add_action( 'init', 'staff_members_create_post_type' );
