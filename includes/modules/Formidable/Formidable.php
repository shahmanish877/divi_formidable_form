<?php

class DICM_Formidable extends ET_Builder_Module {

	public $slug       = 'dicm_formidable';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Manish Shah',
		'author_uri' => 'www.manishshah.info.np',
	);

	public function init() {
		$this->name = esc_html__( 'Formidable', 'dicm-divi-custom-modules' );
	}

	public function get_fields() {
        global $wpdb;
        $result = $wpdb->get_results("SELECT id, name FROM ". $wpdb->prefix . "frm_forms");
        $options = array();
        $index = 0;
        foreach ($result as $arr){
            $options += array($result[$index]->id => $result[$index]->name);
            $index++;
        }
		return array(
			'heading'     => array(
				'label'           => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading here.', 'dicm-divi-custom-modules' ),
                'toggle_slug'      => 'main_content',

            ),
            'formidable_id' => array(
                'label'           => esc_html__( 'Select Formidable Form', 'dicm-divi-custom-modules' ),
                'type'            => 'select',
                'default'         => '1',
                'option_category' => 'basic_option',
                'options'         => $options,
                'description'     => esc_html__( 'Choose the formidable form', 'dicm-divi-custom-modules' ),
                'toggle_slug'      => 'main_content',

            ),
            'title' => array(
                'label'           => esc_html__( 'Fromidable Title', 'dicm-divi-custom-modules' ),
                'type'            => 'select',
                'default'         => 'true',
                'option_category' => 'basic_option',
                'options'         => array(
                    'true' => 'True',
                    'false' => 'False',
                ),
                'toggle_slug'      => 'main_content',

            ),
            'description' => array(
                'label'           => esc_html__( 'Fromidable Description', 'dicm-divi-custom-modules' ),
                'type'            => 'select',
                'default'         => 'true',
                'option_category' => 'basic_option',
                'options'         => array(
                    'true' => 'True',
                    'false' => 'False',
                ),
                'toggle_slug'      => 'main_content',

            ),
            'has_data' => array(
                'label'           => esc_html__( 'has_data', 'dicm-divi-custom-modules' ),
                'type'            => 'select',
                'default'         => 'true',
                'option_category' => 'basic_option',
                'options'         => array(
                    'true' => 'True',
                    'false' => 'False',
                ),
                'description'     => esc_html__( 'Choose the formidable form', 'dicm-divi-custom-modules' ),
                'toggle_slug'      => 'main_content',

            ),
		);
	}

	public function render( $unprocessed_props, $content, $render_slug ) {
        wp_enqueue_style( 'dicm_insert_custom_style' );

        echo "<script> 
                    console.log('has_data is ". $this->props['has_data']."')
                </script>";

        return sprintf(
			'<h1>%1$s</h1>
			<div>%2$s</div>',
			esc_html( $this->props['heading'] ),
            FrmFormsController::get_form_shortcode( array( 'id' => $this->props['formidable_id'], 'title' => $this->props['title'], 'description' => $this->props['description'] ) )
		);
	}
}

new DICM_Formidable;
