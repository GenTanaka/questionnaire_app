@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center">{{ $questionnaire[0]['title'] }}</h2>
    <div class="col-md-6 mx-auto">
        <div class="bg-white mt-5">
            <h3 class="my-3">{{ $questionnaire[0]['question1'] }}</h3>
            @if (empty($answers[0]))
                <p>回答がありません</p>
            @else
                <ul class="mt-3">
                        @foreach ($answers as $answer)
                            <li class="mt-2">{!! $answer['answer1'] !!}</li>
                        @endforeach
                    </ul>
            @endif
        </div>
        <div class="bg-white my-5">
            <h3 class="my-3">{{ $questionnaire[0]['question2'] }}</h3>
            @if (empty($answers[0]))
                <p>回答がありません</p>
            @else
                <ul>
                        @foreach ($answers as $answer)
                            <li class="mt-2">{!! $answer['answer2'] !!}</li>
                        @endforeach
                    </ul>
            @endif
        </div>
        <a class="btn border" onClick="history.back()">戻る</a>
    </div>
</div>
@endsection
