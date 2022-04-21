<?php

/**
 * Registers the `movie` post type.
 */
function movie_init() {
	register_post_type(
		'movie',
		[
			'labels'                => [
				'name'                  => __( 'Movies', 'YOUR-TEXTDOMAIN' ),
				'singular_name'         => __( 'Movie', 'YOUR-TEXTDOMAIN' ),
				'all_items'             => __( 'All Movies', 'YOUR-TEXTDOMAIN' ),
				'archives'              => __( 'Movie Archives', 'YOUR-TEXTDOMAIN' ),
				'attributes'            => __( 'Movie Attributes', 'YOUR-TEXTDOMAIN' ),
				'insert_into_item'      => __( 'Insert into Movie', 'YOUR-TEXTDOMAIN' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Movie', 'YOUR-TEXTDOMAIN' ),
				'featured_image'        => _x( 'Featured Image', 'movie', 'YOUR-TEXTDOMAIN' ),
				'set_featured_image'    => _x( 'Set featured image', 'movie', 'YOUR-TEXTDOMAIN' ),
				'remove_featured_image' => _x( 'Remove featured image', 'movie', 'YOUR-TEXTDOMAIN' ),
				'use_featured_image'    => _x( 'Use as featured image', 'movie', 'YOUR-TEXTDOMAIN' ),
				'filter_items_list'     => __( 'Filter Movies list', 'YOUR-TEXTDOMAIN' ),
				'items_list_navigation' => __( 'Movies list navigation', 'YOUR-TEXTDOMAIN' ),
				'items_list'            => __( 'Movies list', 'YOUR-TEXTDOMAIN' ),
				'new_item'              => __( 'New Movie', 'YOUR-TEXTDOMAIN' ),
				'add_new'               => __( 'Add New', 'YOUR-TEXTDOMAIN' ),
				'add_new_item'          => __( 'Add New Movie', 'YOUR-TEXTDOMAIN' ),
				'edit_item'             => __( 'Edit Movie', 'YOUR-TEXTDOMAIN' ),
				'view_item'             => __( 'View Movie', 'YOUR-TEXTDOMAIN' ),
				'view_items'            => __( 'View Movies', 'YOUR-TEXTDOMAIN' ),
				'search_items'          => __( 'Search Movies', 'YOUR-TEXTDOMAIN' ),
				'not_found'             => __( 'No Movies found', 'YOUR-TEXTDOMAIN' ),
				'not_found_in_trash'    => __( 'No Movies found in trash', 'YOUR-TEXTDOMAIN' ),
				'parent_item_colon'     => __( 'Parent Movie:', 'YOUR-TEXTDOMAIN' ),
				'menu_name'             => __( 'Movies', 'YOUR-TEXTDOMAIN' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'movie',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'movie_init' );

/**
 * Sets the post updated messages for the `movie` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `movie` post type.
 */
function movie_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['movie'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Movie updated. <a target="_blank" href="%s">View Movie</a>', 'YOUR-TEXTDOMAIN' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'YOUR-TEXTDOMAIN' ),
		3  => __( 'Custom field deleted.', 'YOUR-TEXTDOMAIN' ),
		4  => __( 'Movie updated.', 'YOUR-TEXTDOMAIN' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Movie restored to revision from %s', 'YOUR-TEXTDOMAIN' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Movie published. <a href="%s">View Movie</a>', 'YOUR-TEXTDOMAIN' ), esc_url( $permalink ) ),
		7  => __( 'Movie saved.', 'YOUR-TEXTDOMAIN' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Movie submitted. <a target="_blank" href="%s">Preview Movie</a>', 'YOUR-TEXTDOMAIN' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Movie scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Movie</a>', 'YOUR-TEXTDOMAIN' ), date_i18n( __( 'M j, Y @ G:i', 'YOUR-TEXTDOMAIN' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Movie draft updated. <a target="_blank" href="%s">Preview Movie</a>', 'YOUR-TEXTDOMAIN' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'movie_updated_messages' );

/**
 * Sets the bulk post updated messages for the `movie` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `movie` post type.
 */
function movie_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['movie'] = [
		/* translators: %s: Number of Movies. */
		'updated'   => _n( '%s Movie updated.', '%s Movies updated.', $bulk_counts['updated'], 'YOUR-TEXTDOMAIN' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Movie not updated, somebody is editing it.', 'YOUR-TEXTDOMAIN' ) :
						/* translators: %s: Number of Movies. */
						_n( '%s Movie not updated, somebody is editing it.', '%s Movies not updated, somebody is editing them.', $bulk_counts['locked'], 'YOUR-TEXTDOMAIN' ),
		/* translators: %s: Number of Movies. */
		'deleted'   => _n( '%s Movie permanently deleted.', '%s Movies permanently deleted.', $bulk_counts['deleted'], 'YOUR-TEXTDOMAIN' ),
		/* translators: %s: Number of Movies. */
		'trashed'   => _n( '%s Movie moved to the Trash.', '%s Movies moved to the Trash.', $bulk_counts['trashed'], 'YOUR-TEXTDOMAIN' ),
		/* translators: %s: Number of Movies. */
		'untrashed' => _n( '%s Movie restored from the Trash.', '%s Movies restored from the Trash.', $bulk_counts['untrashed'], 'YOUR-TEXTDOMAIN' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'movie_bulk_updated_messages', 10, 2 );