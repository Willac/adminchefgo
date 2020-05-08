<?php

namespace App\Http\Controllers\Admin;
use App\Models\EMoney;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\User;

class EMoneyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.emoneys.index', ['emoneys' => EMoney::paginate()]);
    }

    public function create()
    {
        return view('admin.emoneys.create',[
            'users'=>$this->getCurrentIDS()
        ]);
    }

    private function getCurrentIDS()
    {
        $emoneys = EMoney::all()->pluck('user_id')->toArray();
        return User::whereNotIn('id',$emoneys)->get();
    }


    public function store(Request $request)
    {
        $emoney = new EMoney();
        $emoney->fill($request->all());
        $emoney->amount *= 100;
        $emoney->save();
        return redirect()->intended(route('admin.emoneys'));
    }

    public function show(EMoney $emoney)
    {
        return view('admin.emoneys.show', ['emoney' => $emoney]);
    }

    public function edit(EMoney $emoney)
    {
        return view('admin.emoneys.edit', ['emoney' => $emoney,'users'=>$this->getCurrentIDS()]);
    }

    public function update(Request $request, EMoney $emoney)
    {
        $emoney->fill($request->all());
        $emoney->amount *= 100;
        $emoney->save();

        return redirect()->intended(route('admin.emoneys'));
    }

}
?>