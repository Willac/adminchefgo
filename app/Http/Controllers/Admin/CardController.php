<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\cardRequest;
use App\Http\Requests\Admin\cardUpdateRequest;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.cards.index', ['cards' => card::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cards.create');
    }

    /**
     * card a newly created resource in storage.
     *
     * @param cardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(cardRequest $request)
    {
        $card = new card();

        $card->fill($request->all());
        $card->save();
        return redirect()->intended(route('admin.cards'));
    }

    /**
     * Display the specified resource.
     *
     * @param card $card
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(card $card)
    {
        return view('admin.cards.show', ['card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param card $card
     * @return \Illuminate\Http\Response
     */
    public function edit(card $card)
    {
        return view('admin.cards.edit', ['card' => $card]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param cardUpdateRequest $request
     * @param card $card
     * @return mixed
     */
    public function update(cardUpdateRequest $request, card $card)
    {
        $card->fill($request->all());
        $card->save();

        return redirect()->intended(route('admin.cards'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param card $card
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(card $card)
    {
        $card->delete();
        return redirect()->intended(route('admin.cards'));
    }
}
