<?php
/*
Plugin Name: Easy Reading Widget Plugin
Plugin URI: http://www.example.com/easy-reading
Description: Widget for comfortable reading
Version: 0.1
Author: Alex Neverov
Author URI: http://www.example.com
License: GPL2

    Copyright 2017 Alex Neverov

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License,
    version 2, as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

class EasyReading extends WP_Widget
{
    public function __construct() {
        parent::__construct("easy_reading", "Easy Reading Widget",
            array("description" => " Widget for comfortable reading"));
    }

    /*
      Configuration form
    */
    public function form($instance) {
        /*$title = "";
        $text = "";
        // если instance не пустой, достанем значения
        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }

        $tableId = $this->get_field_id("title");
        $tableName = $this->get_field_name("title");
        echo '<label for="' . $tableId . '">Title</label><br>';
        echo '<input id="' . $tableId . '" type="text" name="' .
        $tableName . '" value="' . $title . '"><br>';

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label for="' . $textId . '">Text</label><br>';
        echo '<textarea id="' . $textId . '" name="' . $textName .
        '">' . $text . '</textarea>';
        */
    }

    public function update($newInstance, $oldInstance) {
        $values = array();
        /*$values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        */
        return $values;
    }

    function enqueue_styles()
    {
      wp_enqueue_style( 'easy-reading-css', plugin_dir_url( __FILE__ ) . 'css/easy-reading.css', null, null, 'all');
      // wp_enqueue_style( 'easy-reading-default-css', plugin_dir_url( __FILE__ ) . 'css/easy-reading-black.css', null, null, 'all');
    }

    public function enqueue_scripts() {
     	 wp_enqueue_script( 'easy-reading-script', plugin_dir_url( __FILE__ ) . 'js/easy-reading.js', array( 'jquery' ), null, false );

  	}



    /*
      Front-end display
    */
    public function widget($args, $instance) {
      add_action("easy_reading_enqueue_style", array($this,'enqueue_styles'));
      do_action("easy_reading_enqueue_style");
      add_action("easy_reading_enqueue_script", array($this,'enqueue_scripts'));
      do_action("easy_reading_enqueue_script");

?>
        <div id="easy-reading-plugin">
          <ul class="easy-reading">
            <li><a href="" id="easy-reading-contrast"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/contrast_1.png" alt="Контраст" /></a></li>
            <li><a href="" id="easy-reading-big"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/font_1.png" alt="Шрифт" /></a></li>
            <li><a href="" id="easy-reading-off"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/color_1.png" alt="Обычная версия" /></a></li>
          </ul>
        </div>
<?php
    }
}

add_action("widgets_init", function () {
    register_widget("EasyReading");
});

add_action("wp_head", 'js_variables');

function js_variables(){
  $variables = array (
      'easy_reading_url' => plugin_dir_url( __FILE__ )
      // Тут обычно какие-то другие переменные
  );
  echo(
      '<script type="text/javascript">window.easy_reading_data = '.
      json_encode($variables).
      ';</script>'
  );
}

add_action("wp_head", "additional_css");

function additional_css(){
?>
  <link type="text/css" rel="stylesheet" media="all" id="style-color" href="<?php echo plugin_dir_url( __FILE__ ); ?>css/easy-reading-default.css"  />
  <link type="text/css" rel="stylesheet" media="all" id="style-big" href="<?php echo plugin_dir_url( __FILE__ ); ?>css/easy-reading-default.css"   />
<?php
}


?>
