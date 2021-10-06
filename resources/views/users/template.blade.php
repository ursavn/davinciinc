@extends('layouts.app')

@section('content')
    <div class="form-group row">
        <div class="col-6">
            <div id="formGenerate"></div>
        </div>
        <div class="col-6" id="template">
            {!! $template !!}
        </div>
    </div>
@endsection

<style>
    .form-group {
        margin-bottom: 5px !important;
    }
    .form-group label {
        margin-bottom: 5px;
    }
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        background: #333333;
        padding: 8px 20px;
        color: #ffffff;
        margin-top: 10px;
    }
    .gj-modal .gj-picker-md {
        left: 434px !important;
        top: 121.5px !important;
        padding: 7px !important;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.ja-jp.js" type="text/javascript"></script>

<script>
    $(function () {
        $('#datetimepicker').datetimepicker({
            modal: true,
            footer: true,
            format: 'yyyy-dd-mm HH:MM',
            locale: 'ja-jp',
        });
    });

    $(window).on('load', function() {
        let elements = $('#template')[0].firstElementChild.querySelectorAll("div");

        for (let i = 0; i < elements.length ; i ++) {
            let dataset = elements[i].dataset;

            let label = '<label>' + dataset.label + '</label>';
            if (dataset.type === 'file') label = '';

            if (dataset.field && dataset.label && dataset.type) {
                let formDiv = '<div class="form-group">' +
                         label +
                         getInputType(dataset) +
                    '</div>';

                $('#formGenerate').append(formDiv);
            }
        }
    })

    function bindingTemplate(event) {
        let dataField = event.target.name;
        let val = event.target.value;

        let element = $('[data-field = ' + dataField + ']');

        element[0].innerHTML = val;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function () {
                $('#' + input.name)
                    .attr('src', reader.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function getInputType(dataset) {
        let result;
        let type = dataset.type;
        let field = dataset.field;
        let label = dataset.label;
        let options = dataset.options;
        let content = '';

        switch (type) {
            case 'input':
                result = '<input type="text" class="form-control col-8" name=" ' + field + ' " onkeyup="bindingTemplate(event)">';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-11" name="' + field + '" onkeyup="bindingTemplate(event)"></textarea>';
                break;

            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<div class="form-check mr-3" onchange="bindingTemplate(event)">' +
                            '<input class="form-check-input" type="' + type + '" name="' + field + '" value="' + val + '">' +
                            '<label class="form-check-label">' + val  + '</label>' +
                        '</div>';

                    content += inner;
                })

                result = '<div class="col-10 row">' + content + '</div>';
                break;

            case 'select':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<option value="' + val + '">' + val + '</option>';
                    content += inner;
                })

                result = '<select class="form-control col-8" name="' + field + '" onchange="bindingTemplate(event)">' + content + '</select>';
                break;

            case 'file':
                result = '<label class="custom-file-upload">' +
                            '<input type="file" class="form-control-file" name="' + field + '" onchange="readURL(this)">' +
                            label +
                        '</label>';
                break;

            case 'datetime':
                result = '<input type="datetime-local" class="form-control col-8" name="' + field + '">';
                break;
        }

        return result;
    }
</script>
