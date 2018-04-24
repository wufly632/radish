<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;

class CategoryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('分类管理');

            $content->row(function (Row $row) {
                $row->column(6, Category::tree());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('category'));

                    $form->text('title', '分类标题')->rules('required');
                    $form->text('name', '分类名称（中文）')->rules('required');
                    $form->text('name_en', '分类名称（英文）')->rules('required');
                    $form->select('parent_id')->options(Category::selectOptions());
                    $form->icon('icon', trans('admin.icon'))->default('fa-bars')->rules('required');

                    $form->radio('is_show')->options(['1' => '显示', '0' => '隐藏']);
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
        });
    }

    //public function treeView()
    //{
    //    Category::tree(function ($tree) {
    //        $tree->branch(function ($branch) {
    //            $src = config('admin.upload.host') . '/' . $branch['logo'] ;
    //            $logo = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";
    //
    //            return "{$branch['id']} - {$branch['title']} $logo";
    //        });
    //    });
    //}

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title');
            $form->text('name');
            $form->text('name_en');
            $form->text('sort');
            $form->text('parent_id');
            $form->text('is_show');
            $form->text('icon');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
