<LINK REL=StyleSheet HREF="./cuerpo.css" TYPE="text/css" MEDIA=screen>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function agregarCarrito(codigo_producto) {
        $.ajax({
            method: "POST",
            url: "agregar_carrito.php",
            data: {codigo: codigo_producto}
        })
                .done(function (response) {
                    $("p.broken").html(response);
                });
    }

    function enviarFormulario() {
        document.formulario.submit();
    }
</script>
<form action="index.php" method="post" target="" name="formulario" id="formulario">
    <p class="broken"></p>
    <div class="cuerpo-container">
        <div class="cuerpo-titulo">
            <label>OFERTA Y PLANES</label>
        </div>
        <div class="cuerpo-contenido">
            <div class="contenido-opciones">
                <button>Anual</button>
                <button>Mensual</button>
            </div>
            <div class="contenido-ofertas">
                <div class="oferta-contenido">
                    <div class="oferta-contenido-cabezera">
                        <div class="cabezera-contenido">
                            <label>Personal</label>
                            <span>$ 10</span>
                            <p>Por mes $120 anualmente</p>
                        </div>
                    </div>
                    <div class="oferta-contenido-boton">
                        <button onclick="agregarCarrito(1);">Agregar al carrito</button>
                    </div>
                    <div class="oferta-contenido-label">
                        <label>Enviar documentos firmados por 5 meses</label>
                        <br><br>
                        <hr>
                        <label>Reportes basicos</label>
                        <br><br>
                        <hr>
                        <label>Accesibilidad completa</label>
                        <br><br>
                    </div>
                </div>
                <div class="oferta-contenido">
                    <div class="oferta-contenido-cabezera">
                        <div class="cabezera-contenido">
                            <label>Realtors</label>
                            <span>$ 20</span>
                            <p>Por mes $120 anualmente</p>
                        </div>
                    </div>
                    <div class="oferta-contenido-boton">
                        <button onclick="agregarCarrito(2);">Agregar al carrito</button>
                    </div>
                    <div class="oferta-contenido-label">
                        <label>Enviar documentos firmados por 5 meses</label>
                        <br><br>
                        <hr>
                        <label>Reportes basicos</label>
                        <br><br>
                        <hr>
                        <label>Accesibilidad completa</label>
                        <br><br>
                    </div>
                </div>
                <div class="oferta-contenido">
                    <div class="oferta-contenido-cabezera">
                        <div class="cabezera-contenido">
                            <label>Estandar</label>
                            <span>$ 25</span>
                            <p>Por mes $120 anualmente</p>
                        </div>
                    </div>
                    <div class="oferta-contenido-boton">
                        <button onclick="agregarCarrito(3);">Agregar al carrito</button>
                    </div>
                    <div class="oferta-contenido-label">
                        <label>Enviar documentos firmados por 5 meses</label>
                        <br><br>
                        <hr>
                        <label>Reportes basicos</label>
                        <br><br>
                        <hr>
                        <label>Accesibilidad completa</label>
                        <br><br>
                    </div>
                </div>
                <div class="oferta-contenido">
                    <div class="oferta-contenido-cabezera">
                        <div class="cabezera-contenido">
                            <label>Comercio Pro</label>
                            <span>$ 40</span>
                            <p>Por mes $120 anualmente</p>
                        </div>
                    </div>
                    <div class="oferta-contenido-boton">
                        <button onclick="agregarCarrito(4);">Agregar al carrito</button>
                    </div>
                    <div class="oferta-contenido-label">
                        <label>Enviar documentos firmados por 5 meses</label>
                        <br><br>
                        <hr>
                        <label>Reportes basicos</label>
                        <br><br>
                        <hr>
                        <label>Accesibilidad completa</label>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>