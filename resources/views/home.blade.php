@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center">アンケート一覧</h2>
    <div class="col-md-6 mx-auto">
        @foreach ($questionnaires as $questionnaire)
            <div class="mt-3 border bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="d-block m-0 ps-3 flex-fill fs-5">
                        {{$questionnaire['title']}}
                    </h3>
                    <div class="answers-contents border-start">
                        <a href="{{ route('questionnaire', ['id' => $questionnaire['id']]) }}" class="d-block border-bottom px-3">回答一覧</a>
                        <a href="#" class="d-block px-3">回答する</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pagenation mt-3">
            {{ $questionnaires->links() }}
        </div>
    </div>
</div>
@endsection
