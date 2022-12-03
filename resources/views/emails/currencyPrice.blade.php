<h2>Hello {{$data['name']}},</h2>
<p>
<h3>The email is a sample email for Currency Price</h3>
<table>
    @foreach ($data["prices"] as $key=> $val)
    <tr>
        <td>{{$key}}</td>
        <td>{{isset($val["value"]) ? $val["value"] : '-'}}</td>
    </tr>
    @endforeach
</table>
</p>


Happy day!<br>

Thanks,<br>
{{ config('app.name') }}<br>