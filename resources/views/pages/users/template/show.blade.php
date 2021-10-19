@extends('layouts.app')

@section('content')
    <div class="template-detail full-width">
        <div class="form-group row template-detail__box">
            <div class="col-6 template-detail__form">
                <form action="{{ route('create-template', $template->id) }}" id="formGenerate">
                    @csrf
                </form>
            </div>
            <div class="col-6 template-detail__sample" id="template">
                {!! $template->content !!}

                <div class="c-actions text-center mt-5">
                    <button type="button" class="btn btn-dark" onclick="createTemplate()">Create template</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<<<<<<< HEAD
=======
<style>
    .template-detail__form .custom-file-upload {
        background: #333333;
        padding: 8px 20px;
        color: #ffffff;
        margin-top: 10px;
    }
    .form-check {
        width: auto !important;
    }
</style>

>>>>>>> master
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
        let elements = $('#template')[0].firstElementChild.querySelectorAll(".js-data-bind");

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

    function getInputType(dataset) {
        let result;
        let type = dataset.type;
        let field = dataset.field;
        let label = dataset.label;
        let options = dataset.options;
        let content = '';

        switch (type) {
            case 'input':
<<<<<<< HEAD
                result = '<input type="text" class="form-control col-5" name=" ' + field + ' " onkeyup="bindingTemplate(event)">';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-10" rows="4" name="' + field + '" onkeyup="bindingTemplate(event)"></textarea>';
=======
                result = '<input type="text" class="form-control col-8" name="'+ label +'" data-id="'+ field +'" onkeyup="bindingTemplate(event)" required>';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-11" name="'+ label +'" data-id="'+ field +'" onkeyup="bindingTemplate(event)"></textarea>';
>>>>>>> master
                break;

            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
<<<<<<< HEAD
                    let inner = '<div class="form-check" onchange="bindingTemplate(event)">' +
                        '<input class="form-check-input" type="' + type + '" name="' + field + '" value="' + val + '">' +
                        '<label class="form-check-label">' + val  + '</label>' +
=======
                    let inner = '<div class="form-check mr-3" onchange="bindingTemplate(event)">' +
                        '<input class="form-check-input" type="'+ type +'" name="' + label + '" data-id="'+ field +'" value="'+ val +'">' +
                        '<label class="form-check-label">'+ val  +'</label>' +
>>>>>>> master
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

                result = '<select class="form-control col-8" name="'+ label +'" data-id="'+ field +'" onchange="bindingTemplate(event)">' + content + '</select>';
                break;

            case 'file':
                result = '<label class="custom-file-upload">' +
                    '<input type="hidden" name="'+ label +'" id="'+ field +'_form_img">' +
                    '<input type="file" class="form-control-file" data-id="'+ field +'" onchange="readURL(this)">' +
                    label +
                    '</label>';
                break;

            case 'datetime':
                result = '<div>' +
                            '<input type="hidden" name="'+ label +'" id="'+ field +'_form_date">' +
                            '<input type="datetime-local" class="form-control col-8" data-id="'+ field +'" onchange="bindingDateTime(event)" onkeyup="bindingDateTime(event)">' +
                        '</div>';
                break;
        }

        return result;
    }

    function bindingTemplate(event) {
        let dataId = event.target.getAttribute('data-id');
        let val = event.target.value;

        let element = $('[data-field = ' + dataId + ']');

        element[0].innerHTML = val;
    }

    function bindingDateTime(event) {
        let dataId = event.target.getAttribute('data-id');
        let val = event.target.value;

        val = moment(val).format('YYYY年MM月DD日HH時mm分');

        let element = $('[data-field = ' + dataId + ']');

        element[0].innerHTML = val;
        $('#' + dataId + '_form_date')[0].value = val;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            let dataId = input.getAttribute('data-id');
            var reader = new FileReader();

            reader.onload = function () {
                $('#' + dataId).attr('src', reader.result);
                $('#' + dataId + '_form_img')[0].value = '<img src="'+ reader.result +'" width="350px"/>';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
