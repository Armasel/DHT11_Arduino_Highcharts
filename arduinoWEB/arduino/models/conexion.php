<?php
class conexion
{
	private $servidor;
	private $usuario;
	private $contrasena;
	private $basedatos;
	public  $conexion;

	public function __construct(){
		$this->servidor   = "localhost";
		$this->usuario	  = "root";
		$this->contrasena = "P@55w0rd!";
		$this->basedatos  = "proyecto";

	}

	function conectar(){
		$this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->basedatos","$this->usuario","$this->contrasena");
	}

	function cerrar(){
		$this->conexion->close();
	}
}
?>
