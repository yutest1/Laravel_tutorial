<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request; //Request.phpに定義されているメソッドが使えるようになる
use Illuminate\Http\Response;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller //定義したクラス名ItemControllerに、親クラスとして、Controllerクラスを継承している。Controllerクラスには、validate()やmiddleware()など便利なメソッドが定義
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request){
      
      $query = Item::query(); //Itemモデルのクエリビルダが$queryに代入

        if(isset($request->name)){
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        if(isset($request->sex)){
            $query->where('sex', $request->sex);
        }

        if(isset($request->memo)){
            $query->where('memo', 'like', '%'.$request->memo.'%');
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(3)->appends($request->all());; //降順でデータを取得

        return view('items.index', [
            'items' => $items
        ]);
    }

    public function create(Request $request){
      return view('items.create');
  }

  public function store(ItemRequest $request){
    $item = new Item();
    $item->name = $request->name;
    $item->age = $request->age;
    $item->sex = $request->sex;
    $item->memo = $request->memo;
    $item->save();
    return redirect()->action('ItemController@index');
  }

  public function show(string $id){
    $item = Item::findOrFail($id);

    return view('items.show')->with('item', $item);
  }
//編集画面
  public function edit(String $id){
    return view('items.edit')->with('item', Item::findOrFail($id));
  }
//編集処理
  public function update(ItemRequest $request, string $id){
    $item = Item::findOrFail($id);
    $item->fill($request->all())->save();
    return redirect()->route('index');
}

//削除画面
public function delete(Item $item){
  return view('items.delete')->with('item', $item);



}
//削除処理
public function destroy(Item $item){
  $item->delete();
  return redirect()->route('index');
}

}