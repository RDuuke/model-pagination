<?php

abstract class Conexion {

    protected $pdo;

    public function __construct ()
    {
        try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=extensio_certificados', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}		       
    }
}