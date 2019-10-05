<?php
class Herramienta{
	private $conexion;

	function __construct(){
		require_once("conexion.php");
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}

	public function ingresar_datos($temp, $hum){
		$sql = " insert into sensor_temp_hum values (null, ?, ?, now()) ";
		$stmt = $this->conexion->conexion->prepare($sql);

		$stmt->bindValue(1, $temp);
		$stmt->bindValue(2, $hum);

		if($stmt->execute()){
			echo "Ingreso Exitoso";
		}else{
			echo "no se pudo registrar datos";
		}
	}
}
?>