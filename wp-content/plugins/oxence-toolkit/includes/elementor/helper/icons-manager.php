<?php
namespace OxenceToolkit\ElementorAddon\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

class Icons_Manager {

    public function __construct() {
        add_filter( 'elementor/icons_manager/additional_tabs', [$this, 'add_icons_tab'] );
    }

    public function add_icons_tab( $tabs ) {
        $icon_css = get_template_directory_uri() . '/assets/css/flaticon.min.css';

        $tabs['oxence-flaticon'] = [
            'name'          => 'oxence-flaticon',
            'label'         => esc_html__( 'Oxence Icons', 'oxence-toolkit' ),
            'url'           => $icon_css,
            'enqueue'       => [$icon_css],
            'prefix'        => 'flaticon-',
            'displayPrefix' => 'flaticon',
            'labelIcon'     => 'flaticon flaticon-feature',
            'ver'           => time(),
            'fetchJson'     => OT_ASSETS . '/js/oxence-flaticon.js?v=' . OT_VERSION,
            'native'        => false,
        ];
        return $tabs;
    }
}

new Icons_Manager();