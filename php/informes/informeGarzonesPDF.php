<?php
	session_start();
  
  if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
    require'../../PDO/conexion.php';
	require('../../fpdf/fpdf.php');
	$id_cliente = $_SESSION['ID_CLIENTE'];
	$id_local = $_SESSION['ID_LOCAL'];
	$nombre_local = $_SESSION['NOMBRE_LOCAL'];


	$objConnect = new Conexion();
	
	$objConnect->connect();
	$query = "SELECT * FROM garzon where ID_CLIENTE=".$id_cliente." AND ID_LOCAL=".$id_local.";";
	$result = mysql_query($query) or die ("No se ha podido realizar la consulta en la BD".$query);

	
	//Crear variables par PDF
	class PDF extends FPDF
	{	
	   //Cabecera de página
		function Header()
		{	
			

		   $this->Image('../../img/COMEAT.png',260,1,40);


		   $this->SetFont('Arial','B',12);
		   //Titulos
		   $this->Cell(280,10, 'Lista de garzones registrados en local' ,0,0,'C');
		   $this->Ln();
		   $this->SetFillColor(255,132,0);
		   $this->SetTextColor(0,0,0);
		   $this->Cell(37,5,'Primer nombre',1,0,'C',true);
		   $this->Cell(38,5,'Segundo nombre',1,0,'C',true);
		   $this->Cell(37,5,'Primer apellido',1,0,'C',true);
		   $this->Cell(38,5,'Segundo apellido',1,0,'C',true);
		   $this->Cell(50,5,'Correo',1,0,'C',true);
		   $this->Cell(35,5,'Password',1,0,'C',true);
		   $this->Cell(20,5,'Es Chef?',1,0,'C',true);
		   $this->Ln();

		}	
	   //Pie de página
		function Footer()
		{

		$this->SetY(-10);

		$this->SetFont('Arial','I',8);
		
		$this->Cell(0,10,'Page '.$this->PageNo().'/ Comeat / Fecha: '.date('d/m/Y'),0,0,'C');
		}
		
	}
	
	//Creación del objeto de la clase heredada
	$fpdf=new PDF('L'); //P Es vertical, L es Horizontal.
	$fpdf->AddPage();
	$fpdf->SetFont('Arial','',11);
	//Se finalizan los titulos. Se agrega un "Enter y cambiamos letra"
	
	$fpdf->SetFillColor(255,190,119);
	$color = 0;
	//Inicializamos el foreach que imprimirá todo:
	while ($row = mysql_fetch_array($result))
	{
		$imprimirColor=false;
		if($color%2 == 0){
			$imprimirColor=false;
		}else{
			$imprimirColor=true;
		}

		if($row['esCHEF'] == 0 ){
			$esChef = 'No';
		}else{
			$esChef= 'Si';
		}
		$nombre = $row['NOMBRE1_GARZON'];
		//Primer nombre
		$fpdf->Cell(37,5,$row['NOMBRE1_GARZON'],1,0,'C',$imprimirColor);
		//Segundo nombre
		$fpdf->Cell(38,5,$row['NOMBRE2_GARZON'],1,0,'C',$imprimirColor);
		//Primer apellido
		$fpdf->Cell(37,5,$row['APELLIDO1_GARZON'],1,0,'C',$imprimirColor);
		//Segundo apellido
		$fpdf->Cell(38,5,$row['APELLIDO2_GARZON'],1,0,'C',$imprimirColor);
		//Correo
		$fpdf->Cell(50,5,$row['CORREO_GARZON'],1,0,'C',$imprimirColor);
		//Password
		$fpdf->Cell(35,5,$row['CLAVE_GARZON'],1,0,'C',$imprimirColor);
		//Es chef?
		$fpdf->Cell(20,5,$esChef,1,0,'C',$imprimirColor);
		$fpdf->Ln();
		$color++;
	
	}	 
	$objConnect->closeConect();
	


	$fpdf->Output('prueba','I');
	$fpdf->Output();

		
}else{
	header("Location: ../../plantillas/errorPrivilegios.html");
	}
?>