@extends('layouts._base')

@section('title', 'Create Quote')

@section('content')
    <!-- App -->
    <div class="row pt-5">
        <!-- Form wrapper-->
        <div class="col-form col-5 pl-5">
            <form method="POST" action="/new" enctype="multipart/form-data">
                {{ csrf_field () }}
                {{-- Design choices radio buttons --}}
                <div id="designSelection" class="card-body row wrap-card-body__radio py-0 px-0 mt-3 bg-light ">
                    @foreach($designChoices as $choice)
                        <label class="col-2 mr-2" for='design_option--{{$choice}}'>
                            <input type="radio" id='design_option--{{$choice}}'
                                   class="mdl-radio__button"
                                   name="design"
                                   value={{$choice}}
                                   @if(old('design'))
                                   {{old('design') === $choice ? 'checked' : null  }}
                                   @elseif ( $design === $choice)
                                       checked
                            @else
                                {{$choice === 'design_1' ? 'checked' : null}}
                                @endif >
                            <img class="label--design-choice" src="{{ asset('/images/designs/' . $choice.'.png') }}" alt="{{$choice}}">
                        </label>
                    @endforeach
                </div>
                <input type="hidden" name="posterId" value="{{$posterId}}">
                <div class="card form-poster px-4 pb-2">
                    <!-- Background selection -->
                    <div class="card-body">
                        <h5 class="mdl-card__title-text">*Choose your background<br>
                            {{--                            <span class="small">(Leave empty for a random background)</span>--}}
                        </h5>
                    </div>
                    <div class="card-body row wrap-card-body__radio py-0">
                        <div id="background-carousel" class="carousel slide border-dark w-100"
                             data-ride="carousel" data-interval="false">
                            <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                @foreach($backgrounds as $choice)
                                    <div class="carousel-item col-md-3 {{$background_id == $choice->id ? 'active' : null}}">
                                        <label class="" for='background_{{$choice->id}}'>
                                            <input type="radio" id='background_{{$choice->id}}'
                                                   class="mdl-radio__button"
                                                   name="background_id"
                                                   data-filename="{{$choice->filename}}"
                                                   value="{{$choice->id}}"
                                                   @if(old('background_id'))
                                                   {{old('background_id') === strval($choice->id) ? 'checked' : null}}
                                                   @elseif( $background_id === strval($choice->id) ) checked
                                                   @else {{$choice->id === 1 ? 'checked' : null}}
                                                   @endif
                                                   required>
                                            <img src="{{ asset('/images/backgrounds/' . $choice->filename) }} " alt="{{$choice->filename}}">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#background-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#background-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <!-- END Background selection -->

                    <!-- Quote and Author input -->
                    <div class="card-body">
                        <h5 class="mdl-card__title-text">*Add your quote</h5>
                        <div class="mdl-textfield mdl-js-textfield">
                            <!--If filled, leave text on input area
                            in case
                                the user needs to make correction-->
                            <textarea class="mdl-textfield__input" rows="5" id="quote" name="quote" required>{{ old('quote', $quote)}}</textarea>
                            <label class="mdl-textfield__label" for="quote">Enter nice quote here...</label>
                        </div>
                        <!--If left empty, print error message-->
                        @include('includes._error_field', ['fieldName' => 'quote'])
                        <div
                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <!--If filled, leave text on input area
                                 in case
                                the user needs to make correction-->
                            <input class="mdl-textfield__input"
                                   type="text" id="author"
                                   name="author"
                                   value="{{ old('author', $author) }}"
                                   required
                            >
                            <label class="mdl-textfield__label"
                                   for="author">Who said it?...</label>

                        </div>
                        <!--If left empty, print error message-->
                    @include('includes._error_field', ['fieldName' => 'author'])
                    <!--If left empty, print error message-->
                    </div>
                    <!-- END Quote and Author input -->

                    <!-- Text background -->
                    <div class="card border-0 mb-2">
                        <div class="card-body py-2">
                            <div class="row bg-light ">
                                <div class="col-12">
                                    <label
                                        class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect"
                                        for="text_overlay">
                                        <!--If previously checked,
                                        leave checked, unless there
                                        was error-->
                                        <input type="checkbox"
                                               id="text_overlay"
                                               class="mdl-checkbox__input"
                                               name="text_overlay"
                                               value="1"
                                            {{ $text_overlay ? 'checked' : null}}
                                        >
                                        <span class="mdl-checkbox__label mdl-card__title-text">
                                            Add text overlay (For light backgrounds)
                                        </span>
                                    </label>
                                </div>
                                {{-- <div class="col-6">
                                     <label
                                         class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect"
                                         for="allCaps">
                                         <!--If previously checked,
                                         leave checked, unless there
                                         was error-->
                                         <input type="checkbox"
                                                id="allCaps"
                                                class="mdl-checkbox__input"
                                                name="allCaps"
                                                value="1"
                                                @if ( isset( $allCaps ) and $allCaps and !$errors ) checked @endif
                                         >
                                         <span class="mdl-checkbox__label mdl-card__title-text">
                                             All Caps
                                         </span>
                                     </label>
                                 </div>--}}
                            </div>
                        </div>
                    </div>
                    <!-- End Text background -->

                    <!-- Submit button -->
                    <div class="card-body">
                        <button class=" float-left mdl-button mdl-js-button mdl-button--raised
                                mdl-js-ripple-effect" onclick="
                                        document.getElementById('quote').value=null;
                                        document.getElementById('author').value=null;
                                        document.getElementById('myBackground').value=null;
                                        return false;" type="button">
                            Clear
                        </button>
                        <button class=" float-right mdl-button mdl-js-button mdl-button--raised
                                mdl-js-ripple-effect mdl-button--accent text-white" type="submit">
                            {{\Request::is('edit') ? 'Update text' : 'Display quote'}}
                        </button>
                    </div>
                    <div class="alert alert-danger mb-2 mt-4">* Required fields</div>
                </div>
            </form>
        </div>
        <!-- END Form -->

        <!-- Quote poster -->
        <div class="col-poster col-7 pr-5">
            <div class="row">
                <div class="col-12" style="height: 68px;">

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!--  Put canvas here -->
                    <div id="quoteImg" class="wrap-quote mdl-card
                mdl-shadow--2dp" style="width: auto;"></div>
                    <!-- Poster div -->
                    <div class="wrap-quote mdl-card mdl-shadow--2dp"
                         style="
                         @if($background_url)
                             background-image:url({{ $background_url }});
                         @else
                             background-color:#313f48;
                         @endif
                             "
                         id="myQuote">
                        <!--On first load OR if there are errors, print default
                        quote
                        .-->
                        @if ( count($errors) > 0 or !$quote )
                            <div class="default_quote">
                                <span class="text__top">"A nice quote for a nice day!"</span><br>
                                <span class="text__top">~~~</span>
                            </div>
                        @else
                            <div id="quotePoster" class="py-5 px-4 @if ( isset( $text_overlay ) and $text_overlay ) {{ $overlay_class }} @endif quote-text {{$design}} text-center ">
                                <!--If there are no errors, print quote and
                                author-->
                                <span class="my-5 text__top">"{{ $quote }}"</span>
                                <br><br>
                                <span class="text__top"><em>{{ $author }}</em></span>
                            </div>

                    @endif
                    <!--Add text background if no errors-->
                    </div>
                    <!-- END Poster div -->
                </div>
            </div>

            <br>
            @if ( count($errors) == 0 and $quote)
                <form id="form--save-poster" action="/save{{$posterId ? '/'.$posterId : null}}" method="POST" enctype="multipart/form-data">
                    {{$posterId ? method_field('put') : null}}
                    {{ csrf_field () }}
                    {{-- Cannot use type="hidden" if wanna hanlde these with JQuery --}}
                    <input style="display: none;" id="posterId" name="posterId" value="{{$posterId}}">
                    <input style="display: none;" id="background_id" name="background_id" value="{{$background_id}}">
                    <input style="display: none;" id="quote" name="quote" value="{{$quote}}">
                    <input style="display: none;" id="author" name="author" value="{{$author}}">
                    <input style="display: none;" id="text_overlay" name="text_overlay" value="{{$text_overlay}}">
                    <input style="display: none;" id="design" name="design" value="{{$design}}">
                    <input style="display: none;" id="file" name="file">
                    <button id="button--save-poster" class=" float-right mdl-button mdl-js-button mdl-button--raised
                                mdl-js-ripple-effect mdl-button--accent text-white button-save" type="submit">
                        {{\Request::is('edit') ? 'Update my poster' : 'Add to my collection'}}
                    </button>
                </form>
            @endif
        </div>
        <!-- END Quote poster-->
    </div>
    <!-- END Quote Maker -->
    <div class="row row--bottom-quote px-5">
        <div class=" col--bottom-quote border-1 bg-white col-12">
            <h6 id="bottom_quote" class="text-center py-0 mx-auto my-2">
                “Nothing is impossible, the word itself says 'I'm possible'!”<br>
                <em>- Audrey Hepburn -</em>
            </h6>
        </div>
    </div>

@stop

@section('script')
    <script>
        html2canvas(document.getElementById("myQuote")).then(canvas => {
            document.getElementById("quoteImg").innerHTML = '';
            document.getElementById("quoteImg").appendChild(canvas);
            const fileElement = document.getElementById('file');
            if (fileElement) {
                fileElement.value = canvas.toDataURL("image/png");
            }
        })
    </script>
@stop
