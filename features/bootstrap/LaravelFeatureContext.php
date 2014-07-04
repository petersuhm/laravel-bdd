<?php

use Illuminate\Foundation\Testing\Client;

trait LaravelFeatureContext
{
    /**
     * The Illuminate application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The HttpKernel client instance.
     *
     * @var \Illuminate\Foundation\Testing\Client
     */
    protected $client;

    /**
     * Prepare the test environment.
     *
     * @return void
     */
    public function prepareApplication()
    {
        if ( ! $this->app)
        {
            $this->refreshApplication();
        }
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        $this->app = $this->createApplication();

        $this->client = $this->createClient();

        $this->app->setRequestForConsoleEnvironment();

        $this->app->boot();
    }

    /**
     * Create a new HttpKernel client instance.
     *
     * @param  array  $server
     * @return \Symfony\Component\HttpKernel\Client
     */
    protected function createClient(array $server = array())
    {
        return new Client($this->app, $server);
    }
}
