<x-app>
    <p>Notifications</p>

    @foreach($notifications as $notification)
        <p style="color:forestgreen;" class="py-4">{{$notification->data['message']}}</p>
    @endforeach
</x-app>
