<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\File;
    use Intervention\Image\ImageManager;
    use Illuminate\Support\Facades\Storage;
    use App\User;
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
            $text_overlay = \request ('text_overlay') || 0;
            $background_id = \request ('background_id');
            $design = \request ('design');
            // Construct filename
            $filename = $this->setFilename ($author, $quote,
                                            $text_overlay,
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

            // Trying to save posters to AWS S3;
            /* $s3 = Storage::disk ('s3');
             $filePath = '/user_posters/'.$filename;
             $s3->put ($filePath, file_get_contents ($imageBase64), 'public');*/

            // Query for the background to associate to the poster
            $background = Background::where ('id', '=', $background_id)->first ();
            $user_id = Auth::id ();
            $user = User::where ('id', '=', $user_id)->first ();

            $poster->author = $author;
            $poster->quote = $quote;
            $poster->text_overlay = $text_overlay;
            $poster->background ()->associate ($background);
            $poster->design = $design;
            $poster->user ()->associate ($user);
            $poster->filename = $filename;
            // Save new poster
            $poster->save ();

            return redirect ()->route ('home');
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
                return redirect ()->route ('home');
            }
        }

        /**
         * Method to GET the create route and initialize the form
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create () {
            // Defaults
            $background_image = Background::where ('id', '=', 1)->first ()
                ->filename;
            $background_url = asset ('/images/backgrounds/'.$background_image);
            $quote = 'A nice quote for a nice day!';
            $author = 'PrettyQuotes';
            $design = 'design_1';
            $designChoices = ['design_1', 'design_2', 'design_3', 'design_4',
                'design_5'
            ];
            $state = [
                'posterId'       => null,
                'overlay_class'  => 'quote-text__bg',
                'background_id'  => 1,
                'background_url' => $background_url,
                'quote'          => $quote,
                'author'         => $author,
                'text_overlay'   => 1,
                'design'         => $design,
                'designChoices'  => $designChoices,
                'backgrounds'    => $this->listBackgrounds ()
            ];
            //dump($state);
            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to validate user inputs, and display created poster to
         * canvas upon validation.
         * DOES NOT SAVE NEW POSTER TO DATABASE
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function new (Request $request) {

            $validateData = $request->validate ([
                                                    'author'       => 'required|max:32',
                                                    'quote'        => 'required|max:255',
                                                ]);
            $background_id = \request ('background_id');
            $background_image = Background::where ('id', '=', $background_id)
                ->first ()->filename;
            $background_url = asset ('/images/backgrounds/'.$background_image);

            // Get collection of bg images in storage
            $bgImages = $this->listBackgrounds ();

            $posterId = \request ('posterId');
            $quote = $validateData['quote'];
            $author = $validateData['author'];
            $text_overlay = \request ('text_overlay') || 1;
            $design = \request ('design');
            $overlay_class = 'quote-text__bg';
            $designChoices = ['design_1', 'design_2', 'design_3', 'design_4',
                'design_5'
            ];

            $state = [
                'posterId'       => $posterId, // Needed for Update
                'overlay_class'  => $overlay_class,
                'background_url' => $background_url,
                'background_id'  => $background_id,
                'quote'          => $quote,
                'author'         => $author,
                'text_overlay'   => $text_overlay,
                'design'         => $design,
                'designChoices'  => $designChoices,
                'backgrounds'    => $bgImages,
            ];

            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to edit a poster
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit (Request $request) {
            $background_image = Background::where ('id', '=', $request['background_id'])
                ->first ()->filename;
            $overlay_class = 'quote-text__bg';
            $designChoices = ['design_1', 'design_2', 'design_3', 'design_4',
                'design_5'];
            $backgrounds = $this->listBackgrounds ();
            $state = [
                'posterId'         => $request['posterId'],
                'overlay_class'    => $overlay_class,
                'background_url' => asset ('/images/backgrounds/'
                                             .$background_image),
                'background_id'    => $request['background_id'],
                'quote'            => $request['quote'],
                'author'           => $request['author'],
                'text_overlay'     => $request['text_overlay'],
                'design'           => $request['design'],
                'designChoices'    => $designChoices,
                'backgrounds'      => $backgrounds
            ];

            return view ('pages.quotes.create', $state);
        }

        /**
         * Method to construct the image filename
         * @param string $author
         * @param string $quote
         * @param int $overlay_class
         * @param int $bgID
         * @return string: authorname_firstthreewords_[int][int].png
         */
        public function setFilename (string $author, string $quote, int $bgID,
            int $overlay_class = 0) {
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
            return $authorToLower.'_'.$quoteToLower.'_'.$overlay_class.$bgID.'.png';
        }

    }
