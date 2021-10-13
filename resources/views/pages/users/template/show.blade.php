@extends('layouts.app')

@section('content')
    <div class="template-detail">
        <div class="form-group row template-detail__box">
            <div class="col-6 template-detail__form">
                <form action="{{ route('templates.create') }}" id="formGenerate">
                    @csrf
                </form>
            </div>
            <div class="col-6 template-detail__sample" id="template">
                {!! $template !!}

                <button type="button" class="btn btn-success" onclick="createTemplate()">Save</button>
            </div>
        </div>
    </div>
@endsection

<style>
    .template-detail__form .custom-file-upload {
        background: #333333;
        padding: 8px 20px;
        color: #ffffff;
        margin-top: 10px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    function createTemplate() {
        console.log($('#formGenerate').serialize());
        $.ajax({
            type: "POST",
            url: $('#formGenerate').attr('action'),
            data: $('#formGenerate').serialize(),
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.status === 200) {
            } else if (data.status === 422) {
            }
        })

        event.preventDefault();
    }

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

    function bindingDateTime(event) {
        let dataField = event.target.name;
        let val = event.target.value;

        val = moment(val).format('YYYY年MM月DD日HH時mm分');

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
                result = '<input type="text" class="form-control col-8" name=" ' + label + ' " onkeyup="bindingTemplate(event)" required>';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-11" name="' + label + '" onkeyup="bindingTemplate(event)"></textarea>';
                break;

            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<div class="form-check mr-3" onchange="bindingTemplate(event)">' +
                        '<input class="form-check-input" type="' + type + '" name="' + label + '" value="' + val + '">' +
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

                result = '<select class="form-control col-8" name="' + label + '" onchange="bindingTemplate(event)">' + content + '</select>';
                break;

            case 'file':
                result = '<label class="custom-file-upload">' +
                    '<input type="file" class="form-control-file" name="' + label + '" onchange="readURL(this)">' +
                    label +
                    '</label>';
                break;

            case 'datetime':
                result = '<input type="datetime-local" class="form-control col-8" name="' + label + '" onchange="bindingDateTime(event)" onkeyup="bindingDateTime(event)">';
                break;
        }

        return result;
    }
</script>
