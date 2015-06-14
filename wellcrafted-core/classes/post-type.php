<?php

/**
 * @todo  PHPDoc
 */
class Wellcrafted_Post_Type {

    /**
     * Post type. (max. 20 characters, cannot contain capital letters or spaces) 
     * @var null
     */
    protected $post_type = null;

    /**
     * General name for the post type, usually plural. The same as, and overridden by $post_type_object->label 
     * @var string
     */
    protected $name_label = '';

    /**
     * Name for one object of this post type. Defaults to value of 'name'. 
     * @var string
     */
    protected $singular_name_label = '';

    /**
     * The menu name text. This string is the name to give menu items. Defaults to a value of 'name'. 
     * 
     * @var string
     */
    protected $menu_name_label = '';

    /**
     * Name given for the "Add New" dropdown on admin bar. Defaults to 'singular_name' if it exists, 'name' otherwise. 
     * @var string
     */
    protected $name_admin_bar_label = '';

    /**
     * The all items text used in the menu. Default is the value of 'name'.
     * @var string
     */
    protected $all_items_label = '';

    /**
     * The add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. 
     * When internationalizing this string, please use a gettext context matching your post type. 
     * 
     * Example: _x('Add New', 'product');
     * @var string
     */
    protected $add_new_label = '';

    /**
     * The add new item text. Default is Add New Post/Add New Page 
     * @var string
     */
    protected $add_new_item_label = '';

    /**
     * The new item text. Default is "New Post" for non-hierarchical and "New Page" for hierarchical post types. 
     * @var string
     */
    protected $new_item_label = '';

    /**
     * The edit item text. In the UI, this label is used as the main header on the post's editing panel. 
     * The default is "Edit Post" for non-hierarchical and "Edit Page" for hierarchical post types. 
     * @var string
     */
    protected $edit_item_label = '';

    /**
     * The view item text. Default is View Post/View Page 
     * @var string
     */
    protected $view_item_label = '';

    /**
     * The search items text. Default is Search Posts/Search Pages
     * @var string
     */
    protected $search_items_label = '';

    /**
     * The parent text. This string is used only in hierarchical post types. Default is "Parent Page". 
     * @var string
     */
    protected $parent_item_colon_label = '';

    /**
     * The not found text. Default is No posts found/No pages found 
     * @var string
     */
    protected $not_found_label = '';

    /**
     * The not found in trash text. Default is No posts found in Trash/No pages found in Trash. 
     * @var string
     */
    protected $not_found_in_trash_label = '';

    /**
     * Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers (exclude_from_search, publicly_queryable).
     * @see https://codex.wordpress.org/Function_Reference/register_post_type
     * @var boolean
     */
    protected $public = false;

    /**
     * Whether to exclude posts with this post type from front end search results. 
     * @var null
     */
    protected $exclude_from_search = null;

    /**
     * Whether queries can be performed on the front end as part of parse_request(). 
     * @var boolean
     */
    protected $publicly_queryable = null;

    /**
     * Whether to generate a default UI for managing this post type in the admin. 
     * @var boolean
     */
    protected $show_ui = null;

    /**
     * Whether post_type is available for selection in navigation menus.
     * @var null
     */
    protected $show_in_nav_menus = null;

    /**
     * Where to show the post type in the admin menu. show_ui must be true. 
     * @var boolean
     */
    protected $show_in_menu = null;

    /**
     * Whether to make this post type available in the WordPress admin bar. 
     * @var boolean
     */
    protected $show_in_admin_bar = null;

    /**
     * Sets the query_var key for this post type. 
     * @var boolean
     */
    protected $query_var = true;

    /**
     * The string to use to build the read, edit, and delete capabilities. May be passed as an array to allow for alternative plurals when using this argument as a base to construct the capabilities, e.g. array('story', 'stories') the first array element will be used for the singular capabilities and the second array element for the plural capabilities, this is instead of the auto generated version if no array is given which would be "storys". The 'capability_type' parameter is used as a base to construct capabilities unless they are explicitly set with the 'capabilities' parameter. It seems that `map_meta_cap` needs to be set to true, to make this work. 
     * @var string
     */
    protected $capability_type = 'post';

    /**
     * An array of the capabilities for this post type. 
     * @var string
     */
    protected $capabilities = [];

    /**
     * Whether to use the internal default meta capability handling.
     * @var null
     */
    protected $map_meta_cap = null;

    /**
     * Enables post type archives. Will use $post_type as archive slug by default. 
     * @var boolean
     */
    protected $has_archive = false;

    /**
     * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page. 
     * @var boolean
     */
    protected $hierarchical = false;

    /**
     * Provide a callback function that will be called when setting up the meta boxes for the edit form. The callback function takes one argument $post, which contains the WP_Post object for the currently edited post. Do remove_meta_box() and add_meta_box() calls in the callback. 
     * @var null
     */
    protected $register_meta_box_cb = null;

