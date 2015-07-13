<?php
if ( ! defined( 'ABSPATH' ) ) exit;



function btcRG_createPostTypes(){

    /* Set up the arguments for the post type. */
    $ncoaBootstrapCarouselArgs = array(

        /*
         * Whether the post type should be used publicly via the admin or by front-end users.  This
         * argument is sort of a catchall for many of the following arguments.  I would focus more
         * on adjusting them to your liking than this argument.
         */
        'public'              => false, // bool (default is FALSE)

        /*
         * Whether queries can be performed on the front end as part of parse_request().
         */
        'publicly_queryable'  => false, // bool (defaults to 'public').

        /*
         * Whether to exclude posts with this post type from front end search results.
         */
        'exclude_from_search' => true, // bool (defaults to FALSE - the default of 'internal')

        /*
         * Whether individual post type items are available for selection in navigation menus.
         */
        'show_in_nav_menus'   => false, // bool (defaults to 'public')

        /*
         * Whether to generate a default UI for managing this post type in the admin. You'll have
         * more control over what's shown in the admin with the other arguments.  To build your
         * own UI, set this to FALSE.
         */
        'show_ui'             => true, // bool (defaults to 'public')

        /*
         * Whether to show post type in the admin menu. 'show_ui' must be true for this to work.
         */
        'show_in_menu'        => true, // bool (defaults to 'show_ui')

        /*
         * Whether to make this post type available in the WordPress admin bar. The admin bar adds
         * a link to add a new post type item.
         */
        'show_in_admin_bar'   => true, // bool (defaults to 'show_in_menu')

        /*
         * The URI to the icon to use for the admin menu item. There is no header icon argument, so
         * you'll need to use CSS to add one.
         */
        'menu_icon'           => null, // string (defaults to use the post icon)

        /*
         * Whether the posts of this post type can be exported via the WordPress import/export plugin
         * or a similar plugin.
         */
        'can_export'          => true, // bool (defaults to TRUE)

        /*
         * Whether to delete posts of this type when deleting a user who has written posts.
         */
        'delete_with_user'    => false, // bool (defaults to TRUE if the post type supports 'author')

        /*
         * Whether this post type should allow hierarchical (parent/child/grandchild/etc.) posts.
         */
        'hierarchical'        => false, // bool (defaults to FALSE)

        /*
         * Whether the post type has an index/archive/root page like the "page for posts" for regular
         * posts. If set to TRUE, the post type name will be used for the archive slug.  You can also
         * set this to a string to control the exact name of the archive slug.
         */
        'has_archive'         => false, // bool|string (defaults to FALSE)

        /*
         * Sets the query_var key for this post type. If set to TRUE, the post type name will be used.
         * You can also set this to a custom string to control the exact key.
         */
        'query_var'           => 'true', // bool|string (defaults to TRUE - post type name)

        /*
         * A string used to build the edit, delete, and read capabilities for posts of this type. You
         * can use a string or an array (for singular and plural forms).  The array is useful if the
         * plural form can't be made by simply adding an 's' to the end of the word.  For Bootstrap Carousel,
         * array( 'box', 'boxes' ).
         */
        'capability_type'     => 'post', // string|array (defaults to 'post')

        /*
         * How the URL structure should be handled with this post type.  You can set this to an
         * array of specific arguments or true|false.  If set to FALSE, it will prevent rewrite
         * rules from being created.
         */
        'rewrite' => false,

        /*
         * What WordPress features the post type supports.  Many arguments are strictly useful on
         * the edit post screen in the admin.  However, this will help other themes and plugins
         * decide what to do in certain situations.  You can pass an array of specific features or
         * set it to FALSE to prevent any features from being added.  You can use
         * add_post_type_support() to add features or remove_post_type_support() to remove features
         * later.  The default features are 'title' and 'editor'.
         */
        'supports' => array(
            /* Post titles ($post->post_title). */
            'title',
            'thumbnail',
            /* Displays the Revisions meta box. If set, stores post revisions in the database. */
            'revisions'
        ),


        'menu_position'=>20,

        /*
         * Labels used when displaying the posts in the admin and sometimes on the front end.  These
         * labels do not cover post updated, error, and related messages.  You'll need to filter the
         * 'post_updated_messages' hook to customize those.
         */
        'labels' => array(
            'name'               => __( 'Bootstrap Carousels',                   'btcrg' ),
            'singular_name'      => __( 'Bootstrap Carousel',                    'btcrg' ),
            'menu_name'          => __( 'Bootstrap Carousels',                   'btcrg' ),
            'name_admin_bar'     => __( 'Bootstrap Carousels',                   'btcrg' ),
            'add_new'            => __( 'Add New',                               'btcrg' ),
            'add_new_item'       => __( 'Add New Bootstrap Carousel',            'btcrg' ),
            'edit_item'          => __( 'Edit Bootstrap Carousel',               'btcrg' ),
            'new_item'           => __( 'New Bootstrap Carousel',                'btcrg' ),
            'view_item'          => __( 'View Bootstrap Carousel',               'btcrg' ),
            'search_items'       => __( 'Search Bootstrap Carousels',            'btcrg' ),
            'not_found'          => __( 'No Bootstrap Carousels found',          'btcrg' ),
            'not_found_in_trash' => __( 'No Bootstrap Carousels found in trash', 'btcrg' ),
            'all_items'          => __( 'All Bootstrap Carousels',               'btcrg' ),

            /* Labels for hierarchical post types only. */
            'parent_item'        => __( 'Parent Bootstrap Carousel',             'btcrg' ),
            'parent_item_colon'  => __( 'Parent Bootstrap Carousel:',            'btcrg' ),

            /* Custom archive label.  Must filter 'post_type_archive_title' to use. */
            'archive_title'      => __( 'Bootstrap Carousels',                   'btcrg' ),
        )
    );


    /* Register the post type. */
    register_post_type('btcrg', $ncoaBootstrapCarouselArgs );
}


