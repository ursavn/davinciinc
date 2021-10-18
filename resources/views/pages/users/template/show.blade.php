@extends('layouts.app')

@section('content')
    <div class="template-detail full-width">
        <div class="form-group row template-detail__box">
            <div class="col-6 template-detail__form">
                <div id="formGenerate"></div>
            </div>
            <div class="col-6 template-detail__sample" id="template">
                {!! $template !!}
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
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
                result = '<input type="text" class="form-control col-5" name=" ' + field + ' " onkeyup="bindingTemplate(event)">';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-10" rows="4" name="' + field + '" onkeyup="bindingTemplate(event)"></textarea>';
                break;

            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<div class="form-check" onchange="bindingTemplate(event)">' +
                        '<input class="form-check-input" type="' + type + '" name="' + field + '" value="' + val + '">' +
                        '<label class="form-check-label">' + val  + '</label>' +
                        '</div>';

                    content += inner;
                })

                result = '<div class="group-radio">' + content + '</div>';
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
                result = '<input type="datetime-local" class="form-control col-8" name="' + field + '" onchange="bindingDateTime(event)" onkeyup="bindingDateTime(event)">';
                break;
        }

        return result;
    }
</script>
