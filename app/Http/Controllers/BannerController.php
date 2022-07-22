<?php

namespace App\Http\Controllers;

use App\DataTables\BannerDataTable;
use App\Http\Requests\CreateBannerRequest;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends AppBaseController
{
    /** @var  BannerRepository $bannerRepository */
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new BannerDataTable())->get())->make(true);
        }

        return view('banners.index');
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * @param CreateBannerRequest $request
     *
     * @return RedirectResponse
     * @throws \Throwable
     *
     */
    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();
        $this->bannerRepository->storeBanner($input);
        Flash::success('Banner created successfully.');

        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Banner $banner
     *
     * @return mixed
     */
    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $banner
     * @return mixed
     */
    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBannerRequest $request
     *
     * @param Banner $banner
     *
     * @return RedirectResponse
     * @throws \Throwable
     *
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $input = $request->all();
        $this->bannerRepository->updateBanner($banner->id, $input);
        Flash::success('Banner updated successfully.');

        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     *
     * @return mixed
     * @throws \Exception
     *
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return $this->sendSuccess('Banner deleted successfully.');
    }
}
