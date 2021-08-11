@extends('beautymail::templates.ark')
@section('content')
    @include('beautymail::templates.ark.heading', [
            'heading' => 'Hallo',
            'level' => 'h1'
        ])
    @include('beautymail::templates.ark.contentStart')
    <p>{!! $pesan !!}</p>
    @include('beautymail::templates.minty.button', ['text' => 'Confirm', 'link' => $link])
    <span>{!! $link !!}</span>
    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.contentStart')

    @include('beautymail::templates.ark.contentEnd')
@stop