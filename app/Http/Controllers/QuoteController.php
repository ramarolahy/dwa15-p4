<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\File;
    use Intervention\Image\ImageManager;
    use App\Poster;
    use App\Background;

    class QuoteController extends Controller {

        /***** CREATE AND UPDATE *****
         * Method to save new poster to the db, and save poster image to the
         * uploads directory.
         * @param Request $request
         * @param int $posterId
         * @return \Illuminate\Http\RedirectResponse
         */
        public function save (Request $request) {
            $posterId = \request ('posterId');
            if ( !$posterId) {
                $poster = new Poster ();
            }
            else {
                // Retrieve poster from db
                $poster = Poster::where ('id', '=', $posterId)->first ();
                // Delete old image file from storage
                $oldFilename = $poster->filename;
                $oldFilePath = 'uploads/'.$oldFilename;
                if (File::exists ($oldFilePath)) {
                    File::delete ($oldFilePath);
                }
            }
            $author = \request ('author');
            $quote = \request ('quote');
            $text_background = \request ('text_background') || 0;
            $background_id = \request ('background_id');
            // Construct filename
            $filename = $this->setFilename ($author, $quote,
                                            $text_background,
                                            $background_id);
            // Store base64 image file
            $imageBase64 = \request ('file');

            // Extract the image base64 data by exploding the file (This
            // looks like JS destructuring!!)
            // There is only one ; and one , in the encoded file so we can do
            list($type, $data) = explode (';', $imageBase64);
            list(, $base64) = explode (',', $data);
            // Then decode the file
            $decodedImage = base64_decode ($base64);
            // This will open/create a filename, write image on to filename,
            // then close it.
            // SEE https://www.php.net/manual/en/function.file-put-contents.php
            file_put_contents ('uploads/'.$filename, $decodedImage);
            // Query for the background to associate to the poster
            $background = Background::where('id', '=', $background_id)->first();

            $poster->author = $author;
            $poster->quote = $quote;
            $poster->text_background = $text_background;
            $poster->background()->associate ($background);
            $poster->filename = $filename;
            // Save new poster
            $poster->save ();

            return redirect ()->route ('quotes.home');
        }

        /***** READ *****
         * Method to READ all posters from the db.
         * @return Poster[]|\Illuminate\Database\Eloquent\Collection
         */
        public function listPosters () {
            return Poster::all ();
        }

        /***** READ *****
         * Method to READ all backgrounds from the db
         * @return Background[]|\Illuminate\Database\Eloquent\Collection
         */
        public function listBackgrounds () {
            return Background::all ();
        }

        /***** DELETE *****
         * Method to delete a poster from the db
         * @param int $posterId
         * @return \Illuminate\Http\RedirectResponse
         */
        public function delete (int $posterId) {
            $poster = Poster::where ('id', '=', $posterId)->first ();
            $filename = $poster->filename;
            $imagePath = 'uploads/'.$filename;
            if ( !$poster) {
                dump ('No poster found.');
            }
            else {
                // DELETE poster
                $poster->delete ();
                // DELETE image file from public folder if it exists
                if (File::exists ($imagePath)) {
                    File::delete ($imagePath);
                }
                // Reload page
                return redirect ()->route ('quotes.home');
            }
        }

        /**
         * Method to GET the quotes route and display all posters from the db
         * @param int $posterId
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function home (int $posterId = null) {
            if ($posterId) {
                $poster = Poster::where ('id', '=', $posterId)->first ();
            }
            else {
                $poster = null;
            }
            $state = [
                'posters'  => $this->listPosters (),
                'poster'   => $poster,
                'isActive' => 'home',
            ];

            //dump($posters);
            return view ('pages.quotes.home', $state);
        }

        /**
         * Method to search for poster by author or keyword in quotes.
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function search (Request $request) {
            $validateData = $request->validate ([
                                                    'filter'     => 'required',
                                                    'searchTerm' => 'required',
                                                ]);
            $filter = $validateData['filter'];
            $searchTerm = htmlentities ($validateData['searchTerm']);
            $term = '%'.$searchTerm.'%';
            $posters = Poster::where ($filter, 'LIKE', $term)->get ();
            $state = [
                'isActive' => 'home',
                'posters' => $posters,
            ];
            return view ('pages.quotes.home', $state);
        }

        /**
         * Method to GET the create route and initialize the form
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create () {
            $state = [
                'isActive'      => 'create',
                'posterId'      => null,
                'textBg'        => 'quote-text__bg',
                'imgBg'         => null,
                'selectedBg'    => null,
                'quote'         => null,
                'author'        => null,
                'addBackground' => null,
                'backgrounds'   => $this->listBackgrounds ()
            ];
            //dump($state);
            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to validate user inputs, and display created poster to
         * canvas upon validation.
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function new (Request $request) {

            $validateData = $request->validate ([
                                                    'author'       => 'required',
                                                    'quote'        => 'required',
                                                    'myBackground' => 'file|image|mimes:jpeg,jpg,png,gif|max:2048'
                                                ]);
            $selectedBg = \request ('selectedBg');
            // Get collection of bg images in storage
            $bgImages = $this->listBackgrounds ();
            if ($selectedBg) {
                $imgBg = asset ('/images/'.$selectedBg);
                $imgBg_id = Background::where ('filename', '=', $selectedBg)
                    ->first ()->id;
            }
            else {
                // Get bg count to use with rand()
                $bgImageCount = $bgImages->count ();
                // Generate random bg id
                $randId = rand (1, $bgImageCount);
                // Get bg from db
                $randBackground = Background::where ('id', '=', $randId)->first ();
                $randFile = $randBackground->filename;
                $imgBg_id = $randBackground->id;
                $imgBg = asset ('/images/'.$randFile);
            }
            $posterId = \request ('posterId');
            $quote = htmlentities ($validateData['quote']);
            $author = htmlentities ($validateData['author']);
            $addTxtBg = \request ('addTxtBg') || 0;
            $textBg = 'quote-text__bg';

            $state = [
                'isActive'    => 'create',
                'posterId'    => $posterId,
                'textBg'      => $textBg,
                'imgBg'       => $imgBg,
                'imgBg_id'    => $imgBg_id,
                'selectedBg'  => $selectedBg,
                'quote'       => $quote,
                'author'      => $author,
                'addTxtBg'    => $addTxtBg,
                'backgrounds' => $this->listBackgrounds ()
            ];

            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to edit a poster
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit (Request $request) {
            $imgBg = Background::where ('id', '=', $request['background_id'])
                ->first ();
            $textBg = 'quote-text__bg';
            $state = [
                'isActive'    => 'create',
                'posterId'    => $request['posterId'],
                'textBg'      => $textBg,
                'imgBg'       => asset ('/images/'.$imgBg->filename),
                'imgBg_id'    => $request['background_id'],
                'selectedBg'  => $imgBg->filename,
                'quote'       => $request['quote'],
                'author'      => $request['author'],
                'addTxtBg'    => $request['text_background'],
                'backgrounds' => $this->listBackgrounds ()
            ];

            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to construct the image filename
         * @param string $author
         * @param string $quote
         * @param int $textBg
         * @param int $bgID
         * @return string: authorname_firstthreewords_[int][int].png
         */
        public function setFilename (string $author, string $quote, int $bgID,
            int $textBg = 0) {
            // Remove non a-zA-Z spaces in author and quotes (first three words)
            // and change to lowercase
            $pattern = '/([^a-zA-Z]|\s)/i';
            $authorToLower = strtolower (preg_replace ($pattern, '', $author));
            // Change quote to an array
            $quoteToArr = explode (' ', $quote);
            // Take first 3 words and glue them together
            $firstThreeWords = implode ('', array_splice ($quoteToArr, 0, 3));
            // Remove special characters and spaces
            $quoteToLower = strtolower (preg_replace ($pattern, '', $firstThreeWords));
            // return file name as authorname_firstthreewords_[int][int].png
            return $authorToLower.'_'.$quoteToLower.'_'.$textBg.$bgID.'.png';
        }

    }
