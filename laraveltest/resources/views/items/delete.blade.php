@extends('base')
@section('content')
  <div class="container">
    <h2 class="text-center">データ削除</h2>
    <p>このデータを削除します。よろしいですか？</p>

    <form action="{{ route('destroy', ['item' => $item]) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }} <!--POSTであるリクエストをDELETEとして処理-->
      <div class="row">
        <div class="col-12">
          <div class="float-right">
            <a class="btn btn-outline-secondary" href="{{ route('index') }}">戻る</a>
            <input type="submit" class="btn btn-outline-secondary" value="削除" />
          </div>
        </div>
      </div>

      @include('items.card') <!--card.blade.phpが展開-->

      <div class="row">
        <div class="col-12">
          <div class="float-right">
            <a class="btn btn-outline-secondary" href="{{ route('index') }}">戻る</a>
            <input type="submit" class="btn btn-outline-secondary" value="削除" />
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection