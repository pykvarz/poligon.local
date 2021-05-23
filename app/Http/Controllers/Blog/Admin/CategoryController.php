<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\BlogCategory;
use Illuminate\Support\Str;


class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository;
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        // Порождаем экземпляр репо
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $paginator = BlogCategory::paginate(15); **** Было ****
        $paginator = $this->blogCategoryRepository->getAllWithPaginate();
        return view('blog.admin.category.index',
            compact('paginator'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = new BlogCategory(); // Пустышка для шаблона

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryRequest $request
     * @return RedirectResponse
     *
     * Сохранение новой категорий
     */
    public function store(BlogCategoryRequest $request)
    {
        $data = $request->input();


//        if (empty($data['slug'])) {
//            $data['slug'] = Str::slug($data['title']);
//        }

        $item = new BlogCategory($data); // В объект моделя сохраняем данными из реквеста
        $item->save();

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param BlogCategoryRepository $categoryRepository
     * @return Application|Factory|View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();
        $item = $categoryRepository->getEdit($id);
        $categoryList = $categoryRepository->getForComboBox();
        if (empty($item)) {
            abort(404);
        }
        return view('blog.admin.category.edit',
        compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg'=>"Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->fill($data)->save();


        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success'=> 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg'=> 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
