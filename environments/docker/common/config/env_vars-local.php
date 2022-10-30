<?php

############################################################################
# For sake of simplicity, this file gathers some ENVIRONMENT VARIABLES
# use in /api /backend /common /console
# This file is included in :
# /environments/docker/api/web/index.php
# /environments/docker/backend/web/index.php
# /environments/docker/console/web/index.php
# /environments/docker/common/yii
############################################################################

/**
 * Get configuration key from environment variable
 *
 * Keep in mind that a populated environment variable value will
 * always be a string!
 * This means that if:
 *   - ENV variable has value of 'true', will return a STRING.
 *   - ENV variable has value of 'false', will return STRING.
 *   - ENV variable is not defined, will return boolean(false)
 *
 * Here's some sample test cases:
 * ```
 * echo "\nTESTX: " . getenv('TESTX');
 * echo "\nTESTX (cfg_env): " . (cfgEnv('TESTX') === true ? 'is true' : 'is false');
 * echo "\nUNDEF: " . (cfgEnv('UNDEF') === false ? 'is false' : 'undefined');
 * echo "\nUNDEF: " . (cfgEnv('UNDEF') == false ? 'is false' : 'undefined');
 *
 * TESTX: true
 * TESTX (cfg_env): is false
 * UNDEF: is false
 * UNDEF: is false
 *```
 *
 *  @param string $env_name
 * @param boolean $default  default value - defaults to boolean(false)
 * @return string
 */
function cfgEnv($env_name, $default = false)
{
    if (getenv($env_name) == true) {
        return getenv($env_name);
    }
    return $default;
}

/**
 * Get boolean value of a variable
 *
 * Compares "true" "false" string and returns correspondent boolean value
 * Falls back to PHP boolval() function
 *
 * @param string $value
 * @return boolean
 */
function cfgEnvBoolean($value)
{
    if (strtolower($value) == "true") {
        return true;
    } elseif (strtolower($value) == "false") {
        return false;
    }
    return boolval($value);
}

/**
 * Reads an Environment Variable and expects its value to be JSON.
 * If not defined, or there is an error parsing it will return an empty array
 * Converts Json to PHP Array like in: https://wtools.io/convert-json-to-php-array
 * (reverse) https://www.nestforms.com/php-print_r-to-json-online
 *
 * @param string $env_name  ENV Variable name
 * @param string $default   Default value
 * @return void
 */
function cfgArrayFromJsonEnv($env_name, $default = '{}')
{
    $value = cfgEnv($env_name, false);
    if ($value === false) {
        $value = $default;
    }

    $data = json_decode(preg_replace("/'/", "", $value), true);
    if (is_null($data)) {
        error_log("ENV VAR: '$env_name' may have a bad JSON format! $data", 0);
        return $default;
    }
    return $data;
}

# Define below variables used in configuration files of current environment
# Do not duplicate variable definition - Define variables here preferably

# YII variables
define('YII_DEBUG', cfgEnvBoolean(cfgEnv('YII_DEBUG', false)));
define('YII_ENV', cfgEnv('YII_ENV', 'docker'));
define('YII_ENV_DEV', cfgEnvBoolean(cfgEnv('YII_ENV_DEV', false)));
define('YII_ENV_TEST', cfgEnvBoolean(cfgEnv('YII_ENV_TEST', false)));
define('YII_ENV_PROD', cfgEnvBoolean(cfgEnv('YII_ENV_PROD', true)));
