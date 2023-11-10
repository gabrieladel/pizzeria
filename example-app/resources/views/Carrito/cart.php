<?php 
session_start();


if(isset($_SESSION['carrito']) || isset($_POST['id'])){
	if(isset($_SESSION['carrito'])){
		$carrito_mio=$_SESSION['carrito'];
		if(isset($_POST['id'])){
			$id=$_POST['id'];
			$precio=$_POST['precio'];
			$cantidad=$_POST['cantidad'];
			$ref=$_POST['ref'];
			$donde=-1;
			for($i=0;$i<=count($carrito_mio)-1;$i ++){
			   if($ref==$carrito_mio[$i]['ref']){
			    
			   }
			}
			if($donde != -1){
				$cuanto=$carrito_mio[$donde]['cantidad'] + $cantidad;
				$carrito_mio[$donde]=array("id"=>$id,"precio"=>$precio,"cantidad"=>$cuanto,"ref"=>$ref);
			}else{
				$carrito_mio[]=array("id"=>$id,"precio"=>$precio,"cantidad"=>$cantidad,"ref"=>$ref);
			}
		}
	}else{
		$id=$_POST['id'];
		$precio=$_POST['precio'];
		$cantidad=$_POST['cantidad'];
		$ref=$_POST['ref'];
		$carrito_mio[]=array("id"=>$id,"precio"=>$precio,"cantidad"=>$cantidad,"ref"=>$ref);	
	}
	if(isset($_POST['cantidad'])){
		$id=$_POST['id'];
		$cuantos=$_POST['cantidad'];
		if($cuantos<1){
			$carrito_mio[$id]=NULL;
		}else{
			$carrito_mio[$id]['cantidad']=$cuantos;


		}
	}
	if(isset($_POST[''])){
		$id=$_POST[''];
		$carrito_mio[$id]=NULL;
	}
	


$_SESSION['carrito']=$carrito_mio;
}





if(isset($_SESSION['carrito'])){

for($i=0;$i<=count($carrito_mio)-1;$i ++){
if($carrito_mio[$i]!=NULL){ 
$totalc = $carrito_mio['cantidad'];
$totalc ++ ;
$totalcantidad += $totalc;
}}}





header("Location: ".$_SERVER['HTTP_REFERER']."");
?>



