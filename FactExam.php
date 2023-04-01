<?php
   require('codigos/fpdf.php');


  //----------------------------------------------------
    //CONEXIÓN A LA BD
    // Establecer los parámetros de conexión a la base de datos
    $servidor  = "127.0.0.1";
    $basedatos = "northwind";
    $usuario   = "root";
    $contra    = "60401Utn";

    $conex = new mysqli($servidor, $usuario, $contra, $basedatos);

    // Verifica si hay error en la conexión a la BD
    if ($conex->connect_error) {
        die("La conexión falló: " . $conex->connect_error);
    }
//-- Nombre [CompayName], Contacto [ContactTittle y Contact Name], Ubicación [Country,ShipCity,PostalCode]
//,$ShipCity,$PostalCode
    class PDF extends FPDF{
        function SepProveedor($CompayName,$ContactTitle,$Contact,$Country,$ShipCity,$PostalCode){
         
            $this->SetFont('Arial','',12);
            $this->SetFillColor(200,220,255);
            $this->Cell(25,25,$CompayName,0,0,'L');
            $this->Ln(8);
            $this->Cell(40,25,$ContactTitle,0,0,'L');
            $this->Cell(40,25,$Contact,0,0,'L');
            $this->Ln(8);
            $this->Cell(40,25,$Country,0,0,'L');
            $this->Cell(40,25,$ShipCity,0,0,'L');
            $this->Cell(30,25,$PostalCode,0,0,'L');
            $this->Ln(50);

            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');
            $this->Cell(25,25,$CompayName,1,0,'L');

         }
    }

    $AuxSql = 'select  c.CompanyName , c.ContactTitle,c.ContactName,c.Country,o.ShipCity,c.PostalCode ';
    $AuxSql = $AuxSql.'FROM customers c ';
    $AuxSql = $AuxSql.'INNER JOIN orders o ON c.CustomerID = "ANTON" ';
    $AuxSql = $AuxSql.'WHERE o.OrderDate BETWEEN "1994-08-04 00:00:00" AND "2000-08-04 00:00:00"';
    
    $Regis = mysqli_query($conex, $AuxSql) or die(mysqli_error($conex));

   
    $pdf=new PDF();
   $pdf->AddPage();

   $pdf->SetFont('Courier','B',10);

//-- Nombre [CompayName], Contacto [ContactTittle y Contact Name], Ubicación [Country,ShipCity,PostalCode]

    //Declara variable para la impresion del proveedor
    $NomProve = ''; 

    while($row_Regis = mysqli_fetch_assoc($Regis)){
        if($NomProve != $row_Regis['CompanyName']){
           //Invoca la impresion de separador por proveedor
           $pdf->SepProveedor('Cliente: '.$row_Regis['CompanyName'],'Contacto: '.$row_Regis['ContactTitle'],$row_Regis['ContactName'],'Ubicación:  '.$row_Regis['Country'],$row_Regis['ShipCity'],$row_Regis['PostalCode']);

           //Asigna el proveedor actual hasta cambiar
           $NomProve = $row_Regis['CompanyName'];  
        }
        //Invoca metodo para imprimir datos producto
        //$pdf->DatProdutos($row_Regis['proID'],$row_Regis['proNombre'],$row_Regis['proPrecio']);

        
     }
  
     $pdf->Output();

  if(isset($resultado)){
    mysqli_free_result($resultado);
 }
    
?>