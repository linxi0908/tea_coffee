@extends('client.layout.master')

@section('page_header')
@include('client.pages.checkout.page_header')
@endsection

@section('cart')
@include('client.pages.checkout')
@endsection

