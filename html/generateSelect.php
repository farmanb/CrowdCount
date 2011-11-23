<?php
    function generateSelect($name = '', $options = array(), $onchange=''){
	$html = '<select id="' . $name . '" onchange="' . $onchange . '">' . "\n";
	foreach ($options as $option => $value){
	    $html .= '<option value="'.$value.'">'.$option.'</option>' . "\n";
	}
	$html .= '</select>';
	return $html;
    }    
?>

