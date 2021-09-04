@extends('beautymail::templates.ark')
@section('content')
    @include('beautymail::templates.ark.heading', [
            'heading' => "Hallo, anda telah mendaftar dengan email ".$data->email,
            'level' => 'h2'
        ])
    @include('beautymail::templates.ark.contentStart')
    <p>{!! $pesan !!}</p>
    <table border="0">
        <tr>
            <td>Name </td>
            <td>:</td>
            <td>{{$data->name}}</td>
        </tr>
        <tr>
            <td>Email </td>
            <td>:</td>
            <td>{{$data->email}} </td>
        </tr>
        <tr>
            <td>Phone </td>
            <td>:</td>
            <td>{{$data->phone}} </td>
        </tr>
        <tr>
            <td>Token </td>
            <td>:</td>
            <td>{{$data->token_email}} </td>
        </tr>
        <tr>
			<td>
				@include('beautymail::templates.minty.button', ['text' => 'Confirm', 'link' => {{$data->LinkConfirm}}])
			</td>
		</tr>
    </table>
    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.contentStart')

    @include('beautymail::templates.ark.contentEnd')
@stop
