<p>New message from blog57.2kmonde.test</p>

<p>Details</p>

<ul>
    <li>Name: <strong>{{ $data['name'] }}</strong></li>
    <li>Email: <strong>{{ $data['email'] }}</strong></li>
    <li>Phone: <strong>{{ $data['phone'] }}</strong></li>
</ul>

<hr>

<p>
    @foreach($data['messageLines'] as $messageLine)
        {{ $messageLine }}<br>
    @endforeach
</p>

<hr>
