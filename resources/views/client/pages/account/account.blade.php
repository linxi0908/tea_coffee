@extends('client.layout.master')

@section('page_header')
@include('client.pages.account.page_header')
@endsection

@section('account')
@include('client.pages.account')
@endsection

@section('js-custom')
    <script>
        $('.nav a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var targetTab = $(e.target).attr('href');
        localStorage.setItem('currentTab', targetTab);
        });

        var currentTab = localStorage.getItem('currentTab');
        if (currentTab) {
        $('.nav a[href="' + currentTab + '"]').tab('show');
        }

        $('#logout-form').on('submit', function () {
        localStorage.removeItem('currentTab');
        });
    </script>
@endsection
