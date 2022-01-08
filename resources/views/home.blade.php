@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-md-flex justify-content-around">
        <div class="col-md-6">
            <h2 class="text-center">作成済みアンケート</h2>
            <div class="col-md-10 mx-auto">
                @foreach ($myQuestionnaires as $questionnaire)
                <div class="mt-3 border bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="d-block m-0 ps-3 py-3 flex-fill fs-5">
                            {{$questionnaire['title']}}
                        </h3>
                        <div class="answers-contents border-start text-center">
                            <a href="{{ route('questionnaire', ['id' => $questionnaire['id']]) }}" class="d-block border-bottom px-3">回答一覧</a>
                            <a href="{{ route('edit', ['id' => $questionnaire['id']]) }}" class="d-block px-3">編集</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pagenation mt-3">
                    {{ $myQuestionnaires->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">アンケート一覧</h2>
            <div class="col-md-10 mx-auto">
                @foreach ($questionnaires as $questionnaire)
                <div class="mt-3 border bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="d-block m-0 flex-fill fs-5 py-3 ps-3">
                            {{$questionnaire['title']}}
                        </h3>
                        <div class="answers-contents border-start">
                            <a href="{{ route('answer', ['id' => $questionnaire['id']]) }}" class="d-block px-3">回答する</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="pagenation mt-3">
                    {{ $questionnaires->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
