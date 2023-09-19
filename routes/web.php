<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#1
Route::get('/', function () {
    return view('welcome');
})->name("home");

#2
Route::get('/user/{id}', function ($id = null) {

    $users = ["Allan", "Felipe", "Elton", "Victor", "Wilson"];

    if($id !== null && $id <= count($users)-1) { 
        return "ID do usuário: " .$id."<br/>Nome do Usuário: ".$users[$id]; 
    }
    return "Nenhum usuário registrado com o ID ".$id;

})->name("user.prifile")->where("id", "[0-9]+");

#3
Route::get('/post/{slug}', function ($slug = null) {
    if($slug !== null) { return "<h1>Título do post: ".$slug."</h1>"; }
})->name("blog.post");

#4
Route::get('/category/{category}', function ($category = null) {
    
    $blogs = [
        ["title"=>"Como usar Linux", "text"=>"Vamos aprender a usar linux...", "category"=>"technology"],
        ["title"=>"Como usar Windows", "text"=>"Vamos aprender a usar o windows...", "category"=>"technology"],
        ["title"=>"Como fazer final 100% no 'Zelda Majory Mask?'", "text"=>"Vamos desvendar todos os segredos...", "category"=>"game"],
        ["title"=>"Melhor jogo", "text"=>"Geometry Dash", "category"=>"game"],
        ["title"=>"Como fazer Estrogonofe", "text"=>"Do jeito Brasileiro...", "category"=>"food"],
        ["title"=>"Como fazer Estrogonofe 2", "text"=>"Do jeito Russo...", "category"=>"food"]
    ];
    $filter = [];

    foreach($blogs as $blog) {
        if($blog["category"] == $category) { $filter[] = $blog; }
    }
    if(count($filter) >= 1) { return $filter; }
    return "Não há nenhuma categoria com o nome ".$category;

})->name("blog.category");


#5
Route::get('/user/{id}/language/{lang?}', function ($id, $lang="pt-br") {
    
    $users = ["Allan", "Felipe", "Elton", "Victor", "Wilson"];

    if($id !== null && $id <= count($users)-1) { 
        return "ID do usuário: " .$id."<br/>Nome do Usuário: ".$users[$id]."<br/>Idioma usado: ".$lang; 
    }
    return "Nenhum usuário registrado com o ID ".$id;

})->name("user.profile.language")->where("id", "[0-9]+");


#6
Route::get('/products/{category}/{minPrice?}', function ($category, $minPrice=null) {
    
    $products = [
        ["name"=>"Maçã", "category"=>"fruit", "price"=>5],
        ["name"=>"Pera", "category"=>"fruit", "price"=>2],
        ["name"=>"Bala", "category"=>"candy", "price"=>2.5],
        ["name"=>"Alface", "category"=>"vegetable", "price"=>4],
        ["name"=>"frango", "category"=>"meat", "price"=>7],
        ["name"=>"Carne", "category"=>"meat", "price"=>20]
    ];
    $filter = [];

    foreach($products as $product) {
        if($minPrice !== null) {
            if($product["category"] == $category && $product["price"] <= $minPrice) { $filter[] = $product; }
        } else {
            if($product["category"] == $category) { $filter[] = $product; }
        }
    }
    if(count($filter) >= 1) { return $filter; }
    return "Não há nenhum produto com o nome ".$category;

})->name("products.category.price");


#7
Route::get('/page/{page}', function ($page) {
    return "Número da página: ". $page;
})->name("page.number")->where("page", "[0-9]+");


#8
Route::get('/convert/{currency}', function ($currency) {
    return "R$".$currency." -> U$".($currency/4.87);
})->name("currency.converter")->where("currency", "[0.1-9.9]+");


#9
Route::get('/sum/{number1}/{number2}', function ($number1, $number2) {
    return $number1." + ".$number2." = ".($number1+$number2);
})->name("sum.numbers")->where("currency", "[0.1-9.9]+");

#10
Route::get('/arithmetic/{number1}/{number2}/{operator?}', function ($number1, $number2, $operator="+") {
    
    if($operator === "+")      { return $number1." + ".$number2." = ".($number1+$number2); }
    else if($operator === "-") { return $number1." - ".$number2." = ".($number1-$number2); }
    else if($operator === "*") { return $number1." x ".$number2." = ".($number1*$number2); }
    else if($operator === "div") { return $number1." / ".$number2." = ".($number1/$number2); }
    else if($operator === "^") { return $number1." ^ ".$number2." = ".($number1**$number2); }
    else { return "Operador inválido... [Soma(+), Subtração(-), Multiplicação(*), Divisão(div), Exponênciação(^)]"; }
    
})->name("arithmetic.numbers")->where("currency", "[0.1-9.9]+");