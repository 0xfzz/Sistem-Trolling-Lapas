@extends('layout')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.3/html5-qrcode.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-gradient-trolling text-white">
            <h3 class="card-title">Kontrol Scan</h3>
        </div>
        <div class="card-body">
            <div id="qr-reader" class="row justify-content-center">
                <div class="col-12 col-md-6 mb-3" style="max-width: 100%;"></div>
            </div>
            <div class="form-group mt-4">
                <label for="nama_lengkap">Nama Petugas</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
            </div>
            <form id="kontrol-form" class="mt-4" style="display: none;">
                @csrf
                <input type="hidden" name="qrdata_id" id="qrdata_id">
                <div id="location-heading" class="font-weight-bold mb-3"></div>
                <div class="form-group">
                    <label for="kondisi_sarpras">Keadaan</label>
                    <textarea class="form-control" name="kondisi_sarpras" id="kondisi_sarpras" rows="3"></textarea>
                </div>
                <div class="form-group mt-4">
                    <label for="jumlah_hunian">Jumlah WBP</label>
                    <input type="number" class="form-control" name="jumlah_hunian" id="jumlah_hunian" required>
                </div>
                <div class="form-group mt-4">
                    <label for="keterangan">Inforting</label>
                    <div id="keterangan" style="height: 250px"></div>
                </div>
                <div id="form-buttons" class="mt-4">
                    <button type="button" class="btn btn-primary" onclick="saveTemporaryData()">Lanjutkan</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        const html5QrCode = new Html5Qrcode("qr-reader");
        let temporaryData = [];
        const quill = new Quill('#keterangan', {
            theme: 'snow'
        });
        function onScanSuccess(decodedText, decodedResult) {
            html5QrCode.stop().then(() => {
                document.getElementById('qrdata_id').value = decodedText;
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
                keterangan: quill.getSemanticHTML()
            };
            temporaryData.push(formData);
            document.getElementById('kontrol-form').reset();
            quill.setContents([]);
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
