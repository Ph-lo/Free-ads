<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Ads;
use App\Models\User;

class AdController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            // $ads = Ads::all();
            // $ads = User::find(1)->ads();
            $ads = User::find(Auth::user()->id)->ads()->orderBy('updated_at', 'desc')->paginate(15);
            return view('ads.userAds', compact('ads'));
        }

        return redirect("login");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAds(Request $request)
    {
        $keyword = $request->input('searched');
        // if ($request->has('type') && $request->input('type') !== null) {
        //     $type = $request->input('type');
        //     $ads = Ads::where(function ($query) use ($keyword) {
        //         $query->where('title', 'like', '%' . $keyword . '%')
        //             ->orWhere('description', 'like', '%' . $keyword . '%');
        //     })->where(function ($query) use ($priceMax) {
        //         $query->where('price', '<=', $priceMax);
        //     })
        //         ->paginate(15);

        //     return view('ads.results', compact('ads'))->with('keyword', $keyword)->with('priceMax', $priceMax);
        // } else {

        //     $ads = Ads::where(function ($query) use ($keyword) {
        //         $query->where('title', 'like', '%' . $keyword . '%')
        //             ->orWhere('description', 'like', '%' . $keyword . '%');
        //     })
        //         ->paginate(15);

        //     return view('ads.results', compact('ads'))->with('keyword', $keyword);
        // }
        $priceMax = ($request->has('price') && $request->input('price') !== null) ? $request->input('price') : 5000;
        // $sort = ($request->has('sort') && $request->input('sort') !== null) ? 
        if ($request->has('sort') && $request->input('sort') !== null) {
            $sort = explode('-', $request->input('sort'));
        } else {
            $sort = ['updated_at', 'desc'];
        }

        if ($request->has('type') && $request->input('type') !== null) {
            $type = $request->input('type');
            // $priceMax = $request->input('price');
            $ads = Ads::where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            })->where(function ($query) use ($priceMax) {
                $query->where('price', '<=', $priceMax);
            })->where(function ($query) use ($type) {
                $query->where('type', '=', $type);
            })->orderBy($sort[0], $sort[1])
                ->paginate(15);

            return view('ads.results', compact('ads'))->with('keyword', $keyword)->with('priceMax', $priceMax);
        } else {


            // $priceMax = $request->input('price');
            $ads = Ads::where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            })->where(function ($query) use ($priceMax) {
                $query->where('price', '<=', $priceMax);
            })->orderBy($sort[0], $sort[1])
                ->paginate(15);

            return view('ads.results', compact('ads'))->with('keyword', $keyword)->with('priceMax', $priceMax);
        }
    }

    public function getAllAds()
    {
        // $ads = DB::table('ads')->paginate(15);

        if (Auth::check()) {
            return view('dashboard')->with('ads', Ads::orderBy('updated_at', 'desc')->paginate(15));
        }
        return redirect("login");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAd()
    {
        // make method in controller to verify session
        if (Auth::check()) {
            return view('ads.newAdForm');
        }

        return redirect("login");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postAd(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required|max:60',
            'type' => 'required|max:120',
            'description' => 'required|max:255',
            'images' => 'required',
            'images.*' => 'mimes:png,jpeg,jpg,',
            'price' => 'required'
        ]);
        // echo $request->type;
        $data = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
        }

        $file = new Ads();
        $file->fill($request->all());
        $file->images = implode(",", $data);
        $file->save();

        return redirect('my-ads')->with('message', 'New ad has been successfully added');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Ads::find($id);
        return view('ads.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modify($id)
    {
        $data = Ads::find($id);
        return view('ads.modify', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('images')) {
            $validateData = $request->validate([
                'title' => 'required|max:60',
                'type' => 'required|max:100',
                'description' => 'required|max:255',
                'images' => 'required',
                'images.*' => 'mimes:png,jpeg,jpg,',
                'price' => 'required'
            ]);
            foreach ($request->file('images') as $file) {
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/files/', $name);
                $data[] = $name;
            }
            Ads::find($id)->update($validateData);
            return redirect('my-ads')->with('message', 'Ad Updated');
        } else {
            $validateData = $request->validate([
                'title' => 'required|max:60',
                'type' => 'required|max:100',
                'description' => 'required|max:255',
                'price' => 'required'
            ]);
            Ads::find($id)->update($validateData);
            return redirect('my-ads')->with('message', 'Ad Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ads::where('id', $id)->delete();
        return redirect('my-ads')->with('message', 'The ad has been deleted');
    }
}
