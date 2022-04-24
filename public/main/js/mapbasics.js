var myMap;

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("ya-map").
    myMap = new ymaps.Map('ya-map', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [59.193228, 39.826575],
        zoom: 15.5
    });

    myMap.behaviors.disable('scrollZoom'); // Отключаем Zoom при прокрутке мыши

    myGeoObject = new ymaps.GeoObject({
        geometry: {
            type: "Point",// тип геометрии - точка
            coordinates: [59.193228, 39.826575] // координаты точки
       }
    });
    myMap.geoObjects.add(myGeoObject); // Размещение геообъекта на карте.

}