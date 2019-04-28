@extends('layouts._base')

@section('title', 'Quotes')

@section('content')
    <div class="card pt-5 pb-0 px-5 border-0 bg-light">
        <div class="row px-4">
            <form class="col-12 form-inline clearfix" action="">
                <div class="form-group float-left">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mx-2">
                        <input class="mdl-textfield__input " type="text" id="search" placeholder="Search by author or topic">
                    </div>
                </div>
                <div class="float-right form-group mx-3 ">
                    <span  class="mdl-radio__label">Filter by: </span>
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
                    <span  class="mdl-radio__label">Sort results: </span>
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
    <div class="card pt-0 pb-5 px-5 border-0 bg-light">
        <div class="row">
            @for ($i = 0; $i < 12; $i++)
                <div class="mx-4 my-2 demo-card-square mdl-card mdl-shadow--2dp ">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Update</h2>
                    </div>
{{--                    <div class="mdl-card__supporting-text">--}}
{{--                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
{{--                        Aenan convallis.--}}
{{--                    </div>--}}
                    <div class="mdl-card__actions mdl-card--border clearfix">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-left" href="https://www.facebook.com/sharer/sharer.php?u=#imageURL" target="_blank">
                            Share on facebook
                        </a>
                        <div class="wrap--icons">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-right" href=""><i class="material-icons material-icons__edit">edit</i> </a>
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect float-right" href=""><i class="material-icons material-icons__delete">delete</i></a>
                        </div>

                    </div>
                </div>
            @endfor
        </div>
    </div>

@stop
