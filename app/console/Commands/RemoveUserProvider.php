<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveUserProvider extends Command
{
    protected $signature = 'config:remove-user-provider';

    protected $description = 'Remove the users provider from auth configuration';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lee el archivo auth.php
        $authConfig = config('auth');

        // Remueve el provider 'users'
        unset($authConfig['providers']['users']);

        // Guarda los cambios en un archivo temporal
        $configContent = '<?php return ' . var_export($authConfig, true) . ';';
        file_put_contents(config_path('auth.php'), $configContent);

        $this->info('Provider users removed successfully.');
    }
}
