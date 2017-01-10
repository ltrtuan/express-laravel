<?php
namespace App\CustomFacadeFunction;
use DB;
use App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Artisan;
class CreateConnection
{  
    public $databaseConnection;
    
     /**
	 * Creates a new database schema.

	 * @param  string $schemaName The new schema name.
	 * @return bool
	 */
	public function createSchema($schemaName)
	{
	    // We will use the `statement` method from the connection class so that
	    // we have access to parameter binding.
	    return DB::statement('CREATE DATABASE '.$schemaName.' CHARACTER SET utf8 COLLATE utf8_general_ci');
	}

	public function createTable($nameDatabase)
	{
		//Artisan::call('migrate', array('database' => $this->databaseConnection, 'path' => 'app/database/subuser'));
		$this->setupConnection($nameDatabase);
		Artisan::call('migrate', array('--database' => $nameDatabase, '--path' => 'database/migrations/subuser'));
		
	}


    public function setupConnection($nameDatabase)
    {
        // Just get access to the config. 
	    $config = App::make('config');

	    // Will contain the array of connections that appear in our database config file.
	    $connections = $config->get('database.connections');

	    // This line pulls out the default connection by key (by default it's `mysql`)
	    $defaultConnection = $connections[$config->get('database.default')];

	    // Now we simply copy the default connection information to our new connection.
	    $newConnection = $defaultConnection;
	    // Override the database name.
	    $newConnection['database'] = $nameDatabase;

	    // This will add our new connection to the run-time configuration for the duration of the request.
	    App::make('config')->set('database.connections.'.$nameDatabase, $newConnection);
	   
    }

    public function getNameDatabaseUser($idUser){
    	return 'express_'.$idUser;
    }

}