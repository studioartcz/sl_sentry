<?php

if (!defined('_core')) {
    die;
}

$config = require _indexroot . "plugins/common/sentry/config.php";

if (null !== $config['sentry_php'] && null !== $config['sentry_js'])
{
    /* registrace extendu */
    _extend('regm',
        [
            'sys.init' => function($args) use($config) {

                if (is_file(_indexroot . 'vendor/sentry/sentry/lib/Raven/Client.php'))
                {
                    $sentryDNS = $config['sentry_php'];
                    $client = new Raven_Client("{$sentryDNS}");
                    $error_handler = new Raven_ErrorHandler($client);
                    $error_handler->registerExceptionHandler();
                    $error_handler->registerErrorHandler();
                    $error_handler->registerShutdownFunction();
                }

            },
            'tpl.head' => function ($args) use($config) {

                if(isset($config['sentry_js']) && !empty($config['sentry_js']))
                {
                    $dns = $config['sentry_js'];

                    // todo: move it as first ?
                    $args['output'] .= "\n<script type='text/javascript' src='https://cdn.ravenjs.com/3.15.0/raven.min.js'></script>";
                    $args['output'] .= "\n<script>Raven.config('{$dns}').install()</script>";
                }
                else
                {
                    $args['output'] .= "\n<script>console.warn('Please setup your `SENTRY_JS` constant for log errors.')</script>";
                }

            },

        ]
    );
}