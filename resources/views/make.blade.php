@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center">アンケート作成</h2>
    <div class="col-md-6 mx-auto mt-4">
        <form action="{{ route('makedQuestionnaire') }}" method="post">
            @csrf
            <label class="fs-4" for="title" class="form-label">タイトル</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="アンケートのタイトルを入力" value="{{ old('title') }}">
            @error('title')
            <div class="alert alert-danger py-1 mb-0 mt-2">タイトルを入力してください</div>
            @enderror
            <label class="mt-3 fs-4" for="question1" class="form-label">質問1</label>
            <input name="question1" type="text" class="form-control" id="question1" placeholder="質問1の内容を入力" value="{{ old('question1') }}">
            @error('question1')
            <div class="alert alert-danger py-1 mb-0 mt-2">質問1を入力してください</div>
            @enderror
            <label class="mt-3 fs-4" for="question2" class="form-label">質問2</label>
            <input name="question2" type="text" class="form-control" id="question2" placeholder="質問2の内容を入力" value="{{ old('question2') }}">
            @error('question2')
            <div class="alert alert-danger py-1 mb-0 mt-2">質問2を入力してください</div>
            @enderror
            <div class="button d-flex justify-content-between mt-5">
                <a class="btn border" onClick="history.back()">戻る</a>
                <input class="btn btn-primary" type="submit" value="作成">
            </div>
        </form>
    </div>
</div>
@endsection
