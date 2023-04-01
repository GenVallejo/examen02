<!DOCTYPE html>
<html>
<head>
<title>Generando PDF con BD_NorthWind</title>
<link rel="stylesheet" href="BD_NorthWind.css">
<style type="text/css">
</style>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <img src="descarga.png" class="img1">
        
            <h3 >Práctica Examen_02 (Web02) Estudiante:Génesis Vallejo</h3>
            <h3>PARTE NORTHWIND</h3>
                
        </header>
        <br>
        
        <div class="container ">
            <div class="left-container texto1">
          
                <h1 style="color:blueviolet ;">Reportes de PDF (usando la BD de Northwind):</h1>
                <form action="FactExam.php" method="POST">
                <br>
                    <div class="input-group">
                        <input type="text" name="id" class="form-control" aling="Center" placeholder="ID" required >
                    </div>
                    <br>
                    <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Factura por usuario</button><br>
                            
                    </span>
                    
                </form>
            </div> 
           
        </div>
    </div>
    

    <img src="flor.jpg" class="img2" alt="">

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </footer>

	<!--Bootstrap JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