    /**
     * An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy(). 
     * @var array
     */
    protected $taxonomies = array();
    
    /**
     * The url to the icon to be used for this menu or the name of the icon from the iconfont
     * @see http://melchoyce.github.io/dashicons/
     * @var null
     */
    protected $menu_icon = null;

    /**
     * The position in the menu order the post type should appear. show_in_menu must be true. 
     * @var null
     */
    protected $menu_position = null;

    /**
     * An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior. 
     * @var array
     */
    protected $supports = array( 'title', 'editor' );
    
    /**
     * Adds extra supports to defaults
     * @var array
     */
    protected $extra_supports = array();

    /**
     * Triggers the handling of rewrites for this post type. To prevent rewrites, set to false. 
     * @var array
     */
    protected $rewrite = true;

    /**
     * Can this post_type be exported. 
     * @var array
     */
    protected $can_export = true;

    /**
     * Params to create a post type
     * @var array
     */
    protected $post_type_params = array();

    /**
     * Whether to use meta boxes with this post type
     * @var boolean
     */
    protected $use_meta_boxes = false;

    /**
     * A key for a post type meta boxes nonce
     * @var string
     */
    protected $meta_boxes_nonce_action = '';

    /**
     * The following post types are reserved and used by WordPress already.
     * In general, you should always prefix your post types, or specify a custom `query_var`, to avoid conflicting with existing WordPress query variables.
     * Also, if the post type contains dashes you will not be able to add columns to the custom post type's admin page (using the 'manage_<Custom Post Type Name>_posts_columns' action). 
     * @var [type]
     */
    protected static $reserved_post_types = [
        'post',
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'action',
        'author',
        'order',
        'theme'
    ];


    public function __construct() {
        /**
         * @todo Should post type be shorten to 32 chars?
         */
        $this->post_type = str_replace( ' ', '', strtolower( $this->post_type ) );

        if ( null == $this->post_type || 
            in_array( $this->post_type, self::$reserved_post_types ) ) {
            return;
        }

        $this->set_params();
        $this->normalize_params();
        $this->create_params();
        $this->add_theme_support();

        if ( empty( $this->post_type_params ) ) {
            return;
        }

        add_action( 'wellcrafted_core_register_post_types', array( &$this, 'register_post_type' ) );
        add_action( 'manage_' . $this->post_type . '_posts_columns' , array( &$this, 'modify_columns') );
        add_filter( 'manage_' . $this->post_type . '_posts_custom_column', array( &$this, 'edit_column'), 10, 2 );

        if ( $this->use_meta_boxes ) {
            add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( &$this, 'pre_save_meta_boxes_data' ) );
        }

