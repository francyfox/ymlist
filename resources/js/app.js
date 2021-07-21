import axios from "axios";
// Дождёмся загрузки API и готовности DOM.
let myMap;
let places = [];

function changeTarget () {
    const tabs = document.querySelectorAll('table tr:nth-child(n+2)');
    tabs.forEach((tab) => {
        tab.addEventListener('click', function () {
            const x = parseInt(this.dataset.x)
            const y = parseInt(this.dataset.y)
            myMap.setCenter([x, y], 7, {
                checkZoomRange: true
            });
        });
    });
}
function editPlace () {
    const buttons = document.querySelectorAll('._edit');
    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.dataset.id
            const parentTree = this.parentElement.parentElement;
            const text = parentTree.querySelectorAll('input');
            const oldText = parentTree.querySelectorAll('span');
            parentTree.classList.toggle('change');
            places[id] = {
                name: text[0].value,
                x: text[1].value,
                y: text[2].value
            };
            oldText[0].innerText = text[0].value;
            oldText[1].innerText = text[1].value;
            oldText[2].innerText = text[2].value;
            axios.post('http://127.0.0.1:8000/map', places).catch((e) => console.log(e));
            if (!parentTree.classList.contains('change')){
                document.location.reload();
            }
        });
    });
}
function deletePlace () {
    const buttons = document.querySelectorAll('._delete');
    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            places.splice(parseInt(this.dataset.id), 1);
            axios.post('http://127.0.0.1:8000/map', places).catch((e) => console.log(e));
            document.location.reload();
        })
    });
}

function addNewPlace (name, x, y) {
    const placemark = new ymaps.Placemark([x, y], {
        name: name,
        balloonContentHeader: name
    });
    // const myGeoObject = new ymaps.Placemark({
    //     // Описание геометрии.
    //     geometry: {
    //         type: "Point",
    //         coordinates: [x, y]
    //     },
    //     // Свойства.
    //     properties: {
    //         // Контент метки.
    //         iconContent: name,
    //         hintContent: name
    //     }
    // });
    myMap.geoObjects.add(placemark);
}
function addNewPlaceByClick () {
    document.querySelector('#addPoint').addEventListener('click', event => {
        const placeName = document.querySelector('#namepos');
        const xPos = document.querySelector('#xpos');
        const yPos = document.querySelector('#ypos');

        addNewPlace(placeName.value, xPos.value, yPos.value);
        places.push({
            name: placeName.value,
            x: xPos.value,
            y: yPos.value
        })

        axios.post('http://127.0.0.1:8000/map', places).catch((e) => console.log(e));
    });
}


function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").

    let geolocation = ymaps.geolocation;
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

    myMap = new ymaps.Map('myMap', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [55.76, 37.64], // Москва
        zoom: 10
    }, {
        searchControlProvider: 'yandex#search',
            mapStateAutoApply: true
    },

        axios.get('http://127.0.0.1:8000/ymgeo').then((response) => {
            if (Object.keys(response.data).length !== 0) {
                response.data.forEach((place) => {
                    addNewPlace(place.name, place.x, place.y)
                    places.push({name: place.name, x: place.x, y: place.y});
                });
            }
        }),
    );


}

document.addEventListener("DOMContentLoaded", () => {
    ymaps.ready(init);
    addNewPlaceByClick();
    deletePlace();
    editPlace();
    changeTarget();
});
