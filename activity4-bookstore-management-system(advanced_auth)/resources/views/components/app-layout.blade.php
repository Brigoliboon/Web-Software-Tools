<?php
    // This is a wrapper component that uses the main layouts/app.blade.php
    // It provides the slot content that layouts/app.blade.php expects
?>

@extends('layouts.app')

@section('content')
    {{ $slot }}
@endsection
