<?php defined('SYSPATH') or die('No direct script access.');

class Multiformat_I18n extends Kohana_I18n {

   public static function load($lang)
   {
       if (isset(I18n::$_cache[$lang]))
		{
			return I18n::$_cache[$lang];
		}

		// New translation table
		$table = array();

		// Split the language: language, region, locale, etc
		$parts = explode('-', $lang);

		do
		{
			// Create a path for this set of parts
			$path = implode(DIRECTORY_SEPARATOR, $parts);
            foreach(Extensions::extensions() as $ext)
            {
                if ($files = Kohana::find_file('i18n', $path, $ext, TRUE))
                {
                    $t = array();
                    foreach ($files as $file)
                    {
                        // Merge the language strings into the sub table
                        $t = array_merge($t, Parser::parse_file($file, $ext));
                    }

                    // Append the sub table, preventing less specific language
                    // files from overloading more specific files
                    $table += $t;
                }
            }
			// Remove the last part
			array_pop($parts);
		}
		while ($parts);

		// Cache the translation table locally
		return I18n::$_cache[$lang] = $table;
   }

}