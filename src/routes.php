<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

/**
 * Class Pic
 * modelo de la base de datos pic
 */
class Pic extends Illuminate\Database\Eloquent\Model {

    protected $table = 'pic';
    protected $fillable = ['deviceId','date','url','latitude','longitude','positive','negative','warning'];
    public $timestamps = false;
}

/**
 * Class Twin
 * modelo de la base de datos twin
 */
class Twin extends Illuminate\Database\Eloquent\Model {

    protected $table = 'twin';
    protected $fillable = ['deviceId','idServidor','idAndroid'];
    public $timestamps = false;
}

/**
 * Inserccion
 */

$app->post('/insertar/pic',function(){
    $json = file_get_contents('php://input');
    $pic = json_decode($json,true);
    $ifp = fopen('images/'.$pic['url'],"da");
    fwrite($ifp, base64_decode($pic['url']));
    fclose($ifp);
    $enlace = mysqli_connect('localhost','root','','pictwin');
    $query = "INSERT INTO pic (idDevice,url,date,latitude,longitude,positive,negative,warning) VALUES ('".$pic['deviceId']."','".$pic['url']."','".$pic['date']."','".$pic['latitude']."','".$pic['longitude']."',0,0,0)";
    $enlace->query($query);
    mysqli_close($enlace);
});
