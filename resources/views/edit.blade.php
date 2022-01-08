@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center">アンケート編集</h2>
    <div class="col-md-6 mx-auto mt-4">
        <form action="{{ route('saveEdit') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $questionnaire[0]['id'] }}">
            <label class="fs-4" for="title" class="form-label">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="アンケートのタイトルを入力" value="{{ $questionnaire[0]['title'] }}">
            @error('title')
            <div class="alert alert-danger py-1 mb-0 mt-2">タイトルを入力してください</div>
            @enderror
            <label class="mt-3 fs-4" for="question1" class="form-label">質問1</label>
            <input name="question1" type="text" class="form-control" id="question1" placeholder="質問1の内容を入力" value="{{ $questionnaire[0]['question1'] }}">
            @error('question1')
            <div class="alert alert-danger py-1 mb-0 mt-2">質問1を入力してください</div>
            @enderror
            <label class="mt-3 fs-4" for="question2" class="form-label">質問2</label>
            <input name="question2" type="text" class="form-control" id="question2" placeholder="質問2の内容を入力" value="{{ $questionnaire[0]['question2'] }}">
            @error('question2')
            <div class="alert alert-danger py-1 mb-0 mt-2">質問2を入力してください</div>
            @enderror
            <div class="form-check form-switch mt-4">
                <input type="checkbox" name="is_delete_answers" id="is_delete" class="form-check-input">
                <label for="is_delete" class="form-check-label">回答を全てリセット</label>
            </div>
            <div class="form-check form-switch mt-4">
                <input type="checkbox" name="is_release" id="is_release" class="form-check-input" {{ $questionnaire[0]['is_release'] == 1 ? "checked" : "" }}>
                <label for="is_release" class="form-check-label">アンケートを公開</label>
            </div>
            <div class="button d-flex justify-content-between mt-5">
                <a class="btn border" onClick="history.back()">戻る</a>
                <input class="btn btn-primary" type="submit" value="完了">
            </div>
        </form>
    </div>
</div>
@endsection
