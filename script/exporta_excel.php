<?php
session_start();
require_once '../js/Classes/PHPExcel.php';
$conn=mysql_connect('db543248245.db.1and1.com:3306', 'dbo543248245', 'M4SS1V4STUD10') or die('No se pudo conectar: ' . mysql_error());
		mysql_select_db('db543248245',$conn) or die('No se pudo seleccionar la base de datos');
$idevento = $_SESSION['evento'];
if($idevento!=''){
$r=mysql_query("select * from evento where id='$idevento'",$conn);
while($f=mysql_fetch_array($r))
			{
					$no=$f['nombre'];
					$inv=$f['invitados'];
			}
$res1=mysql_query("select * from asistente where id_evento='$idevento'",$conn);
$objPHPExcel = new PHPExcel();
$objPHPExcel-> //Propiedades del archivo de excel
    	getProperties()
        ->setCreator("Coomeb")
        ->setLastModifiedBy("Coomeb")
        ->setTitle("Participantes")
        ->setSubject("Información")
        ->setDescription("Información de los participantes del evento")
        ->setCategory("Reportes");
		$estiloTituloReporte = array(
	    'font' => array(
	        'name'      => 'Verdana',
	        'bold'      => true,
	        'italic'    => false,
	        'strike'    => false,
	        'size' =>16,
	        'color'     => array(
	            'rgb' => 'FFFFFF'
	        )
	    ),
	    'fill' => array(
	        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
	        'color' => array(
	            'rgb' => '94BF42')
	    ),
	    'borders' => array(
	        'allborders' => array(
	            'style' => PHPExcel_Style_Border::BORDER_NONE
	        )
	    ),
	    'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0,
	        'wrap' => FALSE
	    )
		);
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray( array(
		    'font' => array(
		        'name'  => 'Arial',
		        'color' => array(
		            'rgb' => '000000'
		        )
		    ),
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN ,
		        'color' => array(
		                'rgb' => '000000'
		            )
		        )
		    ),
			'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        'rotation' => 0,
	        'wrap' => TRUE
   			)
		));
				$i='2';
				$j='2';
				$objPHPExcel->setActiveSheetIndex(0)
							 ->setCellValue('A1', 'Cédula')
					         ->setCellValue('B1', 'Nombre')
							 ->setCellValue('C1', 'Correo')
					         ->setCellValue('D1', 'Teléfono')
					         ->setCellValue('E1', 'Invitados');
					
					while($filas=mysql_fetch_array($res1)){
					$id=$filas['id_usuario'];
					$asis=$filas['id_asistente'];
					$res2=mysql_query("select * from clientes where codigo=$id",$conn);
					while($filas2=mysql_fetch_array($res2)){
					$res3=mysql_query("select * from invitado where id_asistente=$asis",$conn);
					$objPHPExcel->setActiveSheetIndex(0)
								 ->setCellValue('A'.$i, $id)
					             ->setCellValue('B'.$i, $filas2['nombre'])
					             ->setCellValue('C'.$i, $filas2['correo'])
					             ->setCellValue('D'.$i, $filas2['telefono']);
								 $k='0';
								 while($filas3=mysql_fetch_array($res3)){
								 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$j, "Nombre: ".$filas3['nombre']."  -> Edad: ".$filas3['edad']."  -> Documento: ".$filas3['documento']);
									 $j++;
									 $k++;
								 }
								 if($k=='0'){
									 $f=$j;
									}else{$f=$j-1;} 
								 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$i.':A'.$f);
								 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$i.':B'.$f);
								 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$i.':C'.$f);
								 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D'.$i.':D'.$f);
								 if($k=='0'){
									 $i++;
									 $j++;
									}else{$i=$i+$k;} 
					}

					}//2
			for($i = 'A'; $i <= 'E'; $i++){
			    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
			}
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);				
			$objPHPExcel->setActiveSheetIndex(0)->setTitle('Participantes');

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=Participantes evento: $no.xls");
header('Cache-Control: max-age=0');
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
}

?>