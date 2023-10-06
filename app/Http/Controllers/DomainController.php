<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class DomainController extends Controller
{
    /**
 * Display a listing of the resource.
 *
 * @return View
 */
public function index(Request $request)
{
    $keyword = $request->get('search');

    $perPage = 25;


    if (!empty($keyword)) {
        $domains = Domain::where('url', 'like', "%$keyword%")->paginate($perPage);
    } else {
        $domains = Domain::latest()->paginate($perPage);
    }

    return view('pages.domain.index', compact('domains'));
}

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create()
    {
        $domains = Domain::all();

        return view('pages.domains.create', compact('domains'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Domain::create($request);

        return redirect('admin/domains')->with('flash_message', 'Domain added!');
    }

    /**
     * Display the specified resource.
     *
     * @param Domain $domain
     * @return View
     */
    public function show(Domain $domain) : View
    {
        return view('users.show', compact('domain'));
    }

    /**
     * Display the specified resource.
     *
     * @param Domain $domain
     * @return View
     */
    public function edit(Domain $domain) : View
    {
        return view('users.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Domain
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, Domain $domain)
    {
        $domain->update($request->validated());

        return redirect('admin/domains')->with('flash_message', 'Domain updated!');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Domain
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
        
        return redirect('admin/domains')->with('flash_message', 'Domain deleted!');
    }
}
