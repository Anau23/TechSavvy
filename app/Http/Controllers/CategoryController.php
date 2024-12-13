<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function generatePDF()
    {
        $categories = Category::all();

        // Pastikan file 'pdf.blade.php' sudah ada di resources/views/categories/
        $pdf = Pdf::loadView('categories.pdf', compact('categories'));

        // Kembalikan PDF ke browser
        return $pdf->stream('categories.pdf');
    }
}
