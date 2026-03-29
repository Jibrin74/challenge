<?php
/**
 * Nexora Payment Platform Autoloader
 * Simple PSR-4 style implementation
 */

spl_autoload_register(function ($class) {
    // Project-specific namespace prefix
    $prefix = '';

    // Base directory for the namespace prefix
    $base_dir = __DIR__ . '/includes/';

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if ($prefix !== '' && strncmp($prefix, $class, $len) !== 0) {
        // No, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relative_class = $prefix !== '' ? substr($class, $len) : $class;

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
