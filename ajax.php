<?php
if (array_key_exists('deco', $_POST)) {

    $deco = $_POST['deco'];
    // do stuff with params

    echo 'Yes, it works!';

} else {
    echo 'Invalid parameters!';
}
?>