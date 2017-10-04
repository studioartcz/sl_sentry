<?php

/* ----- kontrola jadra ----- */

if (!defined('_core')) die;

/* ----- akce ----- */

switch ($action)
{

    case 'config':

        // nacteni konfigurace
        $cfg = _pluginLoadConfig($plugin);

        // ulozeni
        if (isset($_POST['save']))
        {

            // nacist
            $cfg['sentry_php'] = _post('sentry_php');
            $cfg['sentry_js'] = _post('sentry_js');

            // zpracovat
            if ($cfg['sentry_php'] === '')
                $cfg['sentry_php'] = null;

            if ($cfg['sentry_js'] === '')
                $cfg['sentry_js'] = null;

            // ulozit
            if (_pluginSaveConfig($plugin, $cfg) !== false)
                $output .= _formMessage(1, $_lang['global.saved']);
            else
                $output .= _formMessage(2, $_lang['global.error']);
        }


        // formular
        $output .= "<p class='bborder'>Potřebné API klíče získáte na webu <a href='https://sentry.io/welcome/' target='_blank'>Sentry.io</a></p>
<form action='" . $url . "' method='post'>
<table class='form'>
<tr>
  <td class='rpad'><strong>sentry_php</strong></td>
  <td><input type='text' name='sentry_php' "._restorePostValue('sentry_php',$cfg['sentry_php'],false)." class='inputbig' /></td>
</tr>

<tr>
  <td class='rpad'><strong>sentry_js</strong></td>
  <td><input type='text' name='sentry_js' "._restorePostValue('sentry_js',$cfg['sentry_js'],false)." class='inputbig' /></td>
</tr>

</table>
" . _xsrfProtect() . "
<input type='submit' name='save' value='" . $_lang['global.save'] . "' />
</form>";

        break;


    case 'uninstall':
        $output .= "<p>Pro odinstalování pluginu smažte následující adresáře:</p>
<ul>
    <li><code>root/plugins/common/sentry/</code></li>
    <li><code>root/plugins/extend/sentry/</code></li>
</ul>";

}