@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center">{{ $questionnaire[0]['title'] }}</h2>
    <div class="col-md-6 mx-auto mt-4">
        <form action="{{ route('saveAnswer') }}" method="post">
            @csrf
            <input type="hidden" name="questionnaire_id" value="{{ $questionnaire[0]['id'] }}">
            <label class="mt-3 fs-5" for="answer1" class="form-label">{{ $questionnaire[0]['question1'] }}</label>
            <textarea rows="3" name="answer1" class="form-control" id="answer1" placeholder="回答を入力">{{ old('answer1') }}</textarea>
            @error('answer1')
            <div class="alert alert-danger py-1 mb-0 mt-2">回答を入力してください</div>
            @enderror
            <label class="mt-3 fs-5" for="answer2" class="form-label">{{ $questionnaire[0]['question2'] }}</label>
            <textarea rows="3" name="answer2" type="text" class="form-control" id="answer2" placeholder="回答を入力">{{ old('answer2') }}</textarea>
            @error('answer2')
            <div class="alert alert-danger py-1 mb-0 mt-2">回答を入力してください</div>
            @enderror
            <div class="button d-flex justify-content-between mt-5">
                <a class="btn border" onClick="history.back()">戻る</a>
                <input class="btn btn-primary" type="submit" value="回答">
            </div>
        </form>
    </div>
</div>
@endsection
