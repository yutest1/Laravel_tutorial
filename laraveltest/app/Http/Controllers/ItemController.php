<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request; //Request.phpに定義されているメソッドが使えるようになる
use Illuminate\Http\Response;

class ItemController extends Controller //定義したクラス名ItemControllerに、親クラスとして、Controllerクラスを継承している。Controllerクラスには、validate()やmiddleware()など便利なメソッドが定義
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request){
      $items = Item::orderBy('created_at', 'desc')->get();//降順でデータを取得

      return view('items.index', [
        'items' => $items
      ]);
    }
}