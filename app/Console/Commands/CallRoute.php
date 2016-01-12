<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Http\Request;

/**
 * example usage: php artisan route:call --token=bdf22e409d051ec2c311027438066659b2a2a304 --uri=api/v1/customerservice/download-data
 */

class CallRoute extends Command {

    protected $name = 'route:call';
    protected $description = 'Call route from CLI';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $request = Request::create((string)$this->option('uri'), 'GET');
        $request->headers->set('X-Authorization', $this->option('token'));
        $this->info(strip_tags(
        	app()['Illuminate\Contracts\Http\Kernel']->handle($request)
        ));
    }

    protected function getOptions()
    {
        return [
            ['token', null, InputOption::VALUE_REQUIRED, 'The auth token', null],
            ['uri', null, InputOption::VALUE_REQUIRED, 'The path of the route to be called', null],
        ];
    }

}
