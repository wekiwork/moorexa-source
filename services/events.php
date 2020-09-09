<?php

use Lightroom\Events\{
    Dispatcher, Listener, AttachEvent
};

/**
 * @package Event registry file
 * @author Amadi Ifeanyi <amadiify.com>
 * 
 * Here you can attach an event class, register it's method, listen for an event, dispatch an event
 */
AttachEvent::attach(Lightroom\Events\ExampleBasic::class, 'ev');
