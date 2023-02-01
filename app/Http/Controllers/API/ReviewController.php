<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'phone' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['reviews'] = Review::where('active', 1)
                                ->orderBy('created_at', 'desc')
                                ->select('name', 'review', 'rating', 'created_at')                       
                                ->paginate(10);
        $this->data['review_statistics'] = Review::where('active', 1)
                                        ->selectRaw('rating, count(*) as total')
                                        ->groupBy('rating')
                                        ->orderBy('rating', 'desc')
                                        ->get();
        // limit to 2 decimal places
        $this->data['average_rating'] = number_format(Review::where('active', 1)->avg('rating'), 1);
        $this->data['total_reviews'] = Review::where('active', 1)->count();
        return ApiFormatter::createAPI(200, 'Success', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            // return ApiFormatter::createAPI(400, 'Failed', $validator->errors());
            return ApiFormatter::createAPI(400, 'Failed', 'Lengkapi Formulir Ulasan Anda');

        }
        // check if an email is already post review today
        $today = date('Y-m-d');
        $email = $request->email;
        $previous_review = Review::where('email', $email)->whereDate('created_at', $today)->first();
        if ($previous_review) {
            return ApiFormatter::createAPI(400, 'Failed', 'Anda Sudah Menambahkan Ulasan Sebelumnya');
        }
        // save review
        try {
            $review = Review::create($request->all());
        } catch (\Throwable $th) {
            return ApiFormatter::createAPI(400, 'Failed', $th->getMessage());
        }
        return ApiFormatter::createAPI(200, 'Success', 'Sukses Menambahkan Ulasan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}