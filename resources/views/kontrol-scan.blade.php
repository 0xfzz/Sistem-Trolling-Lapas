@extends('layout')

@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.3/html5-qrcode.min.js"></script>
@endsection

@section('content')
    <div class="container mt-5">
        <div id="qr-reader" class="row justify-content-center">
            <div class="col-12 col-md-6 mb-3" style="max-width: 100%;"></div>
        </div>
        <div id="qr-reader-results" class="alert alert-info text-center"></div>
        <div class="form-group">
            <label for="nama_lengkap">Nama</label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
        </div>
        <form id="kontrol-form" style="display: none;">
            @csrf
            <input type="hidden" name="qrdata_id" id="qrdata_id">
            <div id="location-heading" class="font-weight-bold mb-3"></div>
            <div class="form-group">
                <label for="kondisi_sarpras">Kondisi Sarpras:</label>
                <input type="text" class="form-control" name="kondisi_sarpras" id="kondisi_sarpras" required>
            </div>
            <div class="form-group">
                <label for="jumlah_hunian">Jumlah Hunian:</label>
                <input type="number" class="form-control" name="jumlah_hunian" id="jumlah_hunian" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input type="text" class="form-control" name="keterangan" id="keterangan">
            </div>
            <div id="form-buttons">
                <button type="button" class="btn btn-primary" onclick="saveTemporaryData()">Lanjutkan</button>
                <button type="button" class="btn btn-success" onclick="submitForm()">Selesai</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const html5QrCode = new Html5Qrcode("qr-reader");
        let temporaryData = [];

        function onScanSuccess(decodedText, decodedResult) {
            html5QrCode.stop().then(() => {
                document.getElementById('qrdata_id').value = decodedText;
                document.getElementById('qr-reader-results').innerText = `QR Code scanned: ${decodedText}`;
                fetchLocation(decodedText);
                document.getElementById('qr-reader').style.display = 'none';
                document.getElementById('kontrol-form').style.display = 'block';
            }).catch(err => {
                console.error('Failed to stop QR code scanner:', err);
            });
        }

        function fetchLocation(id) {
            fetch(`/qr/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('location-heading').innerText = `Lokasi: ${data.lokasi}`;
                })
                .catch(error => console.error('Error fetching location:', error));
        }

        function saveTemporaryData() {
            const formData = {
                qrdata_id: document.getElementById('qrdata_id').value,
                kondisi_sarpras: document.getElementById('kondisi_sarpras').value,
                jumlah_hunian: document.getElementById('jumlah_hunian').value,
                keterangan: document.getElementById('keterangan').value
            };
            temporaryData.push(formData);
            document.getElementById('kontrol-form').reset();
            document.getElementById('kontrol-form').style.display = 'none';
            document.getElementById('qr-reader').style.display = 'block';
            console.log('Temporary data:', temporaryData);
            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: 250
                },
                onScanSuccess
            );
        }

        function submitForm() {
            saveTemporaryData();
            fetch("{{ route('kontrol-store') }}", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    nama_lengkap: document.getElementById('nama_lengkap').value,
                    reports: temporaryData,

                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                alert('Berhasil Terkirim');
                window.location = "{{ route('home') }}";
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        );
    </script>
@endsection
