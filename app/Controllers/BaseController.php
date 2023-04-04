<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use eftec\bladeone\BladeOne;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    public $templateEngine;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $views = APPPATH.'Views';
        $cache = WRITEPATH .'cache'.DIRECTORY_SEPARATOR.'blade';
        if (!file_exists($cache)) {
            mkdir($cache,0700);
        }
        if (env('CI_ENVIRONMENT') =='production') {
            $this->templateEngine = new BladeOne(
                $views,
                $cache,
                BladeOne::MODE_AUTO
            );
        }else{
            $this->templateEngine = new BladeOne(
                $views,
                $cache,
                BladeOne::MODE_DEBUG
            );
        }

        $this->templateEngine->pipeEnable=true;
        $this->templateEngine->setBaseUrl(base_url());

        service('eloquent');
    }

    public function render(string $filename, array $param = [])
    {
        try {
            return $this->templateEngine->run($filename, $param);
        } catch (\Throwable $th) {
            if (env('CI_ENVIRONMENT') == 'production') {
                log('error', $th->getTraceAsString());
            }else{
                header_remove();
                http_response_code(500);
                header('HTTP,1.1 500 Internal Server Error');
                echo '<pre>'.$th->getTraceAsString().'</pre>';
                echo PHP_EOL;
                echo $th->getMessage();
            }
        }
    }
}
