<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Ads;
use Illuminate\Http\Request;
use App\Services\User\BlogService;
use App\Services\Admin\PointService;
use App\Services\Admin\ResetService;
use App\Services\Admin\VersionService;
use App\Services\Admin\CategoryService;

class AdsController extends Controller
{
    const PATH_VIEW = 'ads.';
    const PATH_UPLOAD = 'public/ads';

    public function __construct(
        private CategoryService $categoryService,
        private PointService $pointService,
        private ResetService $resetService,
        private VersionService $versionService,
        private BlogService $blogService,
    ) {
    }

    public function index()
    {
        // $category =
    }
    
    public function create()
    {
        $categories = $this->categoryService->getAlls();
        $points = $this->pointService->getAlls();
        $versions = $this->versionService->getAlls();
        $resets = $this->resetService->getAlls();
        return view(self::PATH_VIEW.__FUNCTION__, compact('categories', 'points', 'versions', 'resets'));
    }

    public function store(Request $request)
    {
        $imageName = 'images/Rectangle_82.png';

            $ads =  $request->validate([
                'name'=>'required|min:8',
                'home'=> 'required:min:8',
                'fanpage'=> 'required|min:8',
                'image' => 'required|image',
                'category_id'=> 'required|integer|exists:categories,id',
                'reset_id'=> 'required|integer|exists:resets,id',
                'version_id'=> 'required|integer|exists:versions,id',
                'point_id'=> 'required|integer|exists:points,id',
                'short_description'=> 'required|min:8|max:1000',
                'server'=> 'required',
                'alpha_test'=> 'required',
                'open_beta'=> 'required',
                'anti_hack'=>'required',
                'exp'=> 'required|integer',
                'drop'=> 'required|integer',
                'description'=> 'required',
            ]);
        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $imageName = "/upload/" . time(). $key.'.png';
            
            file_put_contents(public_path().$imageName, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $imageName);
        }
        $description = $dom->saveHTML();

        if (isset($ads['image'])) {
            $imageName = $ads['image']->store(self::PATH_UPLOAD);
            $ads['image'] = $imageName;
        }
        $ads['description'] = $description;
        Ads::create($ads);
        return redirect()->route('home');
    }

    public function show($id)
    {
        $ads = Ads::find($id);
        return view(self::PATH_VIEW.__FUNCTION__, compact('ads'));
    }
}
