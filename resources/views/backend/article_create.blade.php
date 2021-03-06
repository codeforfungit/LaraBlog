@extends('layouts.admin')

@section('content')
    <div class="panel panel-default no-margin-bottom">
        <div class="panel-heading">
            <strong>Write New Article</strong>
        </div>
        <div class="panel-body" id="create-article">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs margin-bottom-5" role="tablist">
                <li role="presentation" class="active">
                    <a href="#editor" aria-controls="home" role="tab" data-toggle="tab">Editor</a>
                </li>
                <li role="presentation" onclick="updatePreview()">
                    <a href="#preview" aria-controls="settings" role="tab" data-toggle="tab">Preview</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="editor">
                    <form action="{{route('store-article')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" name="heading"
                                   placeholder="*Heading..." required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-grey">
                            Tips for article content: Enclose source inside &lt;pre&gt;&lt;code&gt;...&lt;/code&gt;&lt;/pre&gt;
                        </div>
                        <div class="form-group">
                        <textarea name="content" class="form-control textarea-indent"
                                  rows="10"
                                  placeholder="*Write here..." required></textarea>
                        </div>
                        <div class="text-grey">
                            Tips for keywords: separate your keywords by space. Some popular keywords are:
                        </div>
                        <div class="form-group">
                            <strong>Keywords: </strong><label id="keywords-show"></label>
                            <input type="text" id="keyword" onkeyup="formatKeyword('#keyword', '#keywords-show')"
                                   class="form-control" name="keywords" placeholder="Keywords" required>
                        </div>
                        <div class="form-group">
                            @foreach(config('fields.lang') as $lang => $fullLang)
                                <input id="{{'radio-'.$lang}}" type="radio" name="language"
                                       value="{{$lang}}" {{$loop->first ? 'checked' : ''}}>
                                <label for="{{'radio-'.$lang}}">{{$fullLang}}</label>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="is_comment_enabled" value="1" checked id="comment-enabled">
                            <label for="comment-enabled">Comment Allowed</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="preview">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="article-heading text-xlg" id="article-heading"></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-justify text-md" id="article-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inPageJS')
    @parent
    <script>
        function updatePreview() {
            $("#article-heading").html($("input[name=heading]").val());
            $("#article-content").html($("textarea[name=content]").val());
        }

        function formatKeyword(inputId, displayId) {

            let keywords = $(inputId).val().split(' ');
            let htmlToShow = '';
            for (var i = 0; i < keywords.length; i++) {
                htmlToShow += "<span class='label label-info margin-right-5'>" + keywords[i] + "</span>";
            }
            $(displayId).html(htmlToShow);
        }
    </script>
@show