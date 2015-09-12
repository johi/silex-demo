<?php
namespace johi\SilexDemo\app\web;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../src/controllers/ApplicationController.php';

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use johi\SilexDemo\app\controller\ApplicationController;

$application = new Application();
$application['debug'] = true;
$application->register(new ServiceControllerServiceProvider());
$application->register(new FormServiceProvider());
$application->register(new ValidatorServiceProvider());
$application->register(new TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));
$application->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../../src/views',
    'twig.form.templates' => array('/Form/form_widget.twig')
));
$application->register(new SessionServiceProvider());
$application->register(new SwiftmailerServiceProvider());

//$app->register(new Provider\UrlGeneratorServiceProvider(), array());
$application->register(new HttpFragmentServiceProvider());
$application['application.controller'] = $application->share(function () use ($application) {
    return new ApplicationController();
});
$application->match('/', 'application.controller:subscribe');
$application->get('/subscription-confirmation', 'application.controller:subscriptionConfirmation');
$application['swiftmailer.options'] = array(
    'host' => 'localhost',
    'port' => '1025',
    'username' => '',
    'password' => '',
    'encryption' => null,
    'auth_mode' => null
);
$application->run();
