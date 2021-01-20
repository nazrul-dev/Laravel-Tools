<?php
/*
|--------------------------------------------------------------------------
| Remove Laravel Comments
|--------------------------------------------------------------------------
|
| Just made a new Laravel project, but don't want all those big
| comment blocks? Put this in the root of your project and run
| "php remove_laravel_comments.php"
|
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

$base = './ dir';

foreach ($directories as $dir) {
    $it = new RecursiveDirectoryIterator($base . $dir);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if ($file->getExtension() == 'php') {
            echo "Removing comments from: " . $file->getRealPath() . "\n";
            $contents = file_get_contents($file->getRealPath());
			$php_comments = preg_replace('/^(\{?)\s*?\/\*(.|[\r\n])*?\*\/([\r\n]+$|$)/im', '$1', $contents);
			$blade_comments = preg_replace('/<!--.*?-->/ms', '$1', $contents);
            file_put_contents($file->getRealPath(), $php_comments);
			file_put_contents($file->getRealPath(), $blade_comments);
        }
	
    }
}
