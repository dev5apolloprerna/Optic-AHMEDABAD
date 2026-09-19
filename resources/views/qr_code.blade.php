@extends('layouts.front')

@section('content')

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    $qrText =
        $data->companyName . '~' .
        $data->name . '~' .
        $data->mobile . '~' .
        $data->city . '~' .
        date('d-m-Y', strtotime($data->strEntryDate)) . '~' .
        date('d-m-Y', strtotime($data->visitDate));
@endphp

<style>
    .tq-head {
        padding: 15px 0;
        background: #b9272a;
        color: #fff;
        font-size: 28px;
        text-align: center;
        margin-bottom: 20px;
    }

    .qr-instruction {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .qr-container {
        position: relative;
        display: inline-block;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
    }

    .qr-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 6px 12px;
        font-weight: 700;
        font-size: 16px;
        color: #b9272a;
        border-radius: 4px;
        pointer-events: none;
        white-space: nowrap;
    }

    .download-btn {
        margin-top: 20px;
        padding: 10px 25px;
        background: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    .qr-batch-title {
    font-size: 22px;
    font-weight: 700;
    color: #b9272a;
    margin-bottom: 10px;
    text-align: center;
}


        .floating-book{
            display:none;
        }
        
        .button-group{
            display:none;
        }
   
</style>

<section class="section-pad">
    <h1 class="tq-head">Thank You For Spot Registration</h1>

    <center>
        <h4 class="qr-instruction">
            इस QR Code को Registration Counter पर Scan करवाएं<br>
            આ QR Code ને Registration Counter પર Scan કરાવો
        </h4>

        <!-- QR -->
        <!--<h3 class="qr-batch-title">Autoshow 2026</h3>-->

        <div id="qrWrapper">
    {!! QrCode::size(300)
        ->margin(2)
        ->errorCorrection('H')  {{-- VERY IMPORTANT --}}
        ->generate($qrText) !!}
</div>

        <!--<br>-->

        <button class="download-btn mb-3" onclick="downloadQR()">
            ⬇ Download QR Code
        </button>
    </center>
</section>

<script>
// function downloadQR() {
//     const originalSvg = document.querySelector('#qrWrapper svg');
//     if (!originalSvg) return;

//     const size = 300;
//     const center = size / 2;

//     // Clone original QR
//     const qrClone = originalSvg.cloneNode(true);

//     // Force QR to be centered
//     qrClone.setAttribute('x', 0);
//     qrClone.setAttribute('y', 0);
//     qrClone.setAttribute('width', size);
//     qrClone.setAttribute('height', size);

//     // Create OUTER SVG (canvas)
//     const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
//     svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
//     svg.setAttribute('width', size);
//     svg.setAttribute('height', size);
//     svg.setAttribute('viewBox', `0 0 ${size} ${size}`);

//     // White background
//     const bg = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
//     bg.setAttribute('width', size);
//     bg.setAttribute('height', size);
//     bg.setAttribute('fill', '#ffffff');

//     // Safe center label background
//     const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
//     rect.setAttribute('x', center - 45);
//     rect.setAttribute('y', center - 15);
//     rect.setAttribute('width', 90);
//     rect.setAttribute('height', 30);
//     rect.setAttribute('fill', '#ffffff');

//     // Center text
//     const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
//     text.setAttribute('x', center);
//     text.setAttribute('y', center + 6);
//     text.setAttribute('text-anchor', 'middle');
//     text.setAttribute('font-size', '12');
//     text.setAttribute('font-weight', 'bold');
//     text.setAttribute('fill', '#000');
//     text.textContent = 'Autoshow 2026';

//     // Assemble SVG
//     svg.appendChild(bg);
//     svg.appendChild(qrClone);
//     svg.appendChild(rect);
//     svg.appendChild(text);

//     // Download
//     const serializer = new XMLSerializer();
//     const svgData = serializer.serializeToString(svg);

//     const blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
//     const url = URL.createObjectURL(blob);

//     const a = document.createElement('a');
//     a.href = url;
//     a.download = 'Autoshow_2026.svg';
//     document.body.appendChild(a);
//     a.click();
//     document.body.removeChild(a);

//     URL.revokeObjectURL(url);
// }
</script>


<script>
    function downloadQR() {
        const originalSvg = document.querySelector('#qrWrapper svg');
        if (!originalSvg) return;

        const qrSize = 300;
        const padding = 30;
        const textHeight = 40;
        const canvasSize = qrSize + padding * 2 + textHeight;

        // Serialize SVG
        const serializer = new XMLSerializer();
        const svgStr = serializer.serializeToString(originalSvg);

        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            canvas.width = canvasSize;
            canvas.height = canvasSize;

            const ctx = canvas.getContext('2d');

            // White background
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Draw QR (centered)
            ctx.drawImage(
                img,
                padding,
                padding,
                qrSize,
                qrSize
            );

            // Text BELOW QR (SAFE)
            ctx.font = 'bold 18px Arial';
            ctx.fillStyle = '#000';
            ctx.textAlign = 'center';
            ctx.fillText(
                'Electric Expo  2026',
                canvas.width / 2,
                qrSize + padding + 30
            );

            // Download JPG
            const jpgUrl = canvas.toDataURL('image/jpeg', 1.0);
            const a = document.createElement('a');
            a.href = jpgUrl;
            a.download = 'Electric_Expo_2026.jpg';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        };

        img.src =
            'data:image/svg+xml;base64,' +
            btoa(unescape(encodeURIComponent(svgStr)));
    }
</script>

@endsection
