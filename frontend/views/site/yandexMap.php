<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="mt-3 col-12" id="map" style="height: 50vh; margin: 0; padding: 0;"></div>
<div class="d-flex justify-content-around mt-3">
    <input type="text" value="" id="urlLoc" class="form-control col-10">
    <button  onclick="myLocation()"  class="btn btn-success ">Manzilni olish</button>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" integrity="sha512-AFwxAkWdvxRd9qhYYp1qbeRZj6/iTNmJ2GFwcxsMOzwwTaRwz2a/2TX225Ebcj3whXte1WGQb38cXE5j7ZQw3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://api-maps.yandex.ru/2.1/?apikey=d74818cb-2b1a-422f-aea9-f10b1a668a00&lang=ru_RU" type="text/javascript"></script>

<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var geolocation = ymaps.geolocation,
            myMap = new ymaps.Map('map', {
                center: [55, 34],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });

        // Сравним положение, вычисленное по ip пользователя и
        // положение, вычисленное средствами браузера.
        geolocation.get({
            provider: 'yandex',
            mapStateAutoApply: true
        }).then(function (result) {
            // Красным цветом пометим положение, вычисленное через ip.
            result.geoObjects.options.set('preset', 'islands#redCircleIcon');
            result.geoObjects.get(0).properties.set({
                balloonContentBody: 'Мое местоположение'
            });
            myMap.geoObjects.add(result.geoObjects);
        });

        geolocation.get({
            provider: 'browser',
            mapStateAutoApply: true
        }).then(function (result) {
            // Синим цветом пометим положение, полученное через браузер.
            // Если браузер не поддерживает эту функциональность, метка не будет добавлена на карту.
            result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
            myMap.geoObjects.add(result.geoObjects);
        });
    }


    myLocation = (x,y) => {

        const successCallBack = (position) => {
            // console.log(position)
            let url = `https://yandex.ru/navi/?whatshere%5Bpoint%5D=${position.coords.longitude}%2C${position.coords.latitude}&whatshere%5Bzoom%5D=18&lang=ru&from=navi`
            let urlLoc = document.getElementById("urlLoc");
            urlLoc.value = url
        }
        const errorCallBack = (error) => {
            console.log(error)
        }
        navigator.geolocation.getCurrentPosition(successCallBack , errorCallBack)



    }
</script>

<!--KEY YANDEX MAP  = d74818cb-2b1a-422f-aea9-f10b1a668a00  -->
