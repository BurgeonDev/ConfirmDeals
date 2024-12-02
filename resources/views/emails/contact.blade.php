<x-mail::message>

    <h3>Name:{{ $data['name'] }}</h3>
    <h3>Email:{{ $data['email'] }}</h3>
    <h3>Message:{{ $data['message'] }}</h3>
    <x-mail::button :url="''">
        Back To Confirm Deals
    </x-mail::button>


    {{ config('app.name') }}
</x-mail::message>
