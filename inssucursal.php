<?php
require_once("php/conexion.php");
$conexion = conectarOracle();



session_start();

if(!isset($_SESSION['rol'])){
    header('location: login.php');
}else{
    if($_SESSION['rol'] != 1){
        header('location: login.php');
    }
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>INSERCION DE SUCURSALES</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">

    
    <!--mis css-->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="datatables/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="datatables/main.css">  
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
    <!--font awesome con CDN-->  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  
     
      
   

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->


    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div class="header-top_area d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-4">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-12 d-block d-lg-none">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a  href="admin.php">Regresar</a></li>
                                            
                                           
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Insercion de nuevas sucursales</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!--/ bradcam_area  -->
		<section id="tabla">
			<div class="container">
			<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">        
							<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th> ID </th>
										<th> CAPACIDAD </th>
										<th> CALLE </th>
                                        <th> CIUDAD (S) </th>
										<th> ESTADO </th>
										<th> CODIGO POSTAL </th>
										<th> USUARIO ENCARGADO </th>

									</tr>
								</thead>
								<tbody>
								<?php 

                                        $sql = "SELECT a.ID_almacen, a.capacidad, a.calle, a.ciudad, a.estado, a.cp, a.ID_usuario, u.nombre, u.ap, u.am
                                        FROM almacen a
                                        INNER JOIN usuarios u ON a.ID_usuario = u.ID_usuario";

                                        
                                        $stmt = oci_parse($conexion, $sql);
                                        oci_execute($stmt);

                                        while($mostrar = oci_fetch_array($stmt)){
                                        ?>
                                            <tr>
                                                <td><?php echo $mostrar['ID_ALMACEN'] ?></td>
                                                <td><?php echo $mostrar['CAPACIDAD'] ?></td>
                                                <td><?php echo $mostrar['CALLE'] ?></td>
                                                <td><?php echo $mostrar['CIUDAD'] ?></td>
                                                <td><?php echo $mostrar['ESTADO'] ?></td>
                                                <td><?php echo $mostrar['CP'] ?></td>
                                                <td><?php echo $mostrar['NOMBRE'] . ' ' . $mostrar['AP'] . ' ' . $mostrar['AM']; ?></td>

                                            </tr>
                                        <?php 
                                        }
                                        oci_free_statement($stmt);
                                        oci_close($conexion); // Cerrar la conexión a la base de datos
                                        ?>
								</tr>
								</tbody> 
						   </table>  
                                               
						</div>
					</div>
			</div>  
		</div>
		</section>    
        <br>
        <br>
                                    
        <section id="insert"> 
        <div class="bradcam_text text-center">
            <h3>Insercion de una nueva sucursal</h3>
         </div>
         <style>
                .container1 {
                    display: flex;
                    justify-content: center;
                }

                .column {
                    margin: 0 10px;
                }
                .custom-button {
                    background-color: #ff6600;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                }

                .custom-button:hover {
                    background-color: #e65c00;
                }
                .custom-button-container {
                    text-align: center;
                }
            </style>

        <div class="container1">
                <div class="column">
            <form action="php/inssucursal.php" method="POST">
                        <label for="capacidad">Capacidad:</label>
                        <br>
                        <input type="text" name="capacidad" id="capacidad">
                        <br><br>
                        <label for="estado">Estado:</label>
                        <br>
                        <input type="text" name="estado" id="estado">
                    </div>
                
                
                <div class="column">
                    <label for="calle">Calle:</label>
                    <br>
                    <input type="text" name="calle" id="calle">
                    <br><br>
                    <label for="cp">Codigo Postal:</label>
                    <br>
                    <input type="text" name="cp" id="cp">
                    <br><br>
                   
                    
                    
                </div>
                
                <div class="column">
                <label for="ciudad">Ciudad:</label>
                    <br>
                    <input type="text" name="ciudad" id="ciudad">
                    <br><br>
                    <label for="id_usuario">ID del encargado:</label>
                    <br>
                    <?php
                                        // Conexión a la base de datos
                                        require_once("php/conexion.php");
                                        $conexion = conectarOracle();

                                        if (!$conexion) {
                                            $e = oci_error();
                                            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
                                        }

                                        // Consulta de destinatarios
                                        $sql = "SELECT ID_usuario, nombre, ap, am FROM usuarios";
                                        $stmt = oci_parse($conexion, $sql);
                                        oci_execute($stmt);

                                        // Generar el combo box
                                        echo '<select name="encargado">';
                                        echo '<option value="" disabled selected>Encargado</option>'; // Opción deshabilitada

                                        while ($row = oci_fetch_assoc($stmt)) {
                                            $idusuario = $row['ID_USUARIO'];
                                            $nombre = $row['NOMBRE'];
                                            $ap = $row['AP'];
                                            $am = $row['AM'];
                                        

                                            echo '<option value="' . $idusuario . '">' . $idusuario . ' ' .  '' . $nombre . ' ' .  '' . $ap . ' ' .  '' . $am . ' ' .  '</option>';
                                        }

                                        echo '</select>';

                                        // Cerrar la conexión
                                        oci_free_statement($stmt);
                                        oci_close($conexion);
                                    ?>
                    <br><br>
                    
                </div>
        </div>
                <br>
                <br>
            <div class="custom-button-container">
                 <input type="submit" name="insertar" value="Insertar" class="custom-button">
            </div>

        </form>

					
        </section> 
   


        <br>
        <br>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados para el equipo de ingenieros</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="serch_form">
            <input type="text" placeholder="search" >
            <button type="submit">search</button>
        </div>
      </div>
    </div>
  </div>
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/slick.min.js"></script>

    <!-- scripts tablas-->
      <!-- jQuery, Popper.js, Bootstrap JS -->
      <script src="datatables/jquery/jquery-3.3.1.min.js"></script>
    <script src="datatables/popper/popper.min.js"></script>
    <script src="datatables/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="datatables/main.js"></script>  
 

</body>

</html>