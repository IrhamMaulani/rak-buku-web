@extends('template.master')

@section('title', 'Index')


@php
    $nama = 'coba skysad fas';
    $coba = 'hehehe';
    $shit = $nama . $coba;
    echo str_slug($shit, '-');
@endphp
