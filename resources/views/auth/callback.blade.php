@include('index')

<p>
    For login from postman or some frontend app use Bearer Token: {{ $sanctum }}
</p>

<p>
    For login reddit api use Bearer Token: {{ $reddit }}
</p>
