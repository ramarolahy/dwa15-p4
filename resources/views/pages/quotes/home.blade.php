@extends('layouts._base')

@section('title', 'Quotes')

@section('content')

    {{-- Fixed search row --}}
    <div class="row row-search px-4 bg-light">
        <form id="form-search" class="col-8 form-inline" method="POST" action="/search">
            {{ csrf_field () }}
            <div class="float-right form-group">
                <span class="mdl-radio__label mr-4">Filter by: </span>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="topic">
                    <input type="radio" id="topic" class="mdl-radio__button" name="filter" value="quote" checked>
                    <span class="mdl-radio__label">Keyword</span>
                </label>
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect mx-2" for="author">
                    <input type="radio" id="author" class="mdl-radio__button" name="filter" value="author">
                    <span class="mdl-radio__label">Author</span>
                </label>
            </div>
            <div class="form-group mx-auto w-auto">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mx-2">
                    <i class="fas fa-search"></i>
                    <input class="mdl-textfield__input pl-5 " type="text" id="search" name="searchTerm" placeholder="Search for a poster..." required>
                </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" type="submit">
                Search
            </button>
        </form>
        <div class="col-2"></div>
        <form id="form-reset" class="col-2 form-inline px-0" action="/">
            <button id="reset-search" class="mx-0 mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">
                Reset
            </button>
        </form>
    </div>
    <div class="row row-results container-list--posters mt-5 pt-0 pb-5 ml-2 border-0 bg-light">
        <div class="centered mx-auto pt-3">
            <div class="row d-flex justify-content-start">
                @foreach ($posters as $poster)
                    <div class=" mx-3 my-3 demo-card-image mdl-card mdl-shadow--2dp "
                         style="background-image:url('{{asset ('uploads/' . $poster->filename)}}')">
                        <div class="mdl-card__actions clearfix">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--share float-left" href='#'
                               onClick="MyWindow=window.open('{{"https://www.facebook.com/sharer/sharer.php?u=".URL::asset('uploads/'.$poster->filename)."&display=popup"}}','MyWindow',width='600'); return false;">
                                Share
                            </a>

                            <!-- Button trigger delete confirmation modal -->
                            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--delete float-right" type="button" data-toggle="modal" data-target="#{{'modal_delete_'.$poster->id}}">
                                <i class="material-icons">delete</i></button>
                            <form action="/edit" method="POST" enctype="multipart/form-data">
                                {{ csrf_field () }}
                                <input type="hidden" name="posterId" value="{{$poster->id}}">
                                <input type="hidden" name="background_id" value="{{$poster->background_id}}">
                                <input type="hidden" name="quote" value="{{$poster->quote}}">
                                <input type="hidden" name="author" value="{{$poster->author}}">
                                <input type="hidden" name="text_background" value="{{$poster->text_background}}">
                                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect button-action button-action--edit float-right">
                                    <i class="material-icons">edit</i>
                                </button>
                            </form>
                        </div>
                        <button class="modal-toggle" type="button" id="{{'modal_btn_'.$poster->id}}" data-toggle="modal" data-target="#{{'modal_poster_'.$poster->id}}"></button>
                    </div>

                    <!-- Modal to confirm delete -->
                    <div class="modal fade" id="{{'modal_delete_'.$poster->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="{{'modal_delete_label'.$poster->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-delete">
                                <div class="modal-header modal-delete border-0">
                                    <h5 class="modal-title text-center" id="{{'modal_delete_label'.$poster->id}}">Are you sure you want to delete this poster?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form action="{{'/delete/'.$poster->id}}" method="POST">
                                        {{ method_field('delete') }}
                                        {{csrf_field ()}}
                                        <div class="modal-footer">
                                            <button type="button" class="mx-5 mdl-button mdl-js-button mdl-button--raised mdl-button--accent" data-dismiss="modal">Nevermind!</button>
                                            <button class="text-danger mx-0 mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="submit">Yes delete!</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to show poster -->

                    <div class="modal fade" id="{{'modal_poster_'.$poster->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div id="{{'modal_image_'.$poster->id}}" class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-poster">
                                <img class="modal-image--poster" src="{{asset ('uploads/' . $poster->filename)}}" alt="{{$poster->filename}}">
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
                    <div class="mx-3 my-3 mdl-shadow--2dp" id="addButton" style="background-image:url('{{asset ('images/plus-square.svg')}}')">
                    </div>
                </a>
            </div>
        </div>
    </div>

@stop
