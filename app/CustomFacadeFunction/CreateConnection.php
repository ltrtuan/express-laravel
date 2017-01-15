<?php
namespace App\CustomFacadeFunction;
use DB;
use App;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Auth;
use Artisan;

class CreateConnection
{  
    public $databaseConnection;
    
     /**
	 * Creates a new database schema.
	 * @param  string $schemaName The new schema name.
	 * @return bool
	 */
	public function createSchema($idUser)
	{
	    // We will use the `statement` method from the connection class so that
	    // we have access to parameter binding.

	    if($this->checkDBUserExist($idUser) > 0)
	    {
	    	DB::statement('CREATE SCHEMA '.$this->getNameDatabaseUser($idUser).' CHARACTER SET utf8 COLLATE utf8_general_ci;');
	    	return DB::statement('GRANT ALL PRIVILEGES ON '.$this->getNameDatabaseUser($idUser).'.* TO "'.config('database.connections.mysql.username').'"@"%"');
	    }
	    return false;
	}

	public function createTable($idUser)
	{
		try {
		  	Artisan::call('migrate', array('--database' => $this->getNameDatabaseUser($idUser), '--path' => 'database/migrations/subuser'));
			return true;
		} catch(\Exception $e) {
		  	return $e;
		}

	}


    public function setupConnection($idUseParam = 0)
    {       
        $nameDatabase = '';
        if($idUseParam > 0)
        {        	
        	if($this->checkDBUserExist($idUseParam) > 0)
        	{
        		$nameDatabase = $this->getNameDatabaseUser($idUseParam);
        	}
        	
        }else{
        	$currentUser = Auth::user();
        	/**
        	 * JUST GET USER IS NOT SUPER ADMIN TO CREATE NEW CONNECTION
        	 */
	        if($currentUser->id > 0 && $currentUser->role_id != 1)
	        {	        	
	        	/**
	        	 * IF USER IS SUB MANAGER OR NORMAL USER, CAN NOT GET DATABASE FOR NEW CONNECTION, NEED RECURSIVE GET PARENT ID USER TO GET DATABASE
	        	 */
	        	if($this->checkDBUserExist($currentUser->id) == 0)
	        	{	        		
	        		if($this->checkDBUserExist($currentUser->parent) > 0)
	        		{
	        			$nameDatabase = $this->getNameDatabaseUser($idUserManagerHasDB);
	        		}	        		
	        	}
	        	else
	        	{
	        		$nameDatabase = $this->getNameDatabaseUser($currentUser->id);
	        	}

	        }//END if($currentUser->id > 0 && $currentUser->role_id == 2)
        }
       
        if($nameDatabase != '')
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
		    return true;
        }//END if($nameDatabase != '')

        return false;
	   
    }

    public function getNameDatabaseUser($idUser){
    	return 'express_'.$idUser;
    }

    private function checkDBUserExist(&$idUser){
    	if($idUser > 0){
    		$checkDBExist = DB::statement('SHOW DATABASES LIKE "'.$this->getNameDatabaseUser($idUser).'"');
    		if(!$checkDBExist){
    			$userExist = User::whereId($idUser)->first();
    			$this->checkDBUserExist($userExist->parent);
    		}
    		return $idUser;
    	}
    	return 0;
    }

}