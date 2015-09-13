<?php
/**
 * Created by PhpStorm.
 * User: johan
 * Date: 16-04-15
 * Time: 16:08
 */

namespace johi\SilexDemo\ConfigurationParser;

use johi\SilexDemo\Exception\ArgumentException;
use johi\SilexDemo\Exception\FormatException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;


/**
 * Class ConfigurationParser
 * This is a quick and dirty approach to reading configuration files, although tested it can be made a hell lot smarter than this
 */
class ConfigurationParser {

    /** @type FileLocator */
    private $locator;

    const ERROR_MESSAGE_DIRECTORY_DOES_NOT_EXIST = 'Directory does not exist: %s';

    const ERROR_MESSAGE_CONFIGURATION_FILE_NOT_FOUND = 'Configuration file not found: %s';

    const ERROR_MESSAGE_TARGET_NOT_FOUND = 'Target not found: %s';

    const ERROR_MESSAGE_INVALID_YAML_FILE = 'Invalid yaml file: %s';

    public function __construct($directory) {
        $this->setLocator($directory);
    }

    public function setLocator($directory) {
        if (!file_exists($directory)) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_DIRECTORY_DOES_NOT_EXIST, $directory));
        }
        $this->locator = new FileLocator(array(realpath($directory)));
    }

    public function parse($dbConfigTarget, $dbConfigFilename) {
        try {
            $yamlDbConfig = $this->locator->locate($dbConfigFilename, null, false);
        }
        catch (\Exception $e)
        {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_CONFIGURATION_FILE_NOT_FOUND, $dbConfigFilename));
        }
        //save since we know that it exists :-)
        $file_contents = file_get_contents($yamlDbConfig[0]);
        try {
            $configValues = Yaml::parse($file_contents);
        }
        catch (\Exception $e)
        {
            throw new FormatException(sprintf(self::ERROR_MESSAGE_INVALID_YAML_FILE, $dbConfigFilename));
        }

        if (!isset($configValues[$dbConfigTarget])) {
            throw new ArgumentException(sprintf(self::ERROR_MESSAGE_TARGET_NOT_FOUND, $dbConfigTarget));
        }
        return $configValues[$dbConfigTarget];
    }
}