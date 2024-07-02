<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Valverde - Información</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/informacion.css" />
    <script src=" iniciarsesion_validation.js" defer></script>
    <?php
        session_start();
    ?>
</head>

<body>

    <section class="header-body">
        <header>
            <h1>MUSEO VALVERDE</h1>
            <img src="../imagenes/logotipo.png" class="logo">
            <nav class="grip-layout">
                <?php
                if (isset($_SESSION['usuario'])) {

                    echo '<div class="welcome-message">';
                        echo '<h3>Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '!</h3>';
                        echo '<button onclick="location.href=\'logout.php\'" type="button">Cerrar sesión</button>';
                    echo '</div>';
                } else 
                {
                ?>
                    <form class="Registro" action="login.php" method="post">
                        <article>
                            <label for="bt1">Usuario:</label>
                            <input type="text" id="bt1" name="usuario" value="">
                        </article>

                        <article>
                            <label for="bt2">Contraseña:</label>
                            <input type="text" id="bt2" name="contrasena" value="">
                        </article>

                        <article>
                            <hr>
                            <label for="bt3"></label>
                            <input type="submit" id="bt3" value="Iniciar Sesion">
                        </article>

                        <article>
                            <hr>
                            <label for="bt4"></label>
                            <input type="button" id="bt4" value="Registrarse"
                                onclick="window.location.href='altausuario.php'">
                        </article>
                    </form>
                <?php
                }
                ?>

                <article class="Menu">
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="coleccion.php">Colección</a></li>
                        <li><a href="exposiciones.php">Exposiciones</a></li>
                        <li><a href="visita.php">Visita</a></li>
                        <li><a href="informacion.php">Información</a></li>
                        <li><a href="experiencias.php">Experiencias</a></li>
                    </ul>
                </article>
            </nav>
        </header>
        <hr>
    </section>

    <main>
        <article style="grid-column: 1 / 3;">
            <h1>Información</h1>
        </article>

        <section>
            <h2>Precios de entrada</h2>
            <dl>
                <dt>Entrada general:</dt>
                <dd>8€</dd>
                <dt>Entrada reducida:</dt>
                <dd>4€</dd>
                <dt>Entrada gratuita:</dt>
                <dd>Menores de 12 años</dd>
            </dl>
        </section>

        <section>
            <h2>Horario de apertura</h2>
            <dl>
                <dt>Lunes a viernes:</dt>
                <dd>10-19 h</dd>
                <dt>Sabados y festivos:</dt>
                <dd>10-14 h</dd>
                <dt>Domingos:</dt>
                <dd>Cerrado</dd>
            </dl>
        </section>

        <section class="horario">
            <section>
                <p>Leyenda</p>
                <hr>
                <p><span class="color-box" style="background-color: rgba(136, 156, 162, 0.573);"></span>Abierto</p>
                <p><span class="color-box" style="background-color: rgba(134, 201, 243, 0.573);"></span>Solo Mañana</p>
                <p><span class="color-box" style="background-color: rgba(238, 102, 78, 0.573);"></span>Cerrado</p>
            </section>
            
            <article>
                <table>
                    <tr><th colspan="7">Abril</th></tr>
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                    <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td style="background-color: rgba(134, 201, 243, 0.573);">6</td><td style="background-color: rgba(238, 102, 78, 0.573);">7</td></tr>
                    <tr><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td style="background-color: rgba(134, 201, 243, 0.573);">13</td><td style="background-color: rgba(238, 102, 78, 0.573);">14</td></tr>
                    <tr><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td style="background-color: rgba(134, 201, 243, 0.573);">20</td><td style="background-color: rgba(238, 102, 78, 0.573);">21</td></tr>
                    <tr><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td style="background-color: rgba(134, 201, 243, 0.573);">27</td><td style="background-color: rgba(238, 102, 78, 0.573);">28</td></tr>
                    <tr><td>29</td><td>30</td></tr>
                </table>
            </article>
            
            <article>
                <table>
                    <tr><th colspan="7">Mayo</th></tr>
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                    <tr><td></td><td></td><td style="background-color: rgba(238, 102, 78, 0.573);">1</td><td>2</td><td>3</td><td style="background-color: rgba(134, 201, 243, 0.573);">4</td><td style="background-color: rgba(238, 102, 78, 0.573);">5</td></tr>
                    <tr><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td style="background-color: rgba(134, 201, 243, 0.573);">11</td><td style="background-color: rgba(238, 102, 78, 0.573);">12</td></tr>
                    <tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td style="background-color: rgba(134, 201, 243, 0.573);">18</td><td style="background-color: rgba(238, 102, 78, 0.573);">19</td></tr>
                    <tr><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td style="background-color: rgba(134, 201, 243, 0.573);">25</td><td  style="background-color: rgba(238, 102, 78, 0.573);"">26</td></tr>
                    <tr><td style="background-color: rgba(134, 201, 243, 0.573);">27</td><td style="background-color: rgba(134, 201, 243, 0.573);">28</td><td style="background-color: rgba(134, 201, 243, 0.573);">29</td><td style="background-color: rgba(238, 102, 78, 0.573);">30</td><td style="background-color: rgba(134, 201, 243, 0.573);">31</td></tr>
                </table>
            </article>
            
            <article>
                <table>
                    <tr><th colspan="7">Junio</th></tr>
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                    <tr><td></td><td></td><td></td><td></td><td></td><td style="background-color: rgba(134, 201, 243, 0.573);">1</td><td style="background-color: rgba(238, 102, 78, 0.573);">2</td></tr>
                    <tr><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td style="background-color: rgba(134, 201, 243, 0.573);">8</td><td style="background-color: rgba(238, 102, 78, 0.573);">9</td></tr>
                    <tr><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td style="background-color: rgba(134, 201, 243, 0.573);">15</td><td style="background-color: rgba(238, 102, 78, 0.573);">16</td></tr>
                    <tr><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td style="background-color: rgba(134, 201, 243, 0.573);">22</td><td style="background-color: rgba(238, 102, 78, 0.573);">23</td></tr>
                    <tr><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td style="background-color: rgba(134, 201, 243, 0.573);">29</td><td style="background-color: rgba(238, 102, 78, 0.573);">30</td></tr>
                </table>
            </article>
        </section>

        <article style="margin-top: 4%;">
            <p><strong>Ubicacion: </strong><a href="https://maps.app.goo.gl/GU7H14mvQCxUaRmR6">C/ San Juan de Dios,
                    15</a></p>
        </article>

    </main>
    
    <footer>
        <hr>
        <nav>
            <article>
                <p><a href="contacto.php">Contacto 📞</a></p>
            </article>

            <article>
                <p><a href="../Como_se_hizo.pdf">Como se hizo 📦</a></p>
            </article>
        </nav>
    </footer>

</body>

</html>