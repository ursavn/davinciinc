@extends('layouts.app')

@section('content')
    <div class="template-detail full-width">
        <div class="form-group row template-detail__box">
            <div class="col-xl-6 template-detail__form">
                <form action="{{ route('create-template', $template->id) }}" id="formGenerate">
                </form>
            </div>
            <div class="col-xl-6 template-detail__sample">
                <div class="template-content__wrapper" id="template">
                    {!! $template->content !!}
                </div>
                <div class="c-actions text-center mt-5">
                    <button type="button" class="btn btn-dark" onclick="createTemplate()">このデザインで作成</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let data = {};

    function createTemplate() {
        $.ajax({
            type: "POST",
            url: $('#formGenerate').attr('action'),
            data: {
                "_token": "{{ csrf_token() }}",
                "content": data,
                "html_url": '{{ $template->url }}',
            },
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.status === 200) {
                let action = '{{ url('templates/download') }}' + '/' + data.id;
                window.location.replace(action);
            } else if (data.status === 500) {
                alert(data.message);
            }
        })

            event.preventDefault();
        }

    function postRedirect(content) {
        let mapForm = document.createElement("form");
        mapForm.action = '{{ url('templates/download') }}';
        mapForm.method = "POST";

        let mapToken = document.createElement("input");
        mapToken.type = "hidden";
        mapToken.name = "_token";
        mapToken.value = '{{ csrf_token() }}';
        mapForm.appendChild(mapToken);

        let mapHtmlUrl = document.createElement("input");
        mapHtmlUrl.type = "hidden";
        mapHtmlUrl.name = "html_url";
        mapHtmlUrl.value = '{{ $template->url }}';
        mapForm.appendChild(mapHtmlUrl);

        let mapContent = document.createElement("input");
        mapContent.type = "hidden";
        mapContent.name = "content";
        mapContent.value = content
        mapForm.appendChild(mapContent);

        document.body.appendChild(mapForm);

        console.log(mapForm);

        mapForm.submit();
    }

    $(window).on('load', function() {
        let elements = $('#template')[0].firstElementChild.querySelectorAll(".js-data-bind");

        for (let i = 0; i < elements.length ; i ++) {
            let dataset = elements[i].dataset;

            let label = '<label>' + dataset.label + '</label>';
            if (dataset.type === 'file') label = '';

            if (dataset.field && dataset.label && dataset.type) {
                let formDiv = '<div class="form-group">' + label + getInputType(dataset) + '</div>';

                $('#formGenerate').append(formDiv);

                data[dataset.field] = {
                    value: '',
                    label: dataset.label,
                    type: dataset.type,
                }
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
                result = '<input type="text" class="form-control col-5" name="'+ field +'" onkeyup="bindingTemplate(event)">';
                break;

            case 'textarea':
                result = '<textarea class="form-control col-10" rows="3" name="'+ field +'" onkeyup="bindingTemplate(event)"></textarea>';
                break;

            case 'radio':
            case 'checkbox':
                var optionsArr = options.split(',');

                optionsArr.forEach(function(val) {
                    let inner = '<div class="form-check" onchange="bindingTemplate(event)">' +
                    '<input class="form-check-input" type="'+ type +'" name="' + field + '" value="'+ val +'">' +
                        '<label class="form-check-label">'+ val +'</label>' +
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

                result = '<select class="form-control col-8" name="'+ field +'" onchange="bindingTemplate(event)">' + content + '</select>';
                break;

            case 'file':
                result = '<label class="custom-file-upload">' +
                    '<input type="file" class="form-control-file" name="'+ field +'" onchange="readURL(this)">' +
                    label +
                    '</label>';
                break;

            case 'datetime':
                result = '<div>' +
                    '<input type="datetime-local" class="form-control col-8" name="'+ field +'" onchange="bindingDateTime(event)">' +
                    '</div>';
                break;
            }

        return result;
    }

    function bindingTemplate(event) {
        let name = event.target.name;
        let value = event.target.value;

        let element = $('[data-field = ' + name + ']');

        element[0].innerHTML = value;

        setDataValue(name, value);
    }

    function bindingDateTime(event) {
        let name = event.target.name;
        let val = event.target.value;

        let valFormat = '';
        valFormat += moment(val).format('YYYY') + '<span>年</span>';
        valFormat += moment(val).format('MM') + '<span>月</span>';
        valFormat += moment(val).format('DD') + '<span>日</span>';
        valFormat += moment(val).format('HH') + '<span>時</span>';
        valFormat += moment(val).format('mm') + '<span>分頃</span>';

        let element = $('[data-field = ' + name + ']');

        element[0].innerHTML = valFormat;

        setDataValue(name, valFormat);
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            let name = input.name;

            var reader = new FileReader();

            reader.onload = function () {
                $('#' + name)[0].style.backgroundImage = 'url('+ reader.result +')';

                setDataValue(name, reader.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function setDataValue(name, value) {
        data[name].value = value
    }
</script>
@endpush
