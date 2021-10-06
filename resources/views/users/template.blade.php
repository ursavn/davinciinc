@extends('layouts.app')

@section('content')
    create
    <div>
        <div class="form-group row">
            <div class="col-6">
                <form id="templateInfo"></form>
            </div>
            <div class="col-6" id="template">
                {!! $template !!}
            </div>
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
    img {
        width: 307px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'ru'
        });
    });
    $(window).on('load', function() {
        let elements = $('#meo')[0].querySelectorAll("div");

        for (let i = 0; i < elements.length ; i ++) {
            let dataset = elements[i].dataset;

            let label = '<label>' + dataset.label + '</label>';
            if (dataset.type === 'file') label = '';

            if (dataset.field && dataset.label && dataset.type) {
                let formDiv = '<div class="form-group">' +
                         label +
                         getInputType(dataset) +
                    '</div>';

                $('#templateInfo').append(formDiv);
            }
        }
    })

    function bindingTemplate(event) {
        let id = event.target.dataset.id;
        let val = event.target.value;

        console.log(event);

        $('#' + id)[0].innerHTML = val;
    }

    function readURL(input) {
        let id = input.getAttribute("data-id");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function () {
                $('#' + id)
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
        let id = dataset.id;
        let content = '';


        switch (type) {
            case 'input':
                result = '<input type="text" class="form-control col-8" name=" ' + field + ' " data-id="' + id + '" onkeyup="bindingTemplate(event)">';
                break;
            case 'textarea':
                result = '<textarea class="form-control col-11" data-id="' + id + '" name=" ' + field + ' " onkeyup="bindingTemplate(event)"></textarea>';
                break;
            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<div class="form-check mr-3" onchange="bindingTemplate(event)">' +
                            '<input class="form-check-input" type="' + type + '" name="' + field + '" value="' + val + '" data-id="' + id + '">' +
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

                result = '<select class="form-control col-8" data-id="' + id + '" name="' + field + '" onchange="bindingTemplate(event)">' + content + '</select>';

                break;
            case 'file':
                result = '<label class="custom-file-upload">' +
                            '<input type="file" class="form-control-file" data-id="' + id + '" onchange="readURL(this)">' +
                            label +
                        '</label>';
                break;

            case 'datetime':
                result = '<div class="col-sm-6">' +
                            '<div class="form-group">' +
                                '<div class="input-group date" id="datetimepicker2">' +
                                    '<input type="text" class="form-control" />' +
                                    '<span class="input-group-addon">' +
                                        '<span class="glyphicon glyphicon-calendar"></span>' +
                                    '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                break;
        }

        return result;
    }
</script>
