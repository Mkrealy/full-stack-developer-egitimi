@extends('layouts.admin')

@section('title')
    Makale Ekleme
@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/backEnd/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">

    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backEnd/libs/ckeditor/samples/css/samples.css') }}">--}}
    <style>
        .tags:focus {
            border: none !important;
            box-shadow: unset !important;
        }

        .tags-input-div {
            border: none;
            border-bottom: 1px solid #9e9e9e;
            box-shadow: none;
            margin: 0 0 8px 0;
            min-height: 45px;
            outline: none;
            transition: all .3s;
        }

        .tags-input-field {
            position: relative !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .tags-input-div .tags {
            background: none;
            border: 0 !important;
            color: rgba(0, 0, 0, 0.6);
            display: inline-block;
            font-size: 16px;
            height: 3rem;
            line-height: 32px;
            outline: 0;
            margin: 0;
            padding: 0 !important;
            width: 120px !important;
        }

        .tags-list {
            cursor: pointer;
            display: block;
            opacity: 1;
            transform: scaleX(1) scaleY(1);
            width: 100%;
            left: 0;
            top: 0;
            height: 50px;
            transform-origin: 0 0;
        }

        .tags-list-absolute {
            background-color: #fff;
            margin: 0;
            min-width: 100px;
            overflow-y: auto;
            opacity: 1;
            position: absolute;
            left: 0;
            top: 55px !important;
            z-index: 9999;
            transform-origin: 0 0;
        }

        .tags-list-item {
            clear: both;
            color: rgba(0, 0, 0, 0.87);
            cursor: pointer;
            min-height: 50px;
            line-height: 1.5rem;
            width: max-content;
            text-align: left;
            display: inline-block;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.07), 0 3px 1px -2px rgba(0, 0, 0, 0.02), 0 1px 5px 0 rgba(0, 0, 0, 0.02);
        }

        .tags-list-item:hover {
            background-color: #eeeeee;
        }

        .tags-list-item span {
            font-size: 16px;
            color: #5e35b1;
            display: inline-block;
            line-height: 22px;
            padding: 14px 16px;
        }

        .tags-margin {
            margin-top: 0;
            margin-bottom: 0;
        }

        .tags-select-item {
            display: inline-block;
            height: 32px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.6);
            line-height: 32px;
            padding: 0 12px;
            border-radius: 16px;
            background-color: #e4e4e4;
            margin-bottom: 5px;
            margin-right: 5px;
        }

        div.tags-input-div:focus-within {
            border-bottom: 10px solid #5e35b1 !important;
        }
    </style>

@endsection
@section('content')
    <div class="row" id="newPost">
        <div class="col s12 ">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title activator">Makale Ekle<i class="material-icons right tooltipped"
                                                                   data-position="left" data-delay="50"
                                                                   data-tooltip="Get Code">more_vert</i></h5>
                    <form id="frm-post" action="{{route('post.store')}}" method="post">
                        @csrf
                        {{--name--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="name" name="name" type="text">
                                <label for="name">Name</label>
                            </div>
                        </div>
                        {{--kategori adı--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">clear_all</i>
                                <select name="category_id">
                                    <option value="" disabled selected>Lütfen Seçim Yapın</option>
                                    @foreach($category as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <label>Kategori Adı</label>
                            </div>
                        </div>

                        {{--makale  adı--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">assignment</i>
                                <input id="post-name" name="title" type="text">
                                <label for="post-name">Makale Adı</label>
                            </div>
                        </div>
                        {{--chips--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="tags-input-div tags-input-field">
                                    <input type="text" name="tagName" class="tags input" id="tags_id"
                                           placeholder="Etiket Giriniz">
                                    <ul class="tags-list tags-list-absolute tags-margin">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{--ckeditör--}}
                        <div class="row">
                            <div class="row">
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Ekle</h4>
                                            <div id="editor">
                                                 <textarea name="text" cols="50" rows="15" class="ckeditor"
                                                           id="post-content">
                                                 </textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--status--}}
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="switch">
                                    <label for="statusEdit">
                                        Pasif
                                        <input name="status" id="statusEdit" type="checkbox">
                                        <span class="lever"></span>
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <h5>Yayınlanma Tarihi Seç</h5>
                                <input id="publish_date" type="datetime-local" placeholder="Yayınlanma tarihi seç"
                                       class="post-date" name="publish_date">
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label for="publishNow">
                                        Şimdi Yayınla
                                        <input name="publishNow" id="publishNow" type="checkbox">
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button id="btnSave" class="btn green waves-effect btn-block" type="button">
                                    Kaydet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/backEnd/libs/ckeditor/ckeditor.js') }}"></script>
    <script>


        var d = new Date();
        const ye = new Intl.DateTimeFormat('tr', {year: 'numeric'}).format(d);
        const mo = new Intl.DateTimeFormat('tr', {month: 'numeric'}).format(d);
        const da = new Intl.DateTimeFormat('tr', {day: '2-digit'}).format(d);
        var today = `${ye}-${mo}-${da}`;
        today += "T" + d.toString().substring(16, 21);
        document.getElementById("publish_date").min = today;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', 'body .tags-list-item', function ()
        {
            var child = $(this).children();
            var span = child[0].innerText;

            var div = document.createElement('div');
            div.className = "tags-select-item";
            var i = document.createElement('i');
            i.className = 'material-icons tags-select-close';

            div.innerText = span;
            i.innerText = 'close';

            div.appendChild(i);
            var tagsInput = document.querySelector('.tags-input-div');
            tagsInput.insertBefore(div, tagsInput.childNodes[0]);
            $('.tags-list').html("");


        });
        $(document).on('click', 'body .tags-select-close', function ()
        {
            var a = $(this).parent();
            a[0].remove();
        });
        $(".tags").on("keyup", function ()
        {
            let tagText = $(this).val();

            if (tagText.length > 0)
            {
                $.ajax({
                    method:'POST',
                    url:'{{ route('admin.search.tag') }}',
                    data:{
                        text: tagText
                    },
                    async:false,
                    success:function (response)
                    {
                        $('.tags-list').html("");
                        $('.tags-list').append(response);
                    }
                })
            }
        });
    </script>
@endsection