if( function_exists('register_field_group') ):

    register_field_group(array (
        'key' => 'group_55512ae0968ee',
        'title' => 'Bootstrap Carousel RG',
        'fields' => array (
            array (
                'key' => 'field_555136287d288',
                'label' => 'Shortname',
                'name' => 'rg_carousel_shortname',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => 95,
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_555134f4caaf6',
                'label' => 'Auto-Play',
                'name' => 'rg_carousel_autoplay',
                'prefix' => '',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_55512af90415e',
                'label' => 'Slides',
                'name' => 'rg_carousel_items',
                'prefix' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array (
                    array (
                        'key' => 'field_55512b1e0415f',
                        'label' => 'Image',
                        'name' => 'rg_carousel_item_image',
                        'prefix' => '',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'herobar',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array (
                        'key' => 'field_55512b6104160',
                        'label' => 'Text Content',
                        'name' => 'rg_carousel_item_text_content',
                        'prefix' => '',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'basic',
                        'media_upload' => 1,
                    ),
                    array (
                        'key' => 'field_55512b9004161',
                        'label' => 'CTA Label',
                        'name' => 'rg_carousel_item_cta_label',
                        'prefix' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Learn More',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_55512bba04162',
                        'label' => 'CTA Link',
                        'name' => 'rg_carousel_item_cta_link',
                        'prefix' => '',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
            array (
                'key' => 'field_5553a4243f5fc',
                'label' => 'Button Style',
                'name' => 'rg_carousel_button_style',
                'prefix' => '',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'btn-default' => 'Default',
                    'btn-success' => 'Success',
                    'btn-info' => 'Info',
                    'btn-warning' => 'Warning',
                    'btn-danger' => 'Danger',
                    'btn-link' => 'Link',
                    'none' => 'Custom: Use btn-<i>shortname</i>',
                ),
                'default_value' => array (
                    'btn-default' => 'btn-default',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_5553a97d10a8e',
                'label' => 'Wrapper Class',
                'name' => 'rg_carousel_wrapper_class',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '(optional) Custom class name added to the DIV that wraps the carousel.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_555b7b0efcbc6',
                'label' => 'Left Arrow Icon',
                'name' => 'rg_carousel_left_arrow',
                'prefix' => '',
                'type' => 'text',
                'instructions' => 'Available glyphs: http://getbootstrap.com/components/#glyphicons',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'glyphicon-chevron-left',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_555b7bcdfcbc7',
                'label' => 'Right Arrow Icon',
                'name' => 'rg_carousel_right_arrow',
                'prefix' => '',
                'type' => 'text',
                'instructions' => 'Available glyphs: http://getbootstrap.com/components/#glyphicons',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'glyphicon-chevron-right',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_555b992625dfc',
                'label' => 'Gradient Overlay',
                'name' => 'rg_carousel_gradient_overlay',
                'prefix' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array (
                    array (
                        'key' => 'field_555b99f325dff',
                        'label' => 'Position',
                        'name' => 'rg_carousel_gradient_position_offset',
                        'prefix' => '',
                        'type' => 'number',
                        'instructions' => 'Where should this color appear',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_555b997f25dfd',
                        'label' => 'Color',
                        'name' => 'rg_carousel_gradient_position_color',
                        'prefix' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                    ),
                    array (
                        'key' => 'field_555b999d25dfe',
                        'label' => 'Alpha Percentage',
                        'name' => 'rg_carousel_gradient_position_alpha',
                        'prefix' => '',
                        'type' => 'number',
                        'instructions' => 'Enter a number between 0 and 100 for transparency.	0 = Transparent and 100 = Opaque',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 100,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => 0,
                        'max' => 100,
                        'step' => '0.5',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'btcrg',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array (
            0 => 'permalink',
            1 => 'the_content',
            2 => 'excerpt',
            3 => 'custom_fields',
            4 => 'discussion',
            5 => 'comments',
            6 => 'author',
            7 => 'format',
            8 => 'page_attributes',
            9 => 'categories',
            10 => 'tags',
            11 => 'send-trackbacks',
        ),
    ));

endif;



function save_btcrg_meta( $post_id ) {
    if(get_post_type($post_id)=="btcrg") {

        $thisShortcode = get_field("rg_carousel_shortname", $post_id);

        if ($thisShortcode == "") {
            $thisTitle = get_the_title($post_id);
            $thisTitle = strtolower($thisTitle);
            $thisTitle = preg_replace('/([^a-z]*)/', '', $thisTitle);

            // Check to make sure that the shortcode value is unique
            $detector = true;
            $safety = 0;
            $thisTitle2 = $thisTitle;

            while ($detector == true && $safety < 100) {
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'post_type' => 'btcrg',
                    'meta_query' => array(
                        array(
                            'key' => 'rg_carousel_shortname',
                            'value' => $thisTitle2,
                        ),
                    ),
                ));

                if ($posts) {
                    $thisTitle2 = $thisTitle . ($safety + 2);
                } else {
                    $thisTitle = $thisTitle2;
                }
                $safety++;
            }

            update_field('rg_carousel_shortname', $thisTitle, $post_id);
        }
    }

}
add_action( 'save_post', 'save_btcrg_meta', 90, 1 );

