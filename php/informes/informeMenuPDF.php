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
	$query = "SELECT menu.NOMBRE_MENU AS NOMBRE, menu.DESCRIPCION_MENU AS DESCRIPCION, menu.PRECIO_MENU AS PRECIO, menu.OFERTA_MENU AS OFERTA,categoria_menu.NOMBRE_CATEGORIA_MENU AS CATEGORIA FROM menu INNER JOIN categoria_menu ON menu.ID_CATEGORIA_MENU=categoria_menu.ID_CATEGORIA_MENU WHERE  menu.ID_CLIENTE=".$id_cliente." AND categoria_menu.ID_CLIENTE=".$id_cliente." AND menu.ID_LOCAL=".$id_local." AND categoria_menu.ID_LOCAL=".$id_local." ORDER BY CATEGORIA ASC;";



	
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
		   $this->Cell(280,10, 'Lista de menus registrados en local' ,0,0,'C');
		   $this->Ln();
		   $this->Cell(30,5,'',0,0,'C');
		   

		   $this->SetFillColor(255,132,0);
		   $this->SetTextColor(0,0,0);
		   $this->Cell(45,5,'NOMBRE DE MENU',1,0,'C', true);
		   $this->Cell(38,5,'VALOR ($)',1,0,'C', true);
		   $this->Cell(37,5,'DSCTO (%)',1,0,'C', true);
		   $this->Cell(38,5,'TOTAL ($)',1,0,'C', true);
		   $this->Cell(50,5,'CATEGORIA',1,0,'C', true);
		   
		   
		  
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
		//Calculo del total del menú
		$imprimirColor=false;
		if($color%2 == 0){
			$imprimirColor=false;
		}else{
			$imprimirColor=true;
		}

		$valor= $row['PRECIO'];
		$descuento = $row['OFERTA'];
		$incognita = ($descuento*$valor)/100;
		$total = $valor-$incognita;
		//Espacio para centrar
		$fpdf->Cell(30,5,'',0,0,'C');
		//Nombre
		$fpdf->Cell(45,5,$row['NOMBRE'],1,0,'C', $imprimirColor);
		//Valor
		$fpdf->Cell(38,5,$valor,1,0,'C', $imprimirColor);
		//DSCTO
		$fpdf->Cell(37,5,$descuento,1,0,'C', $imprimirColor);
		//TOTAL
		$fpdf->Cell(38,5,$total,1,0,'C', $imprimirColor);
		//CATEGORIA
		$fpdf->Cell(50,5,$row['CATEGORIA'],1,0,'C', $imprimirColor);
		//Salto de linea
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