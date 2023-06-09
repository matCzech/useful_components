<?php

$name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option($name);
        echo '<div class="'.$classes.'">
            <input type="checkbox" name="'.$name.'" id="'.$name.'" value="1" class="" '.($checkbox ? 'checked' : '').'>
            <label for="'.$name.'"><div></div></label>
            </div>';
    }

?>

<style>
    div.ui-toggle {
    margin: 0;
    padding: 0;
  }
  div.ui-toggle input[type='checkbox'] {
    display: none;
  }
  div.ui-toggle input[type='checkbox']:checked + label {
    border-color: #009eea;
    background: #009eea;
    box-shadow: inset 0 0 0 10px #009eea;
  }
  div.ui-toggle input[type='checkbox']:checked + label > div {
    margin-left: 20px;
  }
  div.ui-toggle label {
    transition: all 200ms ease;
    display: inline-block;
    position: relative;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background: #8c8c8c;
    box-shadow: inset 0 0 0 0 #009eea;
    border: 2px solid #8c8c8c;
    border-radius: 22px;
    width: 40px;
    height: 20px;
  }
  div.ui-toggle label div {
    transition: all 200ms ease;
    background: #FFFFFF;
    width: 20px;
    height: 20px;
    border-radius: 10px;
  }
  div.ui-toggle label:hover, div.ui-toggle label > div:hover {
    cursor: pointer;
  }

</style>