@extends('layouts/app')

@section('map')
    <div class="columns is-vcentered">
        @guest()
        <div class="column is-5">
            <figure class="image is-4by3">
                <img src="https://picsum.photos/800/600/?random" alt="Description">
            </figure>
        </div>
        <div class="column is-6 is-offset-1">
            <h1 class="title is-2">
                Задача:
            </h1>
            <h2 class="subtitle is-4">
                сделать небольшое приложение по работе с яндекс картами.
            </h2>
            <br>
            <p class="has-text">
                <ul>
                    <li>1) регистрация и авторизация, для незалогиненных пользователей показывать главную страницу с описанием приложения просто</li>
                    <li>2) залогиненному пользователю показывать:</li>
                    <li>2.1) яндекс-карту центрированную на его местоположении</li>
                    <li>2.2) слева от карты список локаций (изначально список пустой). формат: название, долгота, широта. у каждого элемента списка кнопки редактировать и удалить</li>
                    <li>2.3) над списком форма для добавления локации, три инпута соответственно название, долгота, широта</li>
                    <li>2.4) каждая локация из списка должна быть отмечена на карте маркером</li>
                    <li>2.5) список должен быть свой у каждого юзера</li>
                    <li>3) при заполнении формы для добавления локации, локация должна добавляться в список и должен появляться маркер на карте</li>
                    <li>4) при нажатии на удаление локации она должна пропадать из списка и маркер должен исчезать с карты</li>
                    <li>5) при нажатии на редактирование локации, должна появляться отредактировать ее название и координаты, в случае смены координат маркер также должен переместиться на карте</li>
                    <li>6) при клике на локацию в списке карта должна центрироваться на маркере этой локации</li>
                    <li>7) при клике на маркер должен вылезать балун с текстом - название локации этого маркера</li>
                </ul>
            </p>
        </div>
        @else
        <div class="column is-7">
           <div id="myMap"></div>
        </div>
        {{--   LIST   --}}
        <div class="column is-6">
            <div class="card events-card">
                <div class="card-header">
                    <p class="card-header-title">
                        Points
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                      <span class="icon">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                      </span>
                    </a>
                </div>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                            <tr>
                                <td>
                                    <input id="namepos" class="input" type="text" placeholder="Place Name">
                                </td>
                                <td>
                                    <input id="xpos" class="input" type="number" placeholder="X position">
                                </td>
                                <td>
                                    <input id="ypos" class="input" type="number" placeholder="Y position">
                                </td>
                                <td class="level-right"><a id="addPoint" class="button is-small is-primary" href="#">ADD Point</a></td>
                            </tr>
                            @foreach($ymlist as $item)
                            <tr class="item-text">
                                <td>
                                    <span>{{ $item["name"] }}</span>
                                    <input class="input" type="text" value="{{ $item["name"] }}" placeholder="Place Name">
                                </td>
                                <td>
                                    <span>{{ $item["x"] }}</span>
                                    <input class="input" type="number" value="{{ $item["x"] }}" placeholder="X position">
                                </td>
                                <td>
                                    <span>{{ $item["y"] }}</span>
                                    <input id="ypos" class="input" type="number" value="{{ $item["y"] }}" placeholder="Y position">
                                </td>
                                <td class="level-right">
                                    <a data-id="{{ $loop->index }}" class="button is-small is-primary _edit" href="#">Edit</a>
                                    <a data-id="{{ $loop->index }}" class="button is-small is-cansel _delete" href="#">DEL</a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- ENDLIST --}}
        @endguest
    </div>
@endsection
