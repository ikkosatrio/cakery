@extends('beautymail::templates.ark')
@section('content')
    @include('beautymail::templates.ark.heading', [
            'heading' => "Hallo, anda mendapat request consultation dari ".$consult->email,
            'level' => 'h2'
        ])
    @include('beautymail::templates.ark.contentStart')
    <p>{!! $pesan !!}</p>
    <table border="0">
        <tr>
            <td>Name </td>
            <td>:</td>
            <td>{{$consult->name}}</td>
        </tr>
        <tr>
            <td>Email </td>
            <td>:</td>
            <td>{{$consult->email}} </td>
        </tr>
        <tr>
            <td>Phone </td>
            <td>:</td>
            <td>{{$consult->phone}} </td>
        </tr>
        <tr>
            <td>Date Call </td>
            <td>:</td>
            <td>{{$consult->datecall}} </td>
        </tr>
        <tr>
            <td>Comment </td>
            <td>:</td>
            <td>{{$consult->comment}} </td>
        </tr>
    </table>
    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.contentStart')

    @include('beautymail::templates.ark.contentEnd')
@stop