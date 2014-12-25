<?php
function is_picture($file)
{
return in_array(strtolower(array_pop(explode('.', $file))), array('jpg', 'png', 'gif', 'bmp'));
}
?>
