<?php

namespace App\Http\Controllers;

use App\Models\AdminDomain;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $keyword = $request->get('search');

        $perPage = $request->get('per_page');

        if(!empty($keyword) ) {
            $adminDomains = AdminDomain::where('url', 'like', "%".$keyword."%")->paginate($perPage);
        } else {
            $adminDomains = AdminDomain::latest()->paginate(10);
        }

        return view('admin_domain.index', compact('adminDomains'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        $adminDomains = AdminDomain::all();

        return view('admin_domain.create', compact('adminDomains'));
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
        AdminDomain::create($request);

        return redirect('admin/domains')->with('flash_message', 'Administrator of the Domain added!');
    }

    /**
     * Display the specified resource.
     *
     * @param AdminDomain $domain
     * @return View
     */
    public function show(AdminDomain $adminDomain)
    {
        return view('admin_domain.show', compact('adminDomain'));
    }

    /**
     * Show the form for editing the specified resource.
      *
     * @param AdminDomain $domain
     * @return View
     */
    public function edit(AdminDomain $adminDomain)
    {
        return view('admin_domain.edit', compact('adminDomain'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param AdminDomain $adminDomain
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, AdminDomain $adminDomain)
    {
        $adminDomain->update([
            $request->only('role_id', 'user_id', 'domain_id')
        ]);

        return redirect('admin/domains')->with('flash_message', 'Administrator of the Domain updated!');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param AdminDomain $adminDomain
     */
    public function destroy(AdminDomain $adminDomain)
    {
        $adminDomain->delete();

        return redirect('admin/domains')->with('flash_message', 'Administrator of the Domain deleted!');
    }
}
