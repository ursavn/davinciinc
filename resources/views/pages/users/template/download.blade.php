
@extends('layouts.app')

@section('content')
    <div class="form-group row">
        <div class="">
            <div id="template">
                {!! $html !!}
            </div>
            <div class="c-actions text-center mt-4">
                <button type="button" class="btn btn-dark" onclick="exportPdf()">Download Pdf</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function exportPdf() {
            var element = document.getElementById('template');

            var opt = {
                filename: 'myfile.pdf',
                html2canvas: {
                    scale: 2,
                    scrollY: 0,
                    scrollX: -10,
                },
                jsPDF: {
                    unit: 'px',
                    format: [element.scrollWidth, element.scrollHeight],
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save();
        }

        $(window).on('load', function() {
            let value = '<?php echo "$content"; ?>';

            let data = JSON.parse("[" + value + "]");

            const keys = Object.keys(data[0]);

            keys.forEach((key) => {
                let element = $('[data-field = ' + key + ']');
                let value = data[0][key]['value'] !== null ? data[0][key]['value'] : '';

                if (data[0][key]['type'] === 'file') {
                    $('#' + key)[0].style.backgroundImage = 'url('+ value +')';
                } else {
                    element[0].innerHTML = value;
                }
            });
        })
    </script>
@endpush
