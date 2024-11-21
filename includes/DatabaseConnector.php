<?php

/*
	Class DatabaseConnector
	Connector voor een MySQL-database
	Copyright 2019 Uitgeverij Instruct B.V.
*/

class DatabaseConnector
{
    private static $pdo = null;
    
    function __construct($database, $username, $password, $port = 3306) {
		if(!(is_string($database) && is_string($username) && is_string($password))) { 
			throw new Exception("De naam van de database, de username en het wachtwoord moeten strings zijn");
		}
        if($this->isConnected()) {
			$this->close();
        }
		self::$pdo = new PDO("mysql:host=localhost;port=$port;dbname=$database;charset=UTF8", $username, $password);
    }
	
	public function isConnected() : bool {
		return (self::$pdo !== null);
	}
	
	public function close() {
		self::$pdo = null;
	}
    
    public function selectRows($query, $input = []) : array {
		if(!is_string($query)){
			throw new Exception("De query moet een string zijn");
		}
		
		$prepared = self::$pdo->prepare($query);

        if($prepared->execute($input)) {
			return $prepared->fetchAll(PDO::FETCH_NAMED);
        } else {
            throw new Exception("De query kon niet worden uitgevoerd");
        }
    }
	
	public function selectSingleRow($query, $input = []) : ?array {
		$response = $this->selectRows($query, $input);
		if(count($response) === 1) { return $response[0]; }
		return null;
    }
	
	public function selectValue($query, $input = []) {
		$response = $this->selectRows($query);
		if(count($response) === 1) { return array_values($response[0])[0]; }
		return null;
	}
	// zelfbedacht
	public function query($query, $input = []) {
		if(!is_string($query)) {
			throw new Exception("De query moet een string zijn");
		}
		
		$prepared = self::$pdo->prepare($query);
		if($prepared->execute($input)) {
			return TRUE;
		} else {
			echo "De query kon niet worden uitgevoerd";
			throw new Exception("De query kon niet worden uitgevoerd");
		}
	}
}