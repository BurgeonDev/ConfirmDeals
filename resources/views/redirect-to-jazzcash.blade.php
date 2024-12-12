{{-- ... --}}

@php
    $jazzcash_environment = config('jazzcash.environment');
@endphp
<form name="redirect-to-payment-gateway" method="POST" action="{{ config("jazzcash.$jazzcash_environment.endpoint") }}">
    @csrf
    @foreach ($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>
<script>
    setTimeout(function() {
        document.forms['redirect-to-payment-gateway'].submit();
    }, 100000);
</script>

{{-- ... --}}
