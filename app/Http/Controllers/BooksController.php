<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Book;
use App\Models\Keywords;
use App\Models\Category;
// use Illuminate\Support\Facades\Http;
// use GuzzleHttp\Client;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class BooksController extends Controller
{
    const API_URL = 'https://api.rachnaye.com/api/book/portal/allBooks';
    public function fetchBooks($chunk_size)
    {
        try {
            $page = 1;
            $has_more_data = true;
            while ($has_more_data) {
                // Initialize Guzzle client
                $client = new Client();

                // Make GET request to API
                $response = $client->get(self::API_URL, [
                    'query' => [
                        'page' => $page,
                        'per_page' => $chunk_size
                    ]
                ]);

                // Decode JSON data
                $data = json_decode($response->getBody(), true);

                // Loop through data and update or create books in the database
                foreach ($data['data'] as $book) {
                    try {
                        $validatedData = [
                            // ... Validation rules ...
                            'title' => 'required|string',
                            'b_id' => ['required', Rule::unique('books')->where(function ($query) {
                                return $query->whereNull('deleted_at');
                            })],
                            'description' => 'required',
                            'category' => 'required|string',
                            'language' => 'required|string',
                            'author' => 'required|string',
                            'status' => 'required|string',
                            'publisher' => 'required|string',
                            'publishedAt' => 'required|string',
                            'isbn' => 'required|string',
                            'contentType' => 'required|string',
                            'hasDigital' => 'required|string',
                            'hasRental' => 'required|string',
                            'hasHardbound' => 'required|string',
                            'hasPaperback' => 'required|string',
                            'keywords' => 'required|string',
                            'originCountry' => 'required|string',
                            'isActivated' => 'required|string',
                            'lowerLimit' => 'required|numeric',
                            'upperLimit' => 'required|numeric',
                            'avgReadingTime' => 'required|numeric',
                            'preview_link' => 'required|string',
                        ];
                        // ... Assign values to $validatedData ...
                        $validatedData['title'] = $book['title'];
                        $validatedData['b_id'] = $book['id'];
                        $validatedData['description'] = (isset($book['description'])) ? $book['description'] : "Not available";
                        $validatedData['category'] = $book['category'];
                        $validatedData['language'] = $book['language'];
                        $validatedData['publishedAt'] = $book['publishedAt'];
                        $validatedData['avgReadingTime'] = $book['avgReadingTime'];
                        $validatedData['status'] = $book['status'];
                        $validatedData['contentType'] = $book['contentType'];
                        $validatedData['hasDigital'] = $book['hasDigital'];
                        $validatedData['hasRental'] = (isset($book['hasRental'])) ? $book['hasRental'] : "Not available";
                        $validatedData['hasHardbound'] = $book['hasHardbound'];
                        $validatedData['hasPaperback'] = $book['hasPaperback'];
                        $validatedData['originCountry'] =  (isset($book['originCountry'])) ? $book['originCountry'] : "Not available";
                        $validatedData['isActivated'] = $book['isActivated'];
                        $validatedData['keywords'] = $book['keywords'];
                        $validatedData['lowerLimit'] = $book['ageRange']['lowerLimit'];
                        $validatedData['upperLimit'] = $book['ageRange']['upperLimit'];
                        $validatedData['author'] = (isset($book['authors'])) ? $book['authors'][0]['name'] : "Not available";
                        $validatedData['publisher'] = (isset($book['publisher'])) ? $book['publisher']['name'] : "Not available";
                        $validatedData['preview_link'] = (isset($book['thumbnailFront'])) ? $book['thumbnailFront'] : "N/A";
                        $validatedData['isbn'] = (isset($book['digital']['isbn'])) ? $book['digital']['isbn'] : "N/A";

                        // Check if book already exists in the database
                        $existing_book = Book::where('b_id', $validatedData['b_id'])->first();
                        if ($existing_book) {
                            // Update existing book
                            $existing_book->update($validatedData);
                            // Attach new keywords
                            $existing_keywords = $existing_book->keywords()->get();
                            foreach ($validatedData['keywords'] as $keyword) {
                                $new_keyword = Keywords::firstOrCreate(['keywords' => $keyword]);
                                $existing_keywords->push($new_keyword);
                            }
                            $existing_book->keywords()->sync($existing_keywords->pluck('id')->toArray());

                            // Attach new category
                            $new_category = Category::firstOrCreate(['category' => $validatedData['category']]);
                            $existing_book->category_id = $new_category->id;
                            $existing_book->save();
                        } else {
                            // Create new book
                            $new_book = new Book();
                            $new_book->fill($validatedData);
                            $new_book->save();
                            // Attach keywords
                            $new_keywords = collect();
                            foreach ($validatedData['keywords'] as $keyword) {
                                $new_keyword = Keywords::firstOrCreate(['keywords' => $keyword]);
                                $new_keywords->push($new_keyword);
                            }
                            $new_book->keywords()->sync($new_keywords->pluck('id')->toArray());

                            // Attach category
                            $new_category = Category::firstOrCreate(['category' => $validatedData['category']]);
                            $new_book->category_id = $new_category->id;
                            $new_book->save();
                        }

                    } catch (\Exception $e) {
                        Log::info("Error while saving book", ["error" => $e->getMessage()]);
                    }
                }


                // Check if there is more data to be fetched
                if (count($data) < $chunk_size) {
                    $has_more_data = false;
                }
                $page++;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function readResponse()
    {

        $books = Book::with(['keywords', 'category'])->paginate(10);
        $start = ($books->currentPage() - 1) * $books->perPage() + 1;
        return view('/books')->with(['books' => $books, 'start' => $start]);

    }
}