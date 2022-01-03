<?php
function autoLoad($name)
{
    if (file_exists('./Controllers/' . $name . '.php')) {
        require_once './Controllers/' . $name . '.php';
    } else     if (file_exists('./Model/' . $name . '.php')) {
        require_once './Model/' . $name . '.php';
    } else if (file_exists('./View/' . $name . '.php')) {
        require_once './View/' . $name . '.php';
    }
    else if (file_exists('./Core/' . $name . '.php')) {
        require_once './Core/' . $name . '.php';
    }
}

spl_autoload_register('autoLoad');

$events = new EventController();
$events->endEvents();

$volhnteer = new VolunteerController();
#$volhnteer->notifyNearEvents();
