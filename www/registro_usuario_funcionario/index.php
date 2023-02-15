<?php
require_once "../config/APP.php";
//Load Composer's autoloader
require '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo COMPANY ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo FAVICON ?>">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/registro.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="css/estilo_registro.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script src="js/sweetalert2.js"></script>
  <style>
    .content-scroll {
      max-height: 450px;
      overflow-y: scroll;
    }

    .iti {
      width: 100%;
      color: #000;
      font-weight: bold;
    }

    .iti__country-list {
      width: 420px;
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <div class="container_">
    <div class="imgcontainer">
      <img src="<?php echo LOGOWHITE ?>" alt="alt" width="320" height="55" />
    </div>

    <form action="" method="post" enctype="multipart/form-data">
      <label for="unombre"><b>Nombre</b></label>
      <input type="text" placeholder="Ingrese su nombre" name="unombre" id="unombre" value="<?php if (isset($_POST['unombre'])) {
                                                                                              echo $_POST['unombre'];
                                                                                            } ?>">
      <label for="uapellido"><b>Apellidos</b></label>
      <input type="text" placeholder="Ingrese sus apellidos" name="uapellido" id="uapellido" value="<?php if (isset($_POST['uapellido'])) {
                                                                                                      echo $_POST['uapellido'];
                                                                                                    } ?>">
      <label for="uname"><b>Tipo de identificaci&oacute;n</b></label>
      <div class="custom-select">
        <select name="utidentificacion" id="utidentificacion">
          <option value="0">Seleccione un tipo:</option>
          <option value="C&eacute;dula">C&eacute;dula</option>
          <option value="N.i.t.">NIT</option>
          <option value="Pasaporte">Pasaporte</option>
        </select>
      </div>

      <label for="uidentificacion"><b>N&uacute;mero de identificaci&oacute;n</b></label>
      <input type="text" placeholder="Ingrese su n&uacute;mero de identificaci&oacute;n" name="uidentificacion" id="uidentificacion" value="<?php if (isset($_POST['uidentificacion'])) {
                                                                                                                                              echo $_POST['uidentificacion'];
                                                                                                                                            } ?>">

      <label for="utelefono"><b>N&uacute;mero fijo o m&oacute;vil</b></label>
      <div class="tel-container">
        <input type="text" name="utelefono" id="utelefono" value="<?php if (isset($_POST['utelefono'])) {
                                                                                                                              echo $_POST['utelefono'];
                                                                                                                            } ?>">
      </div>
      <label for="ucorreo"><b>Correo electr&oacute;nico</b></label>
      <input type="text" placeholder="Ingrese su correo electr&oacute;nico" name="ucorreo" id="ucorreo" value="<?php if (isset($_POST['ucorreo'])) {
                                                                                                                  echo $_POST['ucorreo'];
                                                                                                                } ?>">

      <label for="password"><b>Digite contraseña</b></label>
      <input type="password" placeholder="Ingrese su contraseña" name="password" id="password">

      <label for="cpassword"><b>Confirmar contraseña</b></label>
      <input type="password" placeholder="Ingrese nuevamente su contraseña" name="cpassword" id="cpassword">

      <p>
        <p>Acepto los</p>
        <input type="checkbox" name="my-checkbox"><a id="myBtn" href="#">TERMINOS Y CONDICIONES</a>
        <br>
        <input type="checkbox" name="my-checkbox2"><a id="myBtn2" href="#">ACUERDO DE COMUNICACIONES</a>
        <br>
        <input type="checkbox" name="my-checkbox3"><a id="myBtn3" href="#">POLÍTICA DE PRIVACIDAD DE DATOS DE FIRMADOC</a>
      </p>
      <p><a href="<?= LINK_BIOMETRICO_DESTINATARIO?>">Ya tengo una cuenta.</a></p>

      <button type="submit" name="registrar">Registrar</button>
    </form>
  </div>

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" id="modal-content1">
      <div class="modal-header">
        <span class="close">&times;</span>
        <div class="imgcontainer">
          <img src="<?php echo LOGOWHITE ?>" alt="alt" width="320" height="45" />
        </div>
      </div>
      <div class="modal-body">
        <div class="content-scroll">
          <p>
          <h2>T&Eacute;RMINOS Y CONDICIONES.</h2>
          </p>
          <p>AVISO IMPORTANTE: ESTOS T&Eacute;RMINOS Y CONDICIONES CONTIENEN UNA DISPOSICI&Oacute;N DE ARBITRAJE VINCULANTE Y UNA RENUNCIA A JUICIOS POR JURADO Y DEMANDAS COLECTIVAS QUE RIGEN LAS DISPUTAS QUE SURJAN DEL USO DE LOS SERVICIOS DE <?= COMPANY ?>. AFECTA SUS DERECHOS LEGALES SEG&Uacute;N SE DETALLA EN LA SECCI&Oacute;N DE ARBITRAJE OBLIGATORIO Y RENUNCIA A LA DEMANDA COLECTIVA A CONTINUACI&Oacute;N. POR FAVOR LEA DETENIDAMENTE.</p>
          <p>Estos T&eacute;rminos y condiciones de los servicios de <?= COMPANY ?> ("T&eacute;rminos") rigen el acceso y el uso de los sitios web y servicios de <?= COMPANY ?> ("<?= COMPANY ?>", "nosotros" o "nos") (en conjunto, el "Sitio") por parte de los visitantes del sitio ("Visitantes del sitio") Y por personas o entidades que compran servicios ("Servicios de <?= COMPANY ?>") o crean una cuenta ("Cuenta") y sus Usuarios autorizados (colectivamente, "Clientes" ). Al utilizar el Sitio o cualquier Servicio de <?= COMPANY ?>, usted, como Visitante del Sitio o Cliente, acepta estos T&eacute;rminos (ya sea en su nombre o en una entidad legal que represente). Un "Usuario autorizado" de un Cliente es una persona física individual, ya sea un empleado, socio comercial, contratista o agente de un Cliente que est&aacute; registrado o autorizado por el Cliente para utilizar los Servicios de <?= COMPANY ?> sujeto a estos T&eacute;rminos y hasta un m&aacute;ximo. n&uacute;mero de usuarios o usos especificados en el momento de la compra.</p>
          <p>Si usted es un Cliente y usted o su organizaci&oacute;n est&aacute;n sujetos a un Acuerdo de servicios maestro con <?= COMPANY ?> ("T&eacute;rminos corporativos"), estos T&eacute;rminos se aplicar&aacute;n, en todo caso, solo al uso del Sitio o de cualquier Servicio de <?= COMPANY ?> en la medida en que tales el uso no se rige ya por dicho Acuerdo de servicios maestro. Para evitar dudas, todas las referencias al "Sitio" en estos T&eacute;rminos tambi&eacute;n incluyen los Servicios de <?= COMPANY ?>.</p>
          <p>AL ACCEDER, UTILIZAR O DESCARGAR CUALQUIER MATERIAL DEL SITIO, USTED ACEPTA SEGUIR Y ESTAR OBLIGADO POR ESTOS T&Eacute;RMINOS. SI NO EST&Aacute; DE ACUERDO CON ESTOS T&Eacute;RMINOS, NO EST&Aacute; AUTORIZADO Y DEBE DEJAR DE UTILIZAR EL SITIO INMEDIATAMENTE.</p>
          <p>AVISO IMPORTANTE: ESTOS T&Eacute;RMINOS Y CONDICIONES CONTIENEN UNA DISPOSICI&Oacute;N DE ARBITRAJE VINCULANTE Y UNA RENUNCIA A JUICIOS POR JURADO Y DEMANDAS COLECTIVAS QUE RIGEN LAS DISPUTAS QUE SURJAN DEL USO DE LOS SERVICIOS DE <?= COMPANY ?>. AFECTA SUS DERECHOS LEGALES SEG&uacute;N SE DETALLA EN LA SECCI&Oacute;N DE ARBITRAJE OBLIGATORIO Y RENUNCIA A LA DEMANDA COLECTIVA A CONTINUACI&Oacute;N. POR FAVOR LEA DETENIDAMENTE.</p>
          <p>Estos T&eacute;rminos y condiciones de los servicios de <?= COMPANY ?> ("T&eacute;rminos") rigen el acceso y el uso de los sitios web y servicios de <?= COMPANY ?> ("<?= COMPANY ?>", "nosotros" o "nos") (en conjunto, el "Sitio") por parte de los visitantes del sitio ("Visitantes del sitio") Y por personas o entidades que compran servicios ("Servicios de <?= COMPANY ?>") o crean una cuenta ("Cuenta") y sus Usuarios autorizados (colectivamente, "Clientes" ). Al utilizar el Sitio o cualquier Servicio de <?= COMPANY ?>, usted, como Visitante del Sitio o Cliente, acepta estos T&eacute;rminos (ya sea en su nombre o en una entidad legal que represente). Un "Usuario autorizado" de un Cliente es una persona física individual, ya sea un empleado, socio comercial, contratista o agente de un Cliente que est&aacute; registrado o autorizado por el Cliente para utilizar los Servicios de <?= COMPANY ?> sujeto a estos T&eacute;rminos y hasta un m&aacute;ximo. n&uacute;mero de usuarios o usos especificados en el momento de la compra.</p>
          <p>Si usted es un Cliente y usted o su organizaci&oacute;n est&aacute;n sujetos a un Acuerdo de servicios maestro con <?= COMPANY ?> ("T&eacute;rminos corporativos"), estos T&eacute;rminos se aplicar&aacute;n, en todo caso, solo al uso del Sitio o de cualquier Servicio de <?= COMPANY ?> en la medida en que tales el uso no se rige ya por dicho Acuerdo de servicios maestro. Para evitar dudas, todas las referencias al "Sitio" en estos T&eacute;rminos tambi&eacute;n incluyen los Servicios de <?= COMPANY ?>.</p>
          <p>AL ACCEDER, UTILIZAR O DESCARGAR CUALQUIER MATERIAL DEL SITIO, USTED ACEPTA SEGUIR Y ESTAR OBLIGADO POR ESTOS T&Eacute;RMINOS. SI NO EST&Aacute; DE ACUERDO CON ESTOS T&Eacute;RMINOS, NO EST&Aacute; AUTORIZADO Y DEBE DEJAR DE UTILIZAR EL SITIO INMEDIATAMENTE.</p>
        </div>
      </div>
    </div>
  </div>
  <div id="myModal2" class="modal2" style="display:none;">
    <!-- Modal content -->
    <div class="modal-content2" id="modal-content2">
      <div class="modal-header">
        <span class="close2">&times;</span>
        <div class="imgcontainer">
          <img src="<?php echo LOGOWHITE ?>" alt="alt" width="320" height="45" />
        </div>
      </div>
      <div class="modal-body">
        <div class="content-scroll">
          <p>
          <h1 style='text-align:center;'>ACUERDO DE COMUNICACIONES</h1>

          <p style='text-align:justify;'>
            <b>1.</b> Todas las partes integrantes y/o beneficiarias de este servicio manifiestan y aceptan que en lo sucesivo cualquier tipo de comunicación entre ellas se realice a través de medios electrónicos y no en papel.<br><br>
            <b>2.</b> Mediante la implementación de este acuerdo de Comunicaciones las partes manifiestan entender y aceptar la obligación de guardar bajo absoluta reserva y confidencialidad sus nombres, claves, códigos de acceso a las plataformas tecnológicas y demás. De esta manera firmadoc.co no recibirá autorizaciones que no hayan sido otorgadas por el titular. Las partes entienden que firmadoc.co no se hará responsable por le uso inadecuado que le den los usuarios y/o beneficiarios a sus nombres, claves y códigos de acceso ni de las consecuencia que ello pueda acarrear.<br><br>
            <b>3.</b> Firmadoc.co no se hace responsable por la no recepción de comunicación o comunicaciones a causa de cambios de direcciones de correo electrónico no actualizados en el sistema.<br><br>
            <b>4.</b> Para la legalización de los documentos LAS PARTES acuerdan que los documentos necesarios para ello serán firmados utilizando mecanismos de firma electrónica que cumplen los requisitos técnicos contemplados en la ley y que LAS PARTES reconocen como confiables y apropiados.<br><br>
            <b>5.</b> LAS PARTES aceptan que los documentos serán firmados mediante alguno de los métodos de firma electrónica de firmadoc.co<br><br>
            <b>6.</b> Las partes conocen que la firma electrónica permite realizar acuerdos sin que se requiera para ello la presentación personal, para que todas LAS PARTES puedan celebrar acuerdos de forma más rápida y efectiva.<br><br>
            <b>7.</b> Las partes conocen y aceptan que para realizar el firmado electrónico de este documento, o de cualquier otro se deberá hacer uso de las herramientas suinistradas y del estricto cumplimiento del procedimiento establecido y conocido por el cliente. Igualmente, éste será válido única y exclusivamente para el trámite que se está realizando y no podrá ser utilizado para trámites futuros ya que deberá iniciar un nuevo procedimiento. Esto garantiza a cada parte, que es la única persona que podrá conocer el código de validación.<br><br>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="myModal3" class="modal3" style="display:none;">
    <!-- Modal content -->
    <div class="modal-content3" id="modal-content3">
      <div class="modal-header">
        <span class="close3">&times;</span>
        <div class="imgcontainer">
          <img src="<?php echo LOGOWHITE ?>" alt="alt" width="320" height="45" />
        </div>
      </div>
      <div class="modal-body">
        <div class="content-scroll">
          <p>
          <h2>POLÍTICA DE PRIVACIDAD DE DATOS DE FIRMADOC NOVIEMBRE DE 2022.</h2>
          </p>La presente Política de Protección de Datos Personales (en adelante la “Política”) pretende regular la recolección, almacenamiento, uso, circulación y supresión de datos personales en FIRMADOC, brindando herramientas que garanticen la autenticidad, confidencialidad e integridad de la información.

          La Política se estructura siguiendo los mandatos trazados y aceptados internacionalmente sin perjuicio que se adapte frente a los cambios que sobre la materia se realicen.

          <h3>TABLA DE CONTENIDO</h3>

          1 ALCANCE 3 <br>
          3 DESARROLLO DE LA POLÍTICA 3 <br>
          4 ESTRATEGIAS 4 <br>
          4.1 Tratamiento 4 <br>
          4.2 Divulgación y Capacitación 4 <br>
          4.3 Organización interna y Gestión de riesgos 4 <br>
          5 DEFINICIONES 4 <br>
          6 PRINCIPIOS RECTORES 6 <br>
          7 CATEGORÍAS ESPECIALES DE DATOS 7 <br>
          8 CLASIFICACIÓN DE INFORMACIÓN Y DE BASES DE DATOS 8 <br>
          9 PRERROGATIVAS Y DERECHOS DE LOS TITULARES 9 <br>
          10 DEBERES DE SUNTIC S.A.S EN RELACIÓN CON EL TRATAMIENTO DE LOS DATOS PERSONALES 10 <br>
          11 POLÍTICAS DE TRATAMIENTO DE LA INFORMACIÓN 10 <br>
          11.1 Generalidades Sobre la Autorización 10 <br>
          11.2 Garantías del Derecho de Acceso 10 <br>
          11.3 Consultas 11 <br>
          11.4 Reclamos 11 <br>
          11.5 Rectificación y Actualización de Datos 12 <br>
          11.6 Supresión de Datos 13 <br>
          11.7 Revocatoria de la Autorización 13 <br>
          11.8 Contratos 14 <br>
          11.9 Transferencia de Datos Personales a Terceros Países 14 <br>
          12 REGLAS GENERALES APLICABLES 14 <br>
          13 FUNCIÓN DE PROTECCIÓN DE DATOS PERSONALES AL INTERIOR DE SUNTIC S.A.S 15 <br>
          13.1 Los Responsables 15 <br>
          13.2 Los Encargados 16 <br>
          13.3 Deberes de los Encargados 16 <br>
          13.4 El Despliegue Interno de la Política de Protección de Datos 16 <br>
          14 EL REGISTRO NACIONAL DE BASES DE DATOS 17 <br>
          15 VIGENCIA Y ACTUALIZACIÓN 18 <br>





          <h3>POLÍTICA DE PROTECCIÓN DE DATOS PERSONALES </h3>

          1 ALCANCE

          La Política de FIRMADOC cubre todos los aspectos administrativos, organizacionales y de control que deben ser cumplidos por los directivos, funcionarios, contratistas y terceros que laboren o tengan relación directa con la FIRMADOC. <br>




          2 DESARROLLO DE LA POLÍTICA

          FIRMADOC incorpora en todas sus actuaciones el respeto por la protección de datos personales. En consecuencia, solicitará desde el ingreso del dato, autorización para el uso de la información que reciba para las finalidades propias de su objeto misional.

          FIRMADOC respeta los principios establecidos en las leyes y atenderá en sus actuaciones y manejo de información de datos personales las finalidades que se deriven de la recolección de los mismos.

          FIRMADOC implementará las estrategias y acciones necesarias para dar efectividad a los derechos consagrados en las leyes, normas y demás que regulen la materia y toda aquella normativa que la complemente, modifique o derogue.

          FIRMADOC dará a conocer a todos sus usuarios los derechos que se derivan de la protección de datos personales. <br>



          3 ESTRATEGIAS <br>

          3.1 Tratamiento
          <br>
          Para el adecuado tratamiento y protección de los datos personales, FIRMADOC trabaja tres perspectivas básicas que tienen como fin desarrollar políticas particulares de tratamiento de datos de acuerdo; estas perspectivas son:
          <br>
          • Perspectiva Jurídica <br>
          • Perspectiva Tecnológica <br>
          • Perspectiva Organizacional <br>


          3.2 Divulgación y Capacitación <br>

          FIRMADOC definirá los procesos de divulgación y capacitación del contenido de esta Política a través de su Junta de Seguridad de la Información.
          <br>

          3.3 Organización interna y Gestión de riesgos <br>

          FIRMADOC definirá cualquier acción relativa a la protección de datos personales en su Junta de Seguridad de la Información. Al interior de dicha Junta se ha definido el rol de Oficial de Protección de Datos Personales, rol que estará dentro de las atribuciones funcionales del actual Oficial de Seguridad de la Información.

          <br>
          4 DEFINICIONES <br>
          Para los propósitos de este documento se aplican los siguientes términos y definiciones: <br>

          • Aviso de Privacidad: Comunicación verbal o escrita generada por el Responsable del tratamiento de datos personales, dirigida al Titular de dichos datos, mediante la cual se le informa acerca de la existencia de las políticas de tratamiento de datos que le serán aplicables, la forma de acceder a las mismas y las finalidades del tratamiento que se pretende dar a los datos personales.
          <br>

          • Autorización: Consentimiento previo, expreso e informado del titular de los datos personales para llevar a cabo el tratamiento de dichos datos.
          <br>
          • Bases de Datos: Conjunto organizado de datos personales que sea objeto de Tratamiento.
          <br>
          • Dato Personal: Cualquier información vinculada o que pueda asociarse a una o a varias personas naturales determinadas o determinables. Debe entonces entenderse el “dato personal” como una información relacionada con una persona natural (persona individualmente considerada).
          <br>
          • Dato Público: Es el dato que no sea semiprivado, privado o sensible. Son considerados datos públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio y a su calidad de comerciante o de servidor público. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales, y sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva.
          <br>
          • Dato Sensible: Corresponde a aquel dato que afecta la intimidad del Titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos.
          <br>
          • Encargado del tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el tratamiento de datos personales por cuenta del responsable del tratamiento.
          <br>
          • Responsable del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la base de datos y/o el Tratamiento de los datos.
          <br>
          • Titular: Persona natural cuyos datos personales sean objeto de tratamiento.
          <br>
          • Transferencia: La transferencia de datos tiene lugar cuando el responsable y/o encargado del tratamiento de datos personales, envía la información o los datos personales a un receptor, que a su vez es responsable del tratamiento y se encuentra dentro o fuera del país.
          <br>
          • Transmisión: Tratamiento de datos personales que implica la comunicación de los mismos dentro o fuera del País de origen cuando tenga por objeto la realización de un tratamiento por el encargado por cuenta del responsable.

          <br>
          • Tratamiento: Cualquier operación o conjunto de operaciones sobre datos personales, tales como la recolección, almacenamiento, uso, circulación o supresión.
          <br>
          • Oficial de Protección de Datos: Es el rol dentro de FIRMADOC, que tendrá como función la vigilancia y control de la Política bajo el control de la Junta de Seguridad.
          <br>

          5 PRINCIPIOS RECTORES
          <br>

          • Principio de Legalidad en materia de Tratamiento de datos: El tratamiento de datos es una actividad reglada que debe sujetarse a lo establecido en la ley y en las demás disposiciones que la desarrollen.
          <br>
          • Principio de Finalidad: El tratamiento debe obedecer a una finalidad legítima de acuerdo con la la ley, la cual debe ser informada al Titular.
          <br>
          • Principio de Libertad: El tratamiento sólo puede ejercerse con el consentimiento, previo, expreso e informado del Titular. Los datos personales no podrán ser obtenidos o divulgados sin previa autorización, o en ausencia de mandato legal o judicial que releve el consentimiento.
          <br>
          • Principio de Veracidad o Calidad: La información sujeta a tratamiento debe ser veraz, completa, exacta, actualizada, comprobable y comprensible. Se prohíbe el tratamiento de datos parciales, incompletos, fraccionados o que induzcan a error.
          <br>
          • Principio de Transparencia: En el tratamiento debe garantizarse el derecho del Titular a obtener del Responsable de dicho tratamiento o del Encargado, en cualquier momento y sin restricciones, información acerca de la existencia de datos que le conciernan.
          <br>
          • Principio de Acceso y Circulación Restringida: El tratamiento se sujeta a los límites que se derivan de la naturaleza de los datos personales y de las disposiciones constitucionales y legales. En este sentido, el tratamiento sólo podrá hacerse por personas autorizadas por el Titular y/o por las personas previstas en la Ley. Los datos personales, salvo la información pública, no podrán estar disponibles en Internet u otros medios de divulgación o comunicación masiva, salvo que el acceso sea técnicamente controlable para brindar un conocimiento restringido sólo a los Titulares o terceros autorizados conforme a la ley.
          <br>
          • Principio de Seguridad: La información sujeta a tratamiento por el Responsable del Tratamiento o Encargado del tratamiento a que se refiere la ley se deberá manejar con las medidas técnicas, humanas y administrativas que sean necesarias para otorgar seguridad a los registros, y evitar su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento.
          <br>
          • Principio de Confidencialidad: Todas las personas que intervengan en el tratamiento de datos personales que no tengan la naturaleza de públicos están obligadas a garantizar la reserva de la información, inclusive después de finalizada su relación con alguna de las labores que comprende el tratamiento, pudiendo sólo realizar suministro o comunicación de datos personales cuando ello corresponda al desarrollo de las actividades autorizadas en la Ley y en los términos de la misma.


          6 CATEGORÍAS ESPECIALES DE DATOS <br>
          <br>
          6.1 Datos Personales Sensibles
          <br>
          Los datos sensibles son aquellos datos que afectan la intimidad del titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos.
          FIRMADOC restringirá el tratamiento de datos personales sensibles a lo estrictamente indispensable y solicitará consentimiento previo y expreso sobre la finalidad de su tratamiento.
          <br>

          6.2 Tratamiento de Datos Personales Sensibles
          <br>
          Se podrá hacer uso y tratamiento de los datos catalogados como sensibles cuando:
          <br>
          • El Titular haya dado su autorización explícita a dicho tratamiento, salvo en los casos que, por ley no sea requerido el otorgamiento de dicha autorización.
          <br>
          • El tratamiento sea necesario para salvaguardar el interés vital del Titular y este se encuentre física o jurídicamente incapacitado. En estos eventos, los representantes legales deberán otorgar su autorización.
          <br>
          • El tratamiento se refiera a datos que sean necesarios para el reconocimiento, ejercicio o defensa de un derecho en un proceso judicial.
          <br>
          • El tratamiento tenga una finalidad histórica, estadística o científica, o dentro del marco de procesos de mejoramiento, siempre y cuando se adopten las medidas conducentes a la supresión de identidad de los titulares.

          <br>
          6.3 Datos Personales de Niños, Niñas y Adolescentes
          <br>
          Los menores de edad son Titulares de sus datos personales y por lo tanto portadores de los derechos correspondientes. Los derechos de los menores deben ser interpretados y aplicados de manera prevalente y por lo tanto, deben ser observados con especial cuidado. Por tal razón las opiniones de los menores deben ser tenidas en cuenta al momento de realizar algún tratamiento de sus datos.
          FIRMADOC se compromete entonces, en el tratamiento de los datos personales, a respetar los derechos prevalentes de los menores. Queda proscrito el tratamiento de datos personales de menores, salvo aquellos datos que sean de naturaleza pública.
          <br>


          7 CLASIFICACIÓN DE INFORMACIÓN Y DE BASES DE DATOS <br>
          Las bases de datos se clasificarán de la siguiente manera:
          <br>
          7.1 Bases de datos Confidenciales: <br>
          Son bases de datos o ficheros electrónicos con información confidencial la cual trata el modelo de negocio de FIRMADOC, es el caso de datos financieros, bases de datos del personal, bases de datos con información sensible sobre directivos, proveedores etc.
          <br>
          7.2 Bases de datos con Información Sensible: <br>
          Son los datos que afectan la intimidad del Titular o cuyo uso indebido puede generar su discriminación, tales como aquellos que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías de partidos políticos de oposición así como los datos relativos a la salud, a la vida sexual y los datos biométricos. En FIRMADOC, el acceso a este tipo de información es restringido y únicamente será conocido por un grupo autorizado de funcionarios.
          <br>
          7.3 Bases de datos con Información Pública: <br>
          Son las bases de datos que contienen datos públicos calificados como tal según los mandatos de la ley o de la Constitución Política y que no son calificados como datos semiprivados, privados o sensibles. Son públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio, a su calidad de comerciante o de servidor público y aquellos que puedan obtenerse sin reserva alguna. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales, sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva.

          <br>
          8 PRERROGATIVAS Y DERECHOS DE LOS TITULARES <br>
          Los Titulares de los datos personales tienen los siguientes derechos:
          <br>
          • Acceder, conocer, actualizar y rectificar sus datos personales frente a FIRMADOC en su condición de responsable del tratamiento.
          <br>

          • Por cualquier medio válido, solicitar prueba de la existencia de la autorización otorgada a FIRMADOC, salvo los casos en los que la Ley exceptúa la autorización.
          <br>
          • Recibir información por parte de SUNTIC S.A.S, previa solicitud, respecto del uso que le ha dado a sus datos personales.
          <br>
          • Acudir ante las autoridades legalmente constituidas y presentar quejas por infracciones a lo dispuesto en la normatividad vigente, previo tramite de consulta o requerimiento ante el responsable del tratamiento.

          <br>
          • Modificar y revocar la autorización y/o solicitar la supresión de los datos personales cuando en el tratamiento no se respeten los principios, derechos y garantías constitucionales vigentes.
          <br>
          • Tener conocimiento y acceder en forma gratuita a sus datos personales que hayan sido objeto de tratamiento.

          <br>
          9 DEBERES DE FIRMADOC EN RELACIÓN CON EL TRATAMIENTO DE LOS DATOS PERSONALES <br>
          <br>
          FIRMADOC, tendrá presente que los datos personales son propiedad de las personas a las que se refieren y que solamente ellas pueden decidir sobre los mismos. FIRMADOC hará uso de dichos datos solamente para las finalidades para las que se encuentra debidamente facultada como empresa dedicada a los servicios de tecnologías de la información y las comunicaciones y dentro de su objeto social respetando en todo caso la normativa vigente sobre la Protección de Datos Personales.
          <br>
          10 POLÍTICAS DE TRATAMIENTO DE LA INFORMACIÓN
          <br>
          10.1 Generalidades Sobre la Autorización
          <br>
          FIRMADOC solicitará la autorización para el tratamiento de datos personales por cualquier medio que permita ser utilizado como prueba. Según el caso, dicha autorización puede ser parte de un documento más amplio, como por ejemplo un contrato o de un documento específico para tal efecto. En todo caso, la descripción de la finalidad del tratamiento de los datos también se informará mediante el mismo documento específico o adjunto. FIRMADOC informará al titular de los datos, lo siguiente:
          <br>
          • El tratamiento al que serán sometidos sus datos personales y la finalidad del mismo.
          <br>
          • Los derechos que le asisten como Titular.
          <br>

          • Los canales en los cuales podrá formular consultas y/o reclamos.

          <br>
          10.2 Garantías del Derecho de Acceso
          <br>
          FIRMADOC garantizará el derecho de acceso, previa acreditación de la identidad del titular, legitimidad, o personalidad de su representante, poniendo a disposición de este, sin costo o erogación alguna, de manera pormenorizada y detallada, los respectivos datos personales.

          <br>
          10.3 Consultas
          <br>
          Los Titulares de los datos personales o sus causahabientes, podrán consultar sus datos personales que reposan en la base de datos. En consecuencia, FIRMADOC garantizará el derecho de consulta, suministrando a los Titulares de datos personales, toda la información contenida en el registro individual o que esté vinculada con la identificación del Titular.
          <br>
          Con respecto a la atención de solicitudes de consulta de datos personales, FIRMADOC garantiza:
          <br>
          • Habilitar medios de comunicación electrónica u otros que considere pertinentes.
          <br>
          • Establecer formularios, sistemas y otros métodos.
          <br>
          • Utilizar los servicios de atención al cliente o de reclamaciones que se encuentren en operación.
          <br>
          Independientemente del mecanismo que se implemente para la atención de solicitudes de consulta, estas serán atendidas en un término máximo de diez (10) días hábiles contados a partir de la fecha de su recibo. En el evento en el que una solicitud de consulta no pueda ser atendida dentro del término antes señalado, se informará al interesado antes del vencimiento del plazo las razones por las cuales no se ha dado respuesta a su consulta, la cual, en ningún caso podrá superar los cinco (5) días hábiles siguientes al vencimiento del primer término.
          Las consultas que se efectúen respecto a datos personales deberán ser remitidas mediante un correo electrónico a la siguiente dirección juridico@suntic.co.
          <br>

          10.4 Reclamos
          <br>
          El Titular o sus causahabientes que consideren que la información contenida en una base de datos debe ser objeto de corrección, actualización o supresión, o cuando adviertan el presunto incumplimiento de cualquiera de los deberes contenidos en la normativa sobre Protección de Datos Personales, podrán presentar un reclamo ante el responsable del tratamiento.
          <br>
          El reclamo deberá ser presentado por el Titular de los datos personales, mediante correo electrónico, y en él, el Titular deberá indicar si desea que sus datos sean actualizados, rectificados o suprimidos o bien si desea revocar la autorización que se había otorgado para el tratamiento de los datos personales.
          Si el reclamo estuviese incompleto, el Titular lo puede completar dentro de los cinco (5) días hábiles siguientes a la recepción del reclamo para que se subsanen las fallas. Transcurridos dos (2) meses desde la fecha del requerimiento sin que el solicitante presente la información requerida, se entenderá que ha desistido del reclamo.
          En caso que la persona que reciba el reclamo no sea competente para resolverlo, dará traslado a quien corresponda en un término máximo de dos (2) días hábiles e informará de la situación al interesado.
          Una vez recibido el reclamo completo, el término máximo para atenderlo será de quince (15) días hábiles contados a partir del día siguiente a la fecha de su recibo. Cuando no fuere posible atender el reclamo dentro de dicho término, se informará al interesado los motivos de la demora y la fecha en que se atenderá su reclamo, la cual en ningún caso podrá superar los ocho (8) días hábiles siguientes al vencimiento del primer término.
          <br>
          10.5 Rectificación y Actualización de Datos
          <br>
          FIRMADOC tiene la obligación de rectificar y actualizar, a solicitud del Titular, la información de éste que resulte ser incompleta o inexacta de conformidad con el procedimiento y lo términos antes señalados. Al respecto, FIRMADOC tendrá en cuenta lo siguiente:
          <br>
          • En las solicitudes de rectificación y actualización de datos personales, el titular debe indicar las correcciones a realizar y aportar la documentación que avale su petición.
          <br>
          • FIRMADOC tiene plena libertad de habilitar mecanismos que le faciliten el ejercicio de este derecho, siempre y cuando beneficien al Titular de los datos. En consecuencia, se podrán habilitar medios electrónicos u otros que FIRMADOC considere pertinentes.

          <br>
          • FIRMADOC podrá establecer formularios, sistemas y otros métodos, que se pondrán a disposición de los interesados en la página web o solicitándolos mediante correo electrónico a la dirección juridico@suntic.co.
          <br>
          10.6 Supresión de Datos <br>
          El Titular de datos personales tiene el derecho, en todo momento, a solicitar a FIRMADOC, la supresión (eliminación) de sus datos personales cuando:
          <br>
          • Considere que los mismos no están siendo tratados conforme a los principios, deberes y obligaciones previstas en la normativa vigente.
          <br>
          • Hayan dejado de ser necesarios o pertinentes para la finalidad para la cual fueron recabados.
          <br>
          • Se haya superado el periodo necesario para el cumplimiento de los fines para los que fueron recabados.
          <br>
          La supresión implica la eliminación total o parcial de la información personal de acuerdo a lo solicitado por el Titular en los registros, archivos, bases de datos o tratamientos realizados por FIRMADOC
          <br>
          El derecho de supresión no es un derecho absoluto y el responsable del tratamiento de datos personales puede negar el ejercicio del mismo cuando:
          <br>
          • El Titular de los datos tenga un deber legal o contractual de permanecer en la base de datos.
          <br>
          • La eliminación de datos obstaculice actuaciones judiciales o administrativas vinculadas a obligaciones fiscales, la investigación y persecución de delitos o la actualización de sanciones administrativas.
          <br>
          • Los datos sean necesarios para proteger los intereses jurídicamente tutelados del Titular para realizar una acción en función del interés público o para cumplir con una obligación legalmente adquirida por el Titular.

          <br>
          10.7 Revocatoria de la Autorización <br>
          Todo Titular de datos personales puede revocar, en cualquier momento, el consentimiento al tratamiento de estos siempre y cuando no lo impida una disposición legal o contractual. Para ello, FIRMADOC establecerá mecanismos sencillos que le permitan al Titular revocar su consentimiento.
          Existen dos modalidades en las que la revocación del consentimiento puede darse:
          <br>
          • Sobre la totalidad de finalidades consentidas, esto es, que FIRMADOC debe dejar de tratar por completo los datos del Titular.
          <br>
          • Sobre ciertas finalidades consentidas como por ejemplo para fines publicitarios o de estudios de mercado. En este caso, FIRMADOC, deberá dejar de tratar parcialmente los datos del Titular. Se mantienen entonces otros fines del tratamiento que el responsable, de conformidad con la autorización otorgada, puede llevar a cabo y con los que el Titular está de acuerdo.
          <br>
          10.8 Contratos <br>

          En los contratos laborales, FIRMADOC incluirá cláusulas con el fin de autorizar de manera previa y general el tratamiento de datos personales relacionados con la ejecución del contrato, lo que incluye la autorización de recolectar, modificar o corregir, en momentos futuros, datos personales del titular. También incluirá la autorización de que algunos de los datos personales, en caso dado, puedan ser entregados a terceros con los cuales FIRMADOC tenga contratos de prestación de servicios, para la realización de tareas tercerizadas. En estas cláusulas se hará mención a esta Política.
          <br>
          En los contratos de prestación de servicios externos, cuando el contratista requiera de datos personales, FIRMADOC le suministrará dichos datos siempre y cuando exista una autorización previa y expresa del titular para esta transferencia. Dado que en estos casos los terceros son encargados del tratamiento de datos, sus contratos incluirán cláusulas que precisan los fines y los tratamientos autorizados por FIRMADOC y delimitan de manera precisa el uso que dicho terceros le pueden dar a los datos.
          <br>
          10.9 Transferencia de Datos Personales a Terceros Países <br>
          La transferencia de datos personales a terceros países solamente se realizará cuando exista autorización correspondiente del Titular.
          <br>
          11 REGLAS GENERALES APLICABLES
          <br>
          • FIRMADOC establece las siguientes reglas generales para la protección de datos personales y sensibles, como en el cuidado de bases de datos, ficheros electrónicos e información personal.
          <br>
          • FIRMADOC garantizará la autenticidad, confidencialidad e integridad de la información.
          La Junta de Seguridad será quien tendrá como objetivo ejecutar y diseñar la estrategia para que la presente Política se cumpla.
          <br>
          • FIRMADOC tomará todas las medidas técnicas necesarias para garantizar la protección de las bases de datos existentes. En los casos que la infraestructura dependa de un tercero, se cerciorará que la disponibilidad de la información como el cuidado de los datos personales y sensibles sea un objetivo fundamental.
          <br>
          • Se realizarán auditorías y controles de manera periódica para garantizar la correcta implementación de la ley.
          <br>
          • Es responsabilidad de los empleados y colaboradores de FIRMADOC reportar cualquier incidente de fuga de información, daño informático, violación de datos personales, comercialización de datos, uso de datos personales de niños, niñas o adolescentes, suplantación de identidad, o conductas que puedan vulnerar la intimidad de una persona.
          <br>
          • La formación y capacitación de los funcionarios, proveedores y contratistas será un complemento fundamental de estas Políticas.
          <br>
          • El Oficial de Protección de Datos, deberá identificar e impulsar las autorizaciones de los Titulares, los avisos de privacidad, los avisos en el website de la entidad, las campañas de sensibilización, las leyendas de reclamo y demás procedimientos para dar cumplimiento a la ley y demás normativa que la complemente, modifique o derogue.
          <br>

          12 FUNCIÓN DE PROTECCIÓN DE DATOS PERSONALES AL INTERIOR DE FIRMADOC <br>

          <br>
          12.1 Los Responsables
          <br>
          Es Responsable del tratamiento de datos personales 'la persona natural o jurídica, pública o privada, que [...] decida sobre la base de datos y/o tratamiento de datos'. De esta manera, el Responsable es el que define los fines y los medios del tratamiento de datos personales y garantiza el cumplimiento de los requisitos de ley.
          <br>
          En el caso de FIRMADOC, la Junta de Seguridad es la responsable de adoptar las medidas necesarias para el buen tratamiento de los datos personales. Quien desarrolla la Secretaría Técnica de la Junta es el Oficial de Protección de Datos Personales.
          <br>
          12.2 Los Encargados
          <br>
          Es Encargado del tratamiento de datos personales 'la persona natural o jurídica, pública o privada, que [...] realice el tratamiento de datos personales por cuenta del responsable del tratamiento'. Esto supone que, para cada tratamiento de datos, se hayan definido sus respectivos encargados y que éstos actúen por instrucción precisa de un Responsable.
          <br>
          12.3 Deberes de los Encargados
          <br>
          FIRMADOC distingue entre Encargado interno y Encargado externo. Los Encargados internos son empleados y colaboradores de FIRMADOC mientras que los externos son personas naturales o jurídicas que tratan datos que la entidad les suministra para la realización de una tarea asignada (proveedores, consultores etc.).
          <br>
          12.4 El Despliegue Interno de la Política de Protección de Datos <br>
          A partir de la adopción de la presente Política, FIRMADOC establecerá: <br>
          • Términos y condiciones de uso de herramientas informáticas externas: Autorregulación de los principios y las reglas consagradas en la ley, dirigidos específicamente a proteger el derecho de hábeas data de clientes, usuarios y en general toda persona natural que interactúe con un aplicativo informático (elemento que gestione información bien sea física o electrónica).
          <br>
          • Oficial de Protección de Datos: En cumplimiento del deber legal relativo a la necesidad de asignar unas responsabilidades directas a un sujeto dentro de la Organización, se crea el rol de Oficial de Protección de Datos Personales, en cabeza del Oficial de Seguridad de la Información, quien teniendo en cuenta lo definido por la Junta de Seguridad, articulará todas las acciones para el efectivo cumplimiento de la Política de Protección de Datos Personales en FIRMADOC
          <br>
          Las obligaciones más importantes a cargo de la Junta de Seguridad son las siguientes: <br>
          <br><br>
          A. Garantizar al Titular, en todo tiempo, el pleno y efectivo ejercicio del derecho de hábeas data. <br>
          B. Solicitar y conservar, en las condiciones previstas en la presente ley, copia de la respectiva autorización otorgada por el Titular. <br>
          C. Informar debidamente al Titular sobre la finalidad de la recolección y los derechos que le asisten por virtud de la autorización otorgada. <br>
          D. Conservar la información bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento. <br>
          E. Garantizar que la información que se suministre al Encargado del tratamiento sea veraz, completa, exacta, actualizada, comprobable y comprensible. <br>
          F. Actualizar la información, comunicando de forma oportuna al Encargado del tratamiento, todas las novedades respecto de los datos que previamente le haya suministrado y adoptar las demás medidas necesarias para que la información suministrada a éste se mantenga actualizada. <br>
          G. Rectificar la información cuando sea incorrecta y comunicar lo pertinente al Encargado del tratamiento. <br>
          H. Suministrar al Encargado del tratamiento, según el caso, únicamente datos cuyo tratamiento esté previamente autorizado de conformidad con lo previsto en la ley. <br>
          I. Exigir al Encargado del tratamiento en todo momento, el respeto a las condiciones de seguridad y privacidad de la información del Titular. <br>
          J. Tramitar las consultas y reclamos formulados en los términos señalados en la ley. <br>
          K. Informar al Encargado del tratamiento cuando determinada información se encuentre en discusión por parte del Titular, una vez se haya presentado la reclamación y no haya finalizado el trámite respectivo. <br>
          L. Informar a solicitud del Titular el uso dado a sus datos personales. Informar a la autoridad de protección de datos cuando se presenten violaciones a los códigos de seguridad y existan riesgos en la administración de la información de los Titulares. <br>
          Cumplir las instrucciones y requerimientos que imparta la Entidad reguladora de la materia. <br>

          13 EL REGISTRO NACIONAL DE BASES DE DATOS <br>

          De acuerdo con lo establecido en la normatividad, FIRMADOC inscribirá de manera independiente en el Registro Nacional de Base de Datos, cada una de las base de datos que contengan datos personales cuyo tratamiento se realice por parte de la Compañía, identificando cada una de esas bases de datos de acuerdo con la finalidad para la cual fueron creadas. En el registro que se efectúe de las bases de datos FIRMADOC indicará su razón social, número de identificación tributaria, así como sus datos de ubicación y contacto.
          FIRMADOC indicará en el Registro Nacional de Base de Datos la razón social, número de identificación tributaria, ubicación y contacto de los Encargados del tratamiento de sus bases de datos (artículo 7 del Decreto 886 de 2014).
          Finalmente, FIRMADOC deberá actualizar en el Registro Nacional de Base de Datos la información inscrita cuando se presenten cambios sustanciales a la misma.
          <br>
          14 VIGENCIA Y ACTUALIZACIÓN <br>
          La presente Política entra en vigencia a partir de su aprobación por parte de la Junta de Seguridad de la Información y su actualización dependerá de las instrucciones de dicha Junta.
          Se articularán las acciones conducentes a la protección de datos personales dentro de la Junta de Seguridad de la Información, la cual realizará revisiones periódicas de la correcta ejecución de la Política de manera conjunta con el Oficial de Protección de Datos de la Compañía. La versión aprobada de esta Política se publicará en la página oficial de FIRMADOC
          Es un deber de los empleados y colaboradores de FIRMADOC, conocer esta Política y realizar todos los actos conducentes para su cumplimiento, implementación y mantenimiento.
          <br>
          La presente Política de Protección de Datos Personales fue aprobada en sesión de Junta de Seguridad de FIRMADOC el día dieciocho (18) de noviembre de 2022.

          <br>

          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");
    var modal2 = document.getElementById("myModal2");
    var modal3 = document.getElementById("myModal3");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    var btn2 = document.getElementById("myBtn2");
    var btn3 = document.getElementById("myBtn3");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("close2")[0];
    var span3 = document.getElementsByClassName("close3")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
      const contenido = document.getElementById('modal-content1');
      contenido.style.position = "absolute";
      contenido.style.top = "50px";
      contenido.style.left = "50%";
      contenido.style.transform = "translateX(-50%)";
    }
    btn2.onclick = function() {
      modal2.style.display = "block";
      const contenido = document.getElementById('modal-content2');
      contenido.style.position = "absolute";
      contenido.style.top = "50px";
      contenido.style.left = "50%";
      contenido.style.transform = "translateX(-50%)";
    }
    btn3.onclick = function() {
      modal3.style.display = "block";
      const contenido = document.getElementById('modal-content3');
      contenido.style.position = "absolute";
      contenido.style.top = "50px";
      contenido.style.left = "50%";
      contenido.style.transform = "translateX(-50%)";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    span2.onclick = function() {
      modal2.style.display = "none";
    }
    span3.onclick = function() {
      modal3.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "block";
      }
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal2) {
        modal2.style.display = "block";
      }
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal3) {
        modal3.style.display = "block";
      }
    }

    const phoneInputField = document.querySelector("#utelefono");
    const phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
  </script>

  <script>
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /*for each element, create a new DIV that will act as the selected item:*/
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /*for each element, create a new DIV that will contain the option list:*/
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
          /*when an item is clicked, update the original select box,
          and the selected item:*/
          var y, i, k, s, h, sl, yl;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          sl = s.length;
          h = this.parentNode.previousSibling;
          for (i = 0; i < sl; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              yl = y.length;
              for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
          }
          h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }

    function closeAllSelect(elmnt) {
      /*a function that will close all select boxes in the document,
      except the current select box:*/
      var x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
  </script>

</body>

</html>

<?php
include '../conexion.php';

// GEneramos los enlaces para tener la opcion de redirigirse a los destinos seleccionados
function redireccion()
{
  if (isset($_GET['codigo']) == "OTP") {
    echo "<script>window.location.replace('../dashboard');</script>";
  } else {
    echo "<script> window.location = '" . LINK_BIOMETRICO_DESTINATARIO . "';</script>";
  }
}

if ($link->connect_errno) {
  echo "ERROR al conectar con la DB.";
  exit;
}

if (isset($_POST['registrar'])) {

  $nombre = ucwords(strtolower($_POST['unombre']));
  $apellido = ucwords(strtolower($_POST['uapellido']));
  $tidentificacion = ($_POST['utidentificacion']);
  $identificacion = ($_POST['uidentificacion']);
  $numidentificacion = strlen($identificacion);
  $telefono = ($_POST['utelefono']);
  $numtelefono = strlen($telefono);
  $correo = trim(mb_strtolower($_POST['ucorreo']));
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];


  $codigo = rand(1000, 99999999);
  $bytes = random_bytes(5);
  $token = bin2hex($bytes);
  $patron_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\$@\$!\|\/\%\*\?\-=¿\"\·\+\{\}:\[\]&,¬;\'#\.¡\$\(\$\)\$\-\_])[A-Za-z\d\$\:\{\}\[\]@\/|\"\-;!%¬,\*·\?\+=\'¡¿&#\.\$\(\$\)\$\-\_]{8,15}$/';
  
  if (empty($nombre)) {
    echo "<script>document.getElementById('unombre').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su nombre o nombres.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($apellido)) {
    echo "<script>document.getElementById('uapellido').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese sus apellidos o apellido.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($tidentificacion)) {
    echo "<script>document.getElementById('utidentificacion').attr('selected', true);</script>";
    echo "<script>document.getElementById('utidentificacion').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor seleccione un tipo de identificaci&oacute;n.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($identificacion)) {
    echo "<script>document.getElementById('uidentificacion').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su n&uacute;mero de identificaci&oacute;n.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (!is_numeric($identificacion)) {
    echo "<script>document.getElementById('uidentificacion').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese solo n&uacute;meros en su identificaci&oacute;n.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if ($numidentificacion < 8) {
    echo "<script>document.getElementById('uidentificacion').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese mínimo 8 n&uacute;meros en su identificaci&oacute;n.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($telefono)) {
    echo "<script>document.getElementById('utelefono').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su n&uacute;mero fijo o m&oacute;vil.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (!is_numeric($telefono)) {
    echo "<script>document.getElementById('utelefono').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese solo n&uacute;meros para fijo o m&oacute;vil.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if ($numtelefono < 6) {
    echo "<script>document.getElementById('utelefono').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese m&iacute;nimo 7 n&uacute;meros para fijo o m&oacute;vil.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (empty($correo)) {
    echo "<script>document.getElementById('ucorreo').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor ingrese su correo electr&oacute;nico.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } 
  else if ($password != $cpassword) {
    echo "<script>
    document.getElementById('ucorreo').value= '';
    document.getElementById('uccorreo').value= '';
    </script>";
    echo "<script>document.getElementById('ucorreo').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      title: 'Las contraseñas son diferentes.',
      html: 'Por favor ingrese nuevamente su contraseñas.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (!preg_match($patron_password, $password)) {
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Ingresa una contraseña con minimo 8 caracteres, maximo 15 caracteres, un caracter especial y al menos una mayuscula y una minuscula',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else if (!isset($_POST['my-checkbox']) or !isset($_POST['my-checkbox2']) or !isset($_POST['my-checkbox3'])) {
    echo "<script>document.getElementById('opt-in').focus();</script>";
    echo "<script>Swal.fire({
      icon: 'warning',
      html: 'Por favor acepte los t&eacute;rminos y condiciones.',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false
    });</script>";
  } else {
    if (!empty($identificacion) && is_numeric($identificacion) && $numidentificacion >= 8) {
      $sqlnumidentificacion = "select * from usuario where usu_docume = $identificacion";
      $result = $link->query($sqlnumidentificacion);
      $nr = mysqli_num_rows($result);

      if ($nr) {
        echo "<script>Swal.fire({
          icon: 'warning',
          html: 'El <b><i><u>n&uacute;mero de identificaci&oacute;n</u></i></b> ya se encuentra registrado.',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false,
        });
        window.location.replace(" . LINK_BIOMETRICO_DESTINATARIO . ");
        </script>";
      } else {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {

          $sqlemail = "select * from usuario where usu_email = '" . $correo . "'";
          $resultemail = $link->query($sqlemail);
          $nre = mysqli_num_rows($result);

          if ($nre) {
            echo "<script>Swal.fire({
              icon: 'warning',
              html: 'El <b><i><u>n&uacute;mero de identificaci&oacute;n</u></i></b> ya se encuentra registrado.',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar',
              allowOutsideClick: false
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = '" . LINK_BIOMETRICO_DESTINATARIO . "';
              }
            });</script>";
          } else {
            $sql = "INSERT into usuario(usu_estado, usu_passwo,rol_usuario, usu_nombre, usu_apelli, usu_tipo_documento, usu_docume, usu_email, usu_celula, usu_terminos, usu_token, usu_codigo, usu_codigo_vivo) values ('A','" . password_hash($password, PASSWORD_BCRYPT) . "','3','$nombre','$apellido','$tidentificacion','$identificacion','$correo','$telefono','Si','$token','$codigo',false)";
            $link->query($sql);
            $id_user = mysqli_insert_id($link);

            if ($id_user != "") {

              //Creación de directorios para el usuario.
              $directorioimgfirmatmp = "../bodega/precarga/" . $id_user . "/imgfirmatmp";
              $directorioimgfirmafija = "../bodega/precarga/" . $id_user . "/imgfirmafija";
              $directoriofirmadigital = "../bodega/precarga/" . $id_user . "/firmadigital";
              $directoriofirmado = "../bodega/firmado/" . $id_user;
              $directorioeliminado = "../bodega/eliminado/" . $id_user;

              mkdir($directorioimgfirmatmp, 0777, true);
              mkdir($directorioimgfirmafija, 0777, true);
              mkdir($directoriofirmadigital, 0777, true);
              mkdir($directoriofirmado, 0777, true);
              mkdir($directorioeliminado, 0777, true);
            }
            echo "<script>Swal.fire({
          icon: 'success',
          title: 'Bienvenido!!!',
          html: '',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = '" . LINK_BIOMETRICO_DESTINATARIO . "';
            }
          });</script>";
          }
        } else {
          echo "<script>Swal.fire({
          icon: 'error',
          html: 'El correo no cumple con la validaci&oacute;n, vuelva a intentarlo.',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false
        });</script>";
        }
      }
    }
  }
}

mysqli_close($link);
?>