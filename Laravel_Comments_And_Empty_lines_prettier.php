<?php
/*
|--------------------------------------------------------------------------
| Remove Laravel/PHP Comments
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Remove Empty Line
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Remove Blade Comments
|--------------------------------------------------------------------------
*/

$directories = [
  'app',
  'bootstrap',
  'config',
  'database',
  'public',
  'resources',
  'routes',
];

// You Dir Htdocs C:laragon/www/example/

$base = 'C:laragon/www/example';

foreach ($directories as $dir) {
    $it = new RecursiveDirectoryIterator($base . $dir);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if ($file->getExtension() == 'php') {
            echo "Removing comments from: " . $file->getRealPath() . "\n";
            $contents = file_get_contents($file->getRealPath());
			$php_comments = preg_replace('/^(\{?)\s*?\/\*(.|[\r\n])*?\*\/([\r\n]+$|$)/im', '$1', $contents);
			$blade_comments = preg_replace('/<!--.*?-->/ms', '$1', $contents);
			$remove_empty_lines = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $contents);
            file_put_contents($file->getRealPath(), $php_comments);
			file_put_contents($file->getRealPath(), $blade_comments);
			file_put_contents($file->getRealPath(), $remove_empty_lines);
        }
	
    }
}
