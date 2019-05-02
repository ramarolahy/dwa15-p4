@extends('layouts._base')

@section('title', 'Create Quote')

@section('content')
    <!-- App -->
    <div class="row pt-5">
        <!-- Form wrapper-->
        <div class="col-form col-5 pl-5">
            <form method="POST" action="/new" enctype="multipart/form-data">
                {{ csrf_field () }}
                <input type="hidden" name="posterId" value="{{$posterId}}">
                <div class="card form-poster px-4 pb-2">
                    <!-- Background selection -->
                    <div class="card-body">
                        <h5 class="mdl-card__title-text">Choose Background<br>
                            <span class="small">(Leave empty for a random background)</span>
                        </h5>
                    </div>
                    <div class="card-body row wrap-card-body__radio">
                        @foreach($backgrounds as $choice)
                            <div class="col-3">
                                <label class="" for='{{$choice->id}}-{{$choice->filename}}'>
                                    <input type="radio" id='{{$choice->id}}-{{$choice->filename}}'
                                           class="mdl-radio__button"
                                           name="selectedBg"
                                           data-id="{{$choice->id}}"
                                           value={{$choice->filename}}
                                           @if ( $selectedBg === $choice->filename ) checked @endif >
                                    <img src="{{ asset('/images/' . $choice->filename) }} " alt="road">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <!-- END Background selection -->

                    <!-- Quote and Author input -->
                    <div class="card-body">
                        <h5 class="mdl-card__title-text">Add your quote</h5>
                        <div class="mdl-textfield mdl-js-textfield">
                            <!--If filled, leave text on input area
                            in case
                                the user needs to make correction-->
                            <textarea class="mdl-textfield__input" rows="3" id="quote" name="quote">{{ $quote ? $quote : null }}</textarea>
                            <label class="mdl-textfield__label" for="quote">*Enter nice quote here...</label>
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
                                   value="{{ $author ? $author : null }}"
                            >
                            <label class="mdl-textfield__label"
                                   for="author">*Who said it?...</label>

                        </div>
                        <!--If left empty, print error message-->
                    @include('includes._error_field', ['fieldName' => 'author'])
                    <!--If left empty, print error message-->
                    </div>
                    <!-- END Quote and Author input -->

                    <!-- Text background -->
                    <div class="card bg-light border-0 mb-2 py-3 px-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <label
                                        class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect"
                                        for="addTxtBg">
                                        <!--If previously checked,
                                        leave checked, unless there
                                        was error-->
                                        <input type="checkbox"
                                               id="addTxtBg"
                                               class="mdl-checkbox__input"
                                               name="addTxtBg"
                                               value="1"
                                               @if ( isset( $addTxtBg ) and $addTxtBg and !$errors ) checked @endif
                                        >
                                        <span class="mdl-checkbox__label mdl-card__title-text">
                                            Text overlay
                                        </span>
                                    </label>
                                </div>
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
                            Show me!
                        </button>
                    </div>
                    <div class="alert alert-danger mb-2 mt-4">* Required fields</div>
                </div>
            </form>
        </div>
        <!-- END Form -->

        <!-- Quote poster -->
        <div class="col-poster col-7 pr-5">
            <!--  Put canvas here -->
            <div id="quoteImg" class="wrap-quote mdl-card
                mdl-shadow--2dp" style="width: auto;"></div>
            <!-- Poster div -->
            <div class="wrap-quote mdl-card mdl-shadow--2dp"
                 style="
                 @if($imgBg)
                     background-image:url({{ $imgBg }});
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
                    <div class="py-5 @if ( isset( $addTxtBg ) and $addTxtBg ) {{ $textBg }} @endif quote-text text-center ">
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
            <br>
            @if ( count($errors) == 0 and $quote)
                <form action="/save{{$posterId ? '/'.$posterId : null}}" method="POST" enctype="multipart/form-data">
                    {{$posterId ? method_field('put') : null}}
                    {{ csrf_field () }}
                    <input type="hidden" id="posterId" name="posterId" value="{{$posterId}}">
                    <input type="hidden" id="background_id" name="background_id" value="{{$imgBg_id}}">
                    <input type="hidden" id="quote" name="quote" value="{{$quote}}">
                    <input type="hidden" id="author" name="author" value="{{$author}}">
                    <input type="hidden" id="text_background" name="text_background" value="{{$addTxtBg}}">
                    <input type="hidden" id="file" name="file">
                    <button class=" float-right mdl-button mdl-js-button mdl-button--raised
                                mdl-js-ripple-effect mdl-button--accent text-white button-save" type="submit">
                        Save Poster
                    </button>
                </form>
            @endif
        </div>
        <!-- END Quote poster-->
    </div>
    <!-- END Quote Maker -->
    <div class="row row--bottom-quote px-5">
        <div class=" col--bottom-quote border-1 bg-white col-12">
            <h6 id="bottom_quote" class="text-center py-0 mx-auto my-2">“Nothing is impossible, the word itself says 'I'm possible'!”<br>
                <em>- Audrey Hepburn -</em>
            </h6>
        </div>
    </div>

@stop

@section('script')
    <script>
        html2canvas(document.getElementById("myQuote")).then(canvas => {
            document.getElementById("quoteImg").appendChild(canvas);
            const fileElement = document.getElementById('file');
            if (fileElement) {
                fileElement.value = canvas.toDataURL("image/png");
            }
        });
    </script>
@stop
