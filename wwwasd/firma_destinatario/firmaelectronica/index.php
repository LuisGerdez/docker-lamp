<?php
require_once "../config/APP.php";
function getPlantilla2($hash, $fecha, $firmantes)
{
  $firmaE = '
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <body>
          <section>
    
        <div class="container_header">
          <h3>REPUBLICA DE COLOMBIA</h3>
          <h3>CERTIFICADO DE FIRMA ELECTRONICA</h3>
        </div>
    
        <h4>
          Las partes que firman de manera electrónica este documento, declaran que
          lo han leído a plenitud, que reconocen su contenido y están de acuerdo con
          el mismo. A su vez, esta firma reemplaza la firma mecánica estampada en
          cada uno de los espacios donde tuviese lugar.
        </h4>
    
        <h5>
          Este documento fue generado con firma electrónica y cuenta
          con plena validez jurídica, conforme a lo dispuesto en la Ley 527/99 y el
          decreto reglamentario 2364/12.
        </h5>
    
        <div class="container">
          <table class="default">
            <tr>
              <td><strong>Codigo de verificacion</strong></td>
              <td>' . $hash . '</td>
            </tr>
            <tr>
              <td><strong>Fecha generacion</strong></td>
              <td>' . $fecha . '</td>
            </tr>
            <tr>
              <td><strong>Valide el documento en el siguiente enlace:</strong></td>
              <td>' . SERVERURL . 'validardocumento</td>
            </tr>
          </table>
		  </div>
      <table style="border:none;padding-top:50px;">';
  foreach ($firmantes as $firma) {
    $firmaE .= '
    <tr>
				  <td style="border:none;padding-top:50px;">
          <div class="container_firma">
				      <div class="firma_individuos">
					      <p>Firmante(s)</p>
					      <div class="firma_grafo">';
                $firmaE .=  empty($firma["det_rutafi"]) ? '<p style="font-family: silent;  font-size: 160%; margin: 0px;">' . $firma["det_nomdes"] . '</p>' : '<div class="firma_grafo"><img src=".'.$firma["url_firma"].'" alt="" style="width:150px;height:100px;" srcset="" class="img_grafo"></div>';
						    $firmaE .=   '<p style="margin: 0px; font-family: Arial;">' . $firma["usu_nombre"] . ' ' . $firma["usu_apelli"] . '</p>
						      <p style="margin: 0px; font-family: Arial;">CC: '. $firma["usu_docume"] . '</p>
						    </div>  
				      </div>
            </td>';
    $firmaE .= !empty($firma['url_foto']) ? '<td style="border:none;padding-top:50px;"><img  src="' . $firma['url_foto'] . '" alt="img" style="width: 80px;height:100px;margin-left: 50px;">
				  </td>' : '';
    $firmaE .= !empty($firma['url_foto_doc']) ? '<td style="border:none;padding-top:100px;padding-left:50px;"><img id="CC" src="' . $firma['url_foto_doc'] . '" alt="img" style="width: 100px;height:200px;margin-left: 50px;transform: rotate(-90deg);">
				  </td>' : '';
    $firmaE .= '</tr>';
  }
  $firmaE .= '</table>
        </section>
        <h2><strong>Valida el documento en el siguiente enlace.</strong></h2>
        <h2>http://localhost/firmadoc-corp/validardocumento</h2>
		  </body>
	  </html>
	  ';
  return $firmaE;
}

function getTemplate(string $hash, string $fecha ,array $firmantes): string
{
  $firmaE = '
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <body>
      <h4>
        Las partes que firman de manera electrónica este documento, declaran que
        lo han leído a plenitud, que reconocen su contenido y están de acuerdo con
        el mismo. A su vez, esta firma reemplaza la firma mecánica estampada en
        cada uno de los espacios donde tuviese lugar.
      </h4>
  
     <table class="table_info">
        <tr>
          <td>
            <strong>Codigo Verificacion</strong><br>
            <p class="p_info">'.$hash.'</p>
          </td>
          <td>
            <strong>Fecha Generacion</strong>
            <br>
            <p class="p_info">'.$fecha.'</p>
          </td>
        </tr>
      </table>
      <h1>Firmante(s)</h1>
      <h5>Valida el documento en el siguiente enlace.</h5>
      <h6><a href="'.SERVERURL.'validardocumento" name="verificacion">Validar Documento</a></h6>
    <table class="signatory_table">';

  foreach ($firmantes as $firma) {
    $firmaE .= '<tr>';
    foreach ($firma as $signer) {
      $firmaE .= '
        <td class="image_td">
          <table class="table_td">';
      $firmaE .= !empty($signer['url_foto_doc']) ?
        '<tr>
            <td colspan="2">
              <img class="cc" src="' . $signer['url_foto_doc'] . '" alt="img">
            </td>         
          </tr>' : '';
      $firmaE .= '<tr>';
      $firmaE .= !empty($signer['url_foto']) ?
        '<td>
                <img class="profile" src="' . $signer['url_foto'] . '" alt="img">
              </td>' : '';
      $firmaE .= '
              <td>
                <div>
                  <p class="p_td">' . $signer["usu_nombre"] . ' ' . $signer["usu_apelli"] . '</p>
                  <p class="p_td">CC: ' . $signer["usu_docume"] . '</p>
                </div>';

      $firmaE .= !empty($signer['det_rutafi']) ? '<img class="grafo" src="..' . $signer['det_rutafi'] . '" alt="img">' : '<p id="firma" style="font-family: silent;  font-size: 160%; margin: 0px;">'. $signer['det_nomdes'].'</p>';
      $firmaE .= '</td>       
            </tr>
          </table>
        </td>';
    }
    $firmaE .= '</tr>';
  }
  $firmaE .= '
        </table>
      </body>';
  return $firmaE;
}