<?php

namespace Models;

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../Models/Bucket.php';
require_once __DIR__ . '/../Models/Plantilla.php';
require_once __DIR__ . '/../Models/DB.php';

//use Models\Bucket;
use Models\Plantilla;
use Models\DB;

class FirmaCertificado extends DB
{
    public string $hash_certificado;

    public array $document_data;
    public array $creator_data;

    public array $firmantes_data;
    public int $firmantes_amount;

    private string $plantilla;

    public function __construct()
    {
    }

    // Funcion para obtener la información de un documento mediante su id
    public function documentData($id): bool {
        try {
            $sql = "SELECT * FROM documento WHERE doc_id = :id";
            $query = $this->connect()->prepare($sql);
            $query->execute([':id' => $id]);
            
            if ($query->rowCount() > 0) {
                // Informacion en db
                $datos = $query->fetchAll(\PDO::FETCH_ASSOC)[0];

                // CANTIDAD DE PAGINAS DEL DOCUMENTO PDF

                // Se consigue la ruta del documento firmando con su nombre
                $document_creator_id = $datos["doc_usuari"];
                $document_name = $datos["doc_nombre"];
                $document_path = __DIR__ . "/../bodega/precarga/". $document_creator_id . "/" . $document_name;

                // Se carga el archivo PDF en objeto mpdf con su ruta y se obtienen la cantidad de páginas del documento
                $mpdf = new \Mpdf\Mpdf([]);
                $pageCount = $mpdf->setSourceFile($document_path);

                $datos["doc_pages"] = $pageCount;
                $datos["hash_certificado"] = $this->hash_certificado;

                $this->document_data = $datos;
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, __DIR__ . '/../php-error.log');
            die('Error al buscar los datos del documento');
        }
    }
    
    // Funcion para obtener la información del usuario creador de un documento mediante su id
    public function creatorDocumentData($id): bool {
        try {
            $sql = "SELECT * FROM usuario WHERE usu_id = :id";
            $query = $this->connect()->prepare($sql);
            $query->execute([':id' => $id]);
            
            if ($query->rowCount() > 0) {
                $datos = $query->fetchAll(\PDO::FETCH_ASSOC)[0];
                $this->creator_data = $datos;

                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, __DIR__ . '/../php-error.log');
            die('Error al buscar los datos del creador del documento');
        }
    }

    // Funcion para obtener la cantidad e información de los firmantes de un documento mediante su id
    public function firmantes($id): bool {
        include '../conexion.php';

        //Datos firmantes con firma
        $datos_firmantes = array();
        $sql_firma = "SELECT usu_docume, usu_tipo_documento, usu_nombre, usu_apelli, det_nomdes, det_cordes, det_rutafi FROM detalledocumento LEFT JOIN usuario ON detalledocumento.det_cordes = usuario.usu_email WHERE det_docume = $id and det_firma = 1";
        
        $firmantes = mysqli_query($link, $sql_firma);

        //El array viene bastante deformado en la consulta, por lo tanto lo organizamos a nuestra necesidad
        while ($consulta = mysqli_fetch_array($firmantes)) {
            $datos_firmante['usu_docume'] = $consulta['usu_docume'];
            $datos_firmante['usu_tipo_documento'] = $consulta['usu_tipo_documento'];
            $datos_firmante['usu_nombre'] = $consulta['usu_nombre'];
            $datos_firmante['usu_apelli'] = $consulta['usu_apelli'];
            $datos_firmante['det_nomdes'] = $consulta['det_nomdes'];
            $datos_firmante['det_cordes'] = $consulta['det_cordes'];
            $datos_firmante['det_rutafi'] = $consulta['det_rutafi'];
            array_push($datos_firmantes, $datos_firmante);
        }

        $this->firmantes_data = $datos_firmantes;
        $this->firmantes_amount = count($datos_firmantes);

        return true;
    }

    public function getLayout() :bool
    {   
        $this->plantilla = Plantilla::getSignCertificateTemplate($this->document_data, $this->creator_data, $this->firmantes_data, $this->firmantes_amount);
        return true;
    }

    public function generate(int $mode): bool|string
    {
        try {
            $document_creator_id = $this->document_data["doc_usuari"];

            $mpdf = new \Mpdf\Mpdf(['margin_top' => 45]);

            $logo_path = realpath(__DIR__ . '/../recursos/logito.png');

            $mpdf->SetHTMLHeader('
            <table width="100%" class="header">
                <tr>
                    <td width="33%">
                        <img style="margin-right: 6px;" width="300px" height="68px" src="' . $logo_path . '"></img>
                    </td>

                    <td width="1px" style="border-left: 2px solid black;" align="left"></td>

                    <td width="33%" align="left" style="font-size: 18px;">
                        <b>Certificado de firma</b>
                    </td>
                    <td width="33%" style="text-align: right;">Página {PAGENO} de {nb}</td>
                </tr>
            </table>
            
            <div id="certificadoFirma-id"><b>Certificado ID:</b> '. $this->hash_certificado .'</div>', true);

            $mpdf->AddPage();
            $stylesheet = file_get_contents(__DIR__ . '/../recursos/certificado_documento/style.css');
        
            //$stylesheet = str_replace('./img/marco0.png', $realpath, $stylesheet);
                
            $mpdf->showImageErrors = true;
            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($this->plantilla, \Mpdf\HTMLParserMode::HTML_BODY);

            $mpdf->SetProtection(array('print', 'copy'), null, $this->hash_certificado);
            $mpdf->SetAuthor('FirmaDoc');
            $mpdf->SetTitle('Certificado de firma');
            $mpdf->SetKeywords($this->hash_certificado);

            if ($mode == 1) {
                $mpdf->Output("Firmacertificado-" . $this->document_data['doc_id'] . ".pdf", 'D');
                return true;
            } else if ($mode == 2) {
                $mpdf->Output(__DIR__ . "/../bodega/precarga/" . $document_creator_id . "/Firmacertificado-" . $this->document_data['doc_id'] . ".pdf", 'F');
                return true;
            } else {
                $doc = $mpdf->Output("", 'S');
                return base64_encode($doc);
            }
        } catch (\Mpdf\MpdfException $e) {
            error_log($e, 0, '../php-error.log');
            die('No se ha podido generar el certificado de la firma');
        }
    }

    public function setDocument(string $id, string $hash, int $mode = 1):bool|string
    {   
        $this->hash_certificado = $hash;

        if ($this->documentData($id) == 0 ) {
            return false;
            die('no hay datos');
        }

        // Se obtiene la cantidad e información de los firmantes de un documento mediante su id
        $this->firmantes($id);

        // Se obtiene la información del usuario creador de un documento mediante su id
        $creator_id = $this->document_data["doc_usuari"];
        $this->creatorDocumentData($creator_id);

        //$this->getImageEnroll();
        
        if ($this->getLayout() == 0) {
            return false;
            die('no hay imagenes');
        }
        return $this->generate($mode);
    }
}
