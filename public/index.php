<?php

// Load Composer dependencies
require __DIR__ . '/../vendor/autoload.php';

// Initialize Framework X application
$application = new FrameworkX\App();

// Root endpoint - returns project information
$application->get('/', function () {
    $info = [
        'project' => 'Monotonic Version System',
        'status' => 'operational',
        'version_type' => 'monotonically_increasing_integer'
    ];
    
    return React\Http\Message\Response::json($info);
});

// Version endpoint - demonstrates monotonic versioning
$application->get('/version', function () {
    return React\Http\Message\Response::plaintext(
        "Current version: 1\n"
    );
});

// Health check endpoint
$application->get('/health', function () {
    return React\Http\Message\Response::json([
        'healthy' => true,
        'timestamp' => time()
    ]);
});

// Dynamic route for version queries
$application->get('/version/{id}', function (Psr\Http\Message\ServerRequestInterface $req) {
    $versionId = $req->getAttribute('id');
    
    return React\Http\Message\Response::json([
        'version_id' => $versionId,
        'type' => 'monotonic_integer'
    ]);
});

// Start the application
$application->run();
