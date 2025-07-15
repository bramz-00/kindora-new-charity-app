<h1>QR Code de la demande</h1>

<p>ID : {{ $proposal->id }}</p>
<p>UUID : {{ $proposal->req_uuid }}</p>

{{-- Affiche le QR code comme image SVG --}}
<div>
    {!! $proposal->qr_code_svg !!}
</div>