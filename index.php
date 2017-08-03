<?php
    require_once 'vendor/autoload.php';
    require_once 'Poster.php';
    $poster = new Poster();
    $faker = Faker\Factory::create();
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
    /*if ($_POST)
    {
        var_dump($_POST);
        die();
        if ($poster->create($_POST)) {
            echo '<h1>Yes</h1>';
        } else {
            echo '<h1>Not</h1>';
        }
    }
    for ($i = 0; $i < 199; $i++) {
        $data['fechaCertificacion'] = $faker->date($format = 'Y-m-d', $max = 'now');
        $data['imgPoster'] = $faker->imageUrl($width = 640, $height = 480);
        $data['nombreAuxiliar'] = $faker->name;
        $data['txtParticipaciontituloPoster'] = $faker->text;
        $data['txtAuxiliarnombreEvento'] = $faker->text;
        $data['txtFirma'] = $faker->text;
        $poster->create($data);
    }*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    input{
        display: block;
    }
    table, tr, td {
    border: 1px solid black;
}
</style>
<body>
    <!--
    <form action="" method="POST">
        <input type="date" name="fechaCertificacion" value="<?= $faker->date($format = 'Y-m-d', $max = 'now') ?>"/>
        <input type="text" name="imgPoster" value="<?= $faker->imageUrl($width = 640, $height = 480)  ?>"/>
        <input type="text" name="nombreAuxiliar" value="<?= $faker->name ?>" />
        <input type="text" name="txtParticipaciontituloPoster" value="<?= $faker->text ?>"/>
        <input type="text" name="txtAuxiliarnombreEvento" value="<?= $faker->text ?>"/>
        <input type="text" name="txtFirma" value="<?= $faker->text ?>" />
        <button>Enviar</button>
    </form>
    -->
    <form action=""> 
        <input type="text" name="search" value="<?= $search ?>">
        <!--<input type="hidden" name="page" value="<?= $page ?>">-->
        <button>buscar</button>
    </form>
    <table> 
    <?php foreach ($poster->paginateItems($page, $search) as $v): ?>
        <tr> 
            <td><?= $v->posterId ?></td>
            <td><?= $v->fechaCertificacion ?></td>
            <td><?= $v->imgPoster ?></td>
            <td><?= $v->nombreAuxiliar ?></td>
            <td><?= $v->txtParticipaciontituloPoster ?></td>
            <td><?= $v->txtAuxiliarnombreEvento ?></td>
            <td><?= $v->txtFirma ?></td>
        </tr>
    <?php endforeach ?>
    </table>
    <?php echo $poster->paginationRender($page, $search); ?>
</body>

</html>