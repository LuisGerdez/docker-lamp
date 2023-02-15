<?php
require_once "../../config/SERVER.php";

class conexion
{
	private $servidor;
	private $usuario;
	private $contrasena;
	private $basedatos;
	public $conexion;

	public function __construct()
	{
		$this->servidor = SERVER;
		$this->usuario = USER;
		$this->contrasena = PASS;
		$this->basedatos = DB;
	}
	
	function conectar()
	{
		$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
		$this->conexion->set_charset("utf8");
		/*if (!$this->conexion) {
			echo "No conectado";
		} else {
			echo "Conectado !!!";
		}*/
	}

	function cerrar(){
		$this->conexion->close();
	}
}