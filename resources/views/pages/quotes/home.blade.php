@extends('layouts._base')

@section('title', 'Quotes')

@section('content')
    <div class="card pt-5 pb-0 px-5 border-0 bg-light">
        {{-- Add overlay here --}}
        <div class="row px-4">
            <form class="col-12 form-inline clearfix" action="">
                <div class="form-group float-left">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mx-2">
                        <input class="mdl-textfield__input " type="text" id="search" placeholder="Search by author or topic">
                    </div>
                </div>
                <div class="float-right form-group mx-3 ">
                    <span class="mdl-radio__label">Filter by: </span>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="author">
                        <input type="radio" id="author" class="mdl-radio__button" name="filter" value="1" checked>
                        <span class="mdl-radio__label">By Author</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="topic">
                        <input type="radio" id="topic" class="mdl-radio__button" name="filter" value="1">
                        <span class="mdl-radio__label">By Author</span>
                    </label>
                </div>
                <div class="float-right form-group mx-3">
                    <span class="mdl-radio__label">Sort results: </span>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="a-to-z">
                        <input type="radio" id="a-to-z" class="mdl-radio__button" name="sorting" value="1" checked>
                        <span class="mdl-radio__label">A - Z</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="z-to-a">
                        <input type="radio" id="z-to-a" class="mdl-radio__button" name="sorting" value="1">
                        <span class="mdl-radio__label">Z - A</span>
                    </label>
                </div>

            </form>
        </div>
    </div>
    <div class="card container-list--posters pt-0 pb-5 px-5 border-0 bg-light">
        <div class="centered mx-auto px-5">
            <div class="row d-flex justify-content-start">
                @foreach ($posters as $poster)
                    <label for="{{'modal_btn_'.$poster->id}}">
                        <div class="mx-4 my-3 demo-card-image mdl-card mdl-shadow--2dp "
                             style="background-image:url('{{asset ('uploads/' . $poster->filename)}}')">
                            <div class="mdl-card__actions clearfix">
                                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--share float-left" href='{{"https://www.facebook.com/sharer/sharer.php?u=".asset ('uploads/' . $poster->filename)}}' target="_blank">
                                    Share
                                </a>
                                <form action="{{'/delete/'.$poster->id}}" method="POST">
                                    {{csrf_field ()}}
                                    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--delete float-right" type="submit">
                                        <i class="material-icons">delete</i></button>
                                </form>
                                <form action="/edit" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field () }}
                                    <input type="hidden" id="posterId" name="posterId" value="{{$poster->id}}">
                                    <input type="hidden" id="background_id" name="background_id" value="{{$poster->background_id}}">
                                    <input type="hidden" id="quote" name="quote" value="{{$poster->quote}}">
                                    <input type="hidden" id="author" name="author" value="{{$poster->author}}">
                                    <input type="hidden" id="text_background" name="text_background" value="{{$poster->text_background}}">
                                    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--edit float-right" href=""><i class="material-icons">edit</i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <button type="button" id="{{'modal_btn_'.$poster->id}}" style="display:none;" data-toggle="modal" data-target="#{{'modal_poster_'.$poster->id}}"></button>
                    </label>
                    <div class="modal fade" id="{{'modal_poster_'.$poster->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div id="{{'modal_image_'.$poster->id}}" class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="background-image:url('{{asset ('uploads/' . $poster->filename)}}')" >
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body">
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="/create">
                    <div class="mx-4 my-3 mdl-shadow--2dp" id="addButton" style="background-image:url('{{asset ('images/plus-square.svg')}}')">
                    </div>
                </a>

            </div>

        </div>
    </div>



@stop
