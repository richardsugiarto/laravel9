<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

use App\Models\Article;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $user_count = User::count();
        $article_count = Article::count();
        return $content
            ->title('Dashboard')
            ->description('Chart Analysis')
            ->row(view('admin.title'))
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.doughnut',['title'=>"chart",'user_count'=>User::count(),'article_count'=>Article::count()]));
                });

                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.bar',['title'=>"chart",'user_count'=>User::count(),'article_count'=>Article::count()]));
                });

                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.pie',['title'=>"chart",'user_count'=>User::count(),'article_count'=>Article::count()]));
                });
            });
        /*return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });*/
    }
}
