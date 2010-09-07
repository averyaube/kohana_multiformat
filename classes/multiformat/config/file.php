<?php defined('SYSPATH') or die('No direct script access.');

class Multiformat_Config_File extends Kohana_Config_File {

    public function load($group, array $config = NULL)
    {
        // This gets done up here now, or else the loop would keep clearing it. Hopefully no issue
        $config = array();

        foreach(Extensions::extensions() as $ext)
        {
            if ($files = Kohana::find_file($this->_directory, $group, $ext, TRUE))
            {
                foreach ($files as $file)
                {
                    // Parse and merge each file to the configuration array
                    $config = Arr::merge($config, Parser::parse_file($file, $ext));
                }
            }
        }

        // Took this from Kohana_Config_Reader because it looks like returning it to the parent would be a mess
        $object = clone $this;

		// Set the group name
		$object->_configuration_group = $group;

		// Swap the array with the actual configuration
		$object->exchangeArray($config);

		return $object;

    }

}