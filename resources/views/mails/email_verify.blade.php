<h1>
    {{ $mailData['title'] }}
</h1>
<a href="{{ route('verify.email', ['token' => $mailData['token']]) }}">{{ __('mail.verify') }}</a>
