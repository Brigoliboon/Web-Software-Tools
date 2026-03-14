<?php
    // Guest layout component - wraps the guest.blade.php layout
?>

@extends('layouts.guest')

@section('content')
    {{ $slot }}
@endsection
