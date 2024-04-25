<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

try {
    DB::statement('CALL reset_auto_increment()');
    $success = "Successfully reset auto increment is WORKING!!!";
} catch (\Exception $e) {
    $error = "Error: " . $e->getMessage();
}


class ProductsController extends Controller
{
    public function index()
    {

        // $blogs = DB::table('blogs')->paginate(5);
        $blogs = Blog::paginate(5);
        return view('product/blog', [
            'blogs' => $blogs,
        ]);
    }
    function main()
    {

        $main = Blog::paginate(8);
        return view('welcome', [
            'main' => $main

        ]);
    }
    function create()
    {
        return view('product/form');
    }


    function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'category' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate the image file
            'price' => 'numeric', // Validate the price field as numeric

        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $request->image,
            'category' => $request->category
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }

        Blog::create($data);

        return redirect('/blog');
    }


    function delete($id)
    { // ทำไมไม่ใช้ eloquant
        Blog::where('id', $id)->delete();
        return redirect('/blog');
    }
    function change($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        $data = [
            'status' => !$blog->status
        ];
        $blog = DB::table('blogs')->where('id', $id)->update($data);
        return redirect('/blog');
    }
    function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('product/edit', compact('blog'));
    }
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'price' => 'required',
                'category' => 'required',
            ],
            [
                'title.required' => 'กรุณากรอกชื่อบทความ',
                'title.max' => 'กรุณากรอกชื่อบทความไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหาบทความ',
                'price.required' => 'กรุณากรอกราคาสินค้า   ',
                'category.required' => 'กรุณากรอกหมวดหมู่สินค้า   ',
            ]
        );
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $request->image,
            'category' => $request->category
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }
        Blog::where('id', $id)->update($data);
        return redirect('/blog');
    }
    public function report($id)
    {

        $blog = Blog::where('id', $id)->first();
        // return $blog;

        /** create new PDF document */
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        /** Set font */
        $pdf->SetFont('freeserif', '', 16);

        /** set document information */
        $pdf->SetCreator('Lilnon');
        $pdf->SetAuthor('non');
        $pdf->SetTitle('Plant_shop');
        $pdf->SetSubject('Product');
        $pdf->SetKeywords('Plant, Product');

        /** set margins */
        $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);

        /** set auto page breaks */
        $pdf->SetAutoPageBreak(TRUE, '5');

        /** add a page **/
        $pdf->AddPage();

        /** render a page of data **/
        $pdf->writeHTML(view('product.report', ['data' => $blog]), true, false, true, false, '');

        /** render file **/
        $pdf->Output('Plant_shop.pdf', 'I'); // I = ดูก่อนได้  D = บังคับดาวน์โหลด

        /** end pdf **/
        $pdf->Close();
    }
}
