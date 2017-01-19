<?php

namespace App\CustomFacadeFunction;

class AppHelper
{
	public function showAlertFlashMessage($session, $nameSession = array())
	{		
		foreach ($nameSession as $name)
		{
			if($session::has($name))
			{
	?>
		        <p class="alert <?php echo $name;?>">
		        	<?php echo $session::get($name) ?>
		        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		        </p>
	<?php
			}
		}	  
	}
}