        $this->init();
        $this->_localize_script();
    }

    private function _localize_script() {
        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', function() {
                global $post_type;
                Wellcrafted_Assets::localize_admin_script(
                    WELLCRAFTED . '_base_admin_script', 
                    'wellcrafted_post_type', 
                    [ 
                        'current_post_type' => $post_type
                    ]
                );
            }, 0);
        }
    }

    /**
     * Init function for child classes
     * @return [type] [description]
     */
    protected function init() {}

    /**
     * Allows to modify columns to show on post type items list
     * @param  array $columns columns to show
     * 
     */
    public function modify_columns( $columns ) {}

    /**
     * Allows to edit columns data
     * @param  array $columns columns to show
     * 
     */
    public function edit_column( $column, $post_id ) {}

    /**
     * Allows to set params before normalizing
     */
    protected function set_params() {}

    /**
     * [normalize_params description]
     * @return [type] [description]
     *
     * @todo  PHPDoc
     */
    protected function normalize_params() {
        $this->name_label = $this->name_label ? $this->name_label : $this->post_type;
        $this->singular_name_label = $this->singular_name_label ? $this->singular_name_label : $this->name_label;
        $this->menu_name_label = $this->menu_name_label ? $this->menu_name_label : $this->name_label;
        $this->name_admin_bar_label = $this->name_admin_bar_label ? $this->name_admin_bar_label : $this->singular_name_label;
        $this->all_items_label = $this->all_items_label ? $this->all_items_label : $this->name_label;
        $this->show_ui = null !== $this->show_ui ? $this->show_ui : $this->public;
        $this->show_in_nav_menus = null !== $this->show_ui ? $this->show_in_nav_menus : $this->public;
        $this->show_in_menu = null !== $this->show_in_menu ? $this->show_in_menu : $this->show_ui;
        $this->show_in_admin_bar = null !== $this->show_in_admin_bar ? $this->show_in_admin_bar : $this->show_in_menu;
        $this->exclude_from_search = null !== $this->exclude_from_search ? $this->exclude_from_search : !$this->public;
        $this->publicly_queryable = null !== $this->publicly_queryable ? $this->publicly_queryable : $this->public;
        $this->capabilities = null !== $this->capabilities ? $this->capabilities : $this->post_type;

        if ( !is_array( $this->extra_supports ) ) {
            $this->extra_supports = array();
        }

        $this->supports = array_merge( $this->supports, $this->extra_supports );
    }

    /**
     * Set all params to the object properties.
     */
    protected function create_params() {
        $labels = [
            'name' => $this->name_label,
            'singular_name' => $this->singular_name_label,
            'menu_name' => $this->menu_name_label,
            'name_admin_bar' => $this->name_admin_bar_label,
            'all_items' => $this->all_items_label,
            'edit_item' => $this->edit_item_label,
            'new_item' => $this->new_item_label,
            'view_item' => $this->view_item_label,
            'search_items' => $this->search_items_label,
            'not_found' => $this->not_found_label,
            'not_found_in_trash' => $this->not_found_in_trash_label,
            'parent_item_colon' => $this->parent_item_colon_label
        ];

        if ( $this->add_new_label ) {
            $labels[ 'add_new' ] = $this->add_new_label;
        }

        if ( $this->add_new_item_label ) {
            $labels[ 'add_new_item' ] = $this->add_new_item_label;
        }

        $this->post_type_params = [
            'labels' => $labels,
            'public' => $this->public,
            'exclude_from_search' => $this->exclude_from_search,
            'publicly_queryable' => $this->publicly_queryable,
            'show_ui' => $this->show_ui,
            'show_in_nav_menus' => $this->show_in_nav_menus,
            'show_in_menu' => $this->show_in_menu,
            'show_in_admin_bar' => $this->show_in_admin_bar,
            'menu_position ' => $this->menu_position,
            'capability_type' => $this->capability_type,
            'capabilities' => $this->capabilities,
            'map_meta_cap' => $this->map_meta_cap,
            'hierarchical' => $this->hierarchical,
            'supports' => $this->supports,
            'register_meta_box_cb' => $this->register_meta_box_cb,
            'taxonomies' => $this->taxonomies,
            'has_archive' => $this->has_archive,
            'rewrite' => $this->rewrite,
            'can_export' => $this->can_export,
            'query_var' => $this->query_var
        ];

        if ( $this->use_meta_boxes ) {
            $this->meta_boxes_nonce_action = $this->post_type . '_meta_boxes_nonce';
        }

    }

    /**
     * Add theme supports based on a post type properties
     *
     * @todo another theme supports
     */
    private function add_theme_support() {
        if ( is_array( $this->post_type_params[ 'supports' ] ) &&
            in_array( 'thumbnail', $this->post_type_params[ 'supports' ] ) ) {
            Wellcrafted_Theme_Supports::instance()->register_support_param( 'post-thumbnails', $this->post_type );
        }
    }

    /**
     * Register current post type
     */
    public function register_post_type() {
        register_post_type( $this->post_type, $this->post_type_params );
        self::$reserved_post_types[] = $this->post_type;
        add_filter('post_updated_messages', [ &$this, 'post_updated_messages' ] );
    }

    /**
     * Allows to modify messages of a post type.
     * @return array    Messages array
     */
    final public function post_updated_messages( $messages ) {

        if ( ! array_key_exists( $this->post_type, $messages ) ) {
            if ( $this->hierarchical ) {
                $messages[ $this->post_type ] = $messages[ 'page' ];
            } else {
                $messages[ $this->post_type ] = $messages[ 'post' ];
            }
        }

        $post_type_messages = $this->current_post_updated_messages( $messages[ $this->post_type ] );
        
        if ( is_array( $post_type_messages ) ) {
            $messages[ $this->post_type ] = $post_type_messages;
        }

        return $messages;
    }

    /**
     * Allows post type to change its own messages
     * @param  array $messages Messages array
     * @return array           Modified messages array
     */
    protected function current_post_updated_messages( $messages ) {}
    
    /**
     * Add metaboxes nonce
     *
     * @todo  render nonce in a proper place
     */
    protected function render_nonce( $name ) {
        wp_nonce_field( $this->meta_boxes_nonce_action, $name );
    }

    /**
     * Add metaboxes
     */
    public function add_meta_boxes() {}

    /**
     * Do meta boxes data presave operations
     */
    public function pre_save_meta_boxes_data() {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        $this->save_meta_boxes_data();
    }

    /**
     * Check whether a nonce is valid
     * @param  string   A name of nonce
     * @return boolean  Whether a nonce is valid
     */
    protected function check_nonce( $name ) {
        // Verify that the nonce is valid.
        if ( ! isset( $_POST[ $name ] ) || 
            ! wp_verify_nonce( $_POST[ $name  ], $this->meta_boxes_nonce_action ) ) {
            return false;
        }

        return true;
    }

    /**
     * Save metaboxes data
     */
    protected function save_meta_boxes_data() {}

}