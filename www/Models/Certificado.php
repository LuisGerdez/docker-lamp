<?php
namespace Models;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Models/Bucket.php';
require_once __DIR__ . '/../Models/Plantilla.php';
require_once __DIR__ . '/../Models/DB.php';
use Models\Bucket;
use Models\Plantilla;
use Models\DB;
class Certificado extends DB
{
    public array $datos;
    public array $images;
    private string $plantilla;
    private int $cedula;
    public function __construct()
    {
    }
    public function recordsEnroll($id): bool
    {
        try {
            $sql = "SELECT Record, Uid, StartingDate, MIN(CreationDate), CreationIP, IdNumber, IssueDate, FirstName, SecondName, FirstSurname, SecondSurname, Gender, BirthDate, PlaceBirth, TransactionTypeName, Response_ANI, TransactionId FROM ado_records WHERE IdNumber = (SELECT usu_docume FROM usuario WHERE usu_id = :id ) and TransactionType = '1'  ORDER BY ado_records.CreationDate DESC LIMIT 1";
            $query = $this->connect()->prepare($sql);
            $query->execute([':id' => $id]);
            if ($query->rowCount() > 0) {
                $datos = $query->fetchAll(\PDO::FETCH_ASSOC)[0];
                $this->datos = $datos;
                $this->cedula = $datos['IdNumber'];
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            error_log($e, 0, __DIR__ . '/../php-error.log');
            die('Error al buscar los datos del usuario');
        }
    }
    public function getImageEnroll(): void
    {
        $S3 = new Bucket();
        $images = [];
        $id_transaction = $this->datos['TransactionId'];
        $images[0] = ($S3->s3DownloadObjectB64("clientFace.png", CLIENT."/images/$this->cedula/$id_transaction/")) ? 'data:image/png;charset=utf-8;base64,' . $S3->s3DownloadObjectB64("clientFace.png", CLIENT."/images/$this->cedula/$id_transaction/") : null;
        $images[1] = ($S3->s3DownloadObjectB64("frontDocument.png", CLIENT."/images/$this->cedula/$id_transaction/")) ?'data:image/png;charset=utf-8;base64,' . $S3->s3DownloadObjectB64("frontDocument.png", CLIENT."/images/$this->cedula/$id_transaction/") : null;
        $this->images = $images;
    }
    public function getLayout() :void
    {
        $this->plantilla = Plantilla::getEnrollCertificateTemplate($this->datos, $this->images[0], $this->images[1]);
        // if (!empty($this->images[0]) &&  !empty($this->images[1])) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function generate(int $mode): bool|string
    {
        try {
            $mpdf = new \Mpdf\Mpdf([
                'margin_right'=>5,
                'margin_left'=>5,
                'margin_top'=>15,
                'margin_bottom'=>20
            ]);
            $mpdf->AddPage();
            $stylesheet = file_get_contents(__DIR__ . '/../perfil/certificado_enroll/style.css');
            $realpath = realpath(__DIR__ . '/../perfil/img/marco0.png');
            $stylesheet = str_replace('./img/marco0.png', $realpath, $stylesheet);
            // var_dump($stylesheet);
            // die;
            $mpdf->showImageErrors = true;
            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($this->plantilla, \Mpdf\HTMLParserMode::HTML_BODY);
            if ($mode == 1) {
                $mpdf->Output("certificadoEnroll-$this->cedula.pdf", 'D');
                return true;
            } else if ($mode == 2) {
                $mpdf->Output(__DIR__ . "/../perfil/certificado/certificadoEnroll-$this->cedula.pdf", 'F');
                return true;
            } else {
                $doc = $mpdf->Output("", 'S');
                return base64_encode($doc);
            }
        } catch (\Mpdf\MpdfException $e) {
            error_log($e, 0, '../php-error.log');
            die('No se ha podido generar el Certificado');
        }
    }
    public function setClient(string $id, int $mode = 1):bool|string
    {
        // var_dump($this->recordsEnroll($id));
        // die;
        if ($this->recordsEnroll($id) == false ) {
            die('no hay datos');
            return false;
        }
        $this->getImageEnroll();
        $this->getLayout();
        // if ($this->getLayout() == 0) {
        //     die('no hay imagenes');
        //     return false;
        // }
        return $this->generate($mode);
    }
}