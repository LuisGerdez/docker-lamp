<?php

class Tablas
{
	private $conexion;

	function __construct(){
			require_once 'conexion.php';
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}

	/*---------- Función para mostrar datos en la tabla de pendientes ----------*/
	function tabla_pendientes_model($iduser)
	{		
		$sql = "CALL SP_LISTAR_PENDIENTES('$iduser')";
		$arreglo = array();
		if ($consulta = $this->conexion->conexion->query($sql)) {
			while($connsulta_vu = mysqli_fetch_assoc($consulta)){
				$arreglo["data"][] = $connsulta_vu;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para mostrar datos en la tabla de firmados ----------*/
	function tabla_firmados_model($iduser)
	{
		$sql = "CALL SP_LISTAR_FIRMADOS('$iduser')";
		$arreglo = array();
		if ($consulta = $this->conexion->conexion->query($sql)) {
			while($connsulta_vu = mysqli_fetch_assoc($consulta)){
				$arreglo["data"][] = $connsulta_vu;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para mostrar datos en la tabla de eliminados ----------*/
	function tabla_eliminados_model($iduser)
	{
		$sql = "CALL SP_LISTAR_ELIMINADOS('$iduser')";
		$arreglo = array();
		if ($consulta = $this->conexion->conexion->query($sql)) {
			while($connsulta_vu = mysqli_fetch_assoc($consulta)){
				$arreglo["data"][] = $connsulta_vu;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para eliminar datos en la tabla de pendientes ----------*/
	function eliminar_documento_pendiente_model($iddocumento,$nueva_ruta)
	{
		$sql = "CALL SP_ELIMINAR_DOCUMENTO_PENDIENTES('$iddocumento','$nueva_ruta')";
		if ($consulta = $this->conexion->conexion->query($sql)) {
			if ($row = mysqli_fetch_array($consulta)) {
				return $respuesta = trim($row[0]);
			}
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para eliminar definitivamente datos en la tabla de pendientes ----------*/
	function eliminar_documento_definitivo_model($iddocumento)
	{
		$sql = "CALL SP_ELIMINAR_DOCUMENTO_DEFINITIVO('$iddocumento')";
		if ($consulta = $this->conexion->conexion->query($sql)) {
			if ($row = mysqli_fetch_array($consulta)) {
				return $respuesta = trim($row[0]);
			}
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para eliminar datos en la tabla de pendientes ----------*/
	function restaurar_documento_eliminado_model($iddocumento,$nombredocumento,$nueva_ruta)
	{
		$sql = "CALL SP_RESTAURAR_DOCUMENTOS_ELIMINADOS('$iddocumento','$nombredocumento','$nueva_ruta')";
		if ($consulta = $this->conexion->conexion->query($sql)) {
			if ($row = mysqli_fetch_array($consulta)) {
				return $respuesta = trim($row[0]);
			}
			$this->conexion->cerrar();
		}
	}

	/*---------- Función para mostrar datos en informe de documentos de firmados ----------*/
	function reporte_firmados_model($iduser)
	{
		$sql = "CALL SP_LISTAR_FIRMADOS('$iduser')";
		$consulta = $this->conexion->conexion->query($sql);
		return $consulta;
		$this->conexion->cerrar();
	}

	/*---------- Función para mostrar datos en informe de documentos pendientes ----------*/
	function reporte_pendientes_model($iduser)
	{
		$sql = "CALL SP_LISTAR_PENDIENTES('$iduser')";
		$consulta = $this->conexion->conexion->query($sql);
		return $consulta;
		$this->conexion->cerrar();
	}

}