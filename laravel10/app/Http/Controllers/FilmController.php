<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null): View
    {
        $query = $slug ? Category::whereSlug($slug)->firstOrFail()->films() : Film::query();
        $films = $query->withTrashed()->oldest('title')->paginate(5);
        return view('index', compact('films', 'slug'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    return view('create');
}

     /**
     * Store a newly created resource in storage.
     */
    
    public function store(FilmRequest $filmRequest): RedirectResponse
    {
        Film::create($filmRequest->all());
    
        return redirect()->route('films.index')->with('info', 'Le film a bien été créé');
    }

   
   
    /**
     * Display the specified resource.
     */
    public function show(Film $film): View
    {
        $category = $film->category->name;    
        return view('show', compact('film', 'category'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film): View
    {
        return view('edit', compact('film'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmRequest $filmRequest, Film $film): RedirectResponse
{
    $film->update($filmRequest->all());

    return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
}

    /**
     * Remove the specified resource from storage.
     */public function destroy(Film $film): RedirectResponse
{
    $film->delete();

    return back()->with('info', 'Le film a bien été mis dans la corbeille.');
}


public function forceDestroy($id): RedirectResponse
{
    Film::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

    return back()->with('info', 'Le film a bien été supprimé définitivement dans la base de données.');
}

public function restore($id): RedirectResponse
{
    Film::withTrashed()->whereId($id)->firstOrFail()->restore();

    return back()->with('info', 'Le film a bien été restauré.');
}



}
