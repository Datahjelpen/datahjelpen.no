@extends('partials.master')

@section('content-main')
	<section class="page-section">
		<div class="inner-wrapper">
			<h1 class="page-title">Innstillinger</h1>
			<p><a href="{{ route('user.settings.security') }}">Sikkerhet</a></p>
			<p><a href="{{ route('user.edit') }}">Endre konto</a></p>
			<p><a href="{{ route('user.delete') }}">Slett konto</a></p>
		</div>
	</section>
@endsection
