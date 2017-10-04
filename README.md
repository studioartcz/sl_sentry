# Sentry.io for Sunlight CMS 7.5.x

error handler for deprecated cms

## Install

1. add this to your `composer.json`, extra section:

    ```
    {
        "source": "vendor/studioartcz/sentry/plugins",
        "destination": "plugins",
        "debug": "true"
    }
    ```

2. type: `composer require studioartcz/sl_sentry dev-master`
3. add ignored files (.gitignore):

    ```
    # composer plugins
    plugins/extend/composer
    plugins/extend/sentry
    plugins/common/sentry
    ```

3. done
