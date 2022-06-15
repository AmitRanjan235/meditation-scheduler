<?php

require "config.php";

class DBCon
{
	protected $pdoconn;
	
	function __construct()
	{
		try {
		    $this->pdoconn = new PDO("mysql:host=".Credentials::host."; dbname=".Credentials::database, Credentials::user, Credentials::pwd, array( PDO::ATTR_PERSISTENT => true ));
		    $this->pdoconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
		    die("Can not access DB ".Credentials::database.", ".$e->getMessage());
		}
	}
}


?>


