<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php require_once "sidebar.php";

 ?>



<div id="app">
            <table class="default">

            <tr>

                <td>ID</td>

                <td>NOMBRE</td>


            </tr>

            <tr v-for="subnombre in datos">

                <td>{{subnombre.HOLA}}</td>

                <td><td>{{subnombre.ADIOS}}</td></td>


            </tr>

            </table>
            </div>
</body>
</html>

<script src="js/libs/vue.min.js"></script>
<script src="js/funciones.js"></script>