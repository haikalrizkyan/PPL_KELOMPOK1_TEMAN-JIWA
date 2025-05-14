<?php

namespace App\Http\Controllers\psikolog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
        public function index()
        {
            $articles = Article::where('user_id', Auth::user()->id)->get();

            return view('psikolog.article', compact('articles'));
        }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'first_section' => 'required',
            'first_attachment' => 'required',
            'cover' => 'required',
        ]);

        $input = $request->only('title', 'first_section', 'second_section');

        // return response([$input]);

        $files = $request->file('cover');
        $ext = ['JPG', 'JPEG', 'PNG', 'GIF', 'SVG', 'jpg', 'jpeg', 'png', 'gif', 'svg'];
        $vid_ext = ['MP4', 'WEBM', 'MOV', 'mp4', 'webm', 'mov'];
        $file_ext = $files->getClientOriginalExtension();

        if (in_array($file_ext, $ext)) {
            $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files->getClientOriginalName();
            $input['cover'] = $name;
            $request->cover->move(public_path() . "/article/cover", $name);
        } else {
            return response($file_ext);
            return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
        }

        if ($request->file('first_attachment')) {
            $files_first_attachment = $request->file('first_attachment');
            $file_ext = $files_first_attachment->getClientOriginalExtension();
            if (in_array($file_ext, $ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_first_attachment->getClientOriginalName();
                $input['first_attachment'] = $name;
                $request->first_attachment->move(public_path() . "/article/attachment/images", $name);
            } else if (in_array($file_ext, $vid_ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_first_attachment->getClientOriginalName();
                $input['first_attachment'] = $name;
                $request->first_attachment->move(public_path() . "/article/attachment/videos", $name);
            } else {
                return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
            }
        }

        if ($request->file('second_attachment')) {
            $files_second_attachment = $request->file('second_attachment');
            $file_ext = $files_second_attachment->getClientOriginalExtension();
            if (in_array($file_ext, $ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_second_attachment->getClientOriginalName();
                $input['second_attachment'] = $name;
                $request->second_attachment->move(public_path() . "/article/attachment/images", $name);
            } else if (in_array($file_ext, $vid_ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_second_attachment->getClientOriginalName();
                $input['second_attachment'] = $name;
                $request->second_attachment->move(public_path() . "/article/attachment/videos", $name);
            } else {
                return response('Kedua');
                return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
            }
        }

        $input['user_id'] = Auth::user()->id;

        $create = Article::create($input);

        // return response($create);

        if ($create) {
            return redirect()->route('psikolog.article.index')->with('success', 'Article berhasil ditambahkan.');
        }

        return redirect()->route('psikolog.article.index')->with('gagal', 'Article gagal ditambahkan.');
    }

    public function update(Request $request, $ArticleId)
    {
        $article = Article::findOrFail($ArticleId);

        if (!$article) {
            return redirect()->route('psikolog.article.index')->with('gagal', 'Article tidak ditemukan.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'first_section' => 'required',
        ]);

        $input = $request->only('title', 'first_section', 'second_section');

        // return response([$input]);
        $ext = ['JPG', 'JPEG', 'PNG', 'GIF', 'SVG', 'jpg', 'jpeg', 'png', 'gif', 'svg'];
        $vid_ext = ['MP4', 'WEBM', 'MOV', 'mp4', 'webm', 'mov'];

        if ($request->file('cover')) {
            $files = $request->file('cover');
            $file_ext = $files->getClientOriginalExtension();

            if (in_array($file_ext, $ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files->getClientOriginalName();
                $input['cover'] = $name;
                $request->cover->move(public_path() . "/article/cover", $name);
            } else {
                return response($file_ext);
                return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
            }
        }

        if ($request->file('first_attachment')) {
            $files_first_attachment = $request->file('first_attachment');
            $file_ext = $files_first_attachment->getClientOriginalExtension();
            if (in_array($file_ext, $ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_first_attachment->getClientOriginalName();
                $input['first_attachment'] = $name;
                $request->first_attachment->move(public_path() . "/article/attachment/images", $name);
            } else if (in_array($file_ext, $vid_ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_first_attachment->getClientOriginalName();
                $input['first_attachment'] = $name;
                $request->first_attachment->move(public_path() . "/article/attachment/videos", $name);
            } else {
                return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
            }
        }

        if ($request->file('second_attachment')) {
            $files_second_attachment = $request->file('second_attachment');
            $file_ext = $files_second_attachment->getClientOriginalExtension();
            if (in_array($file_ext, $ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_second_attachment->getClientOriginalName();
                $input['second_attachment'] = $name;
                $request->second_attachment->move(public_path() . "/article/attachment/images", $name);
            } else if (in_array($file_ext, $vid_ext)) {
                $name = \Illuminate\Support\Str::random(7) . "_" . Auth::user()->id . "_" . $files_second_attachment->getClientOriginalName();
                $input['second_attachment'] = $name;
                $request->second_attachment->move(public_path() . "/article/attachment/videos", $name);
            } else {
                return response('Kedua');
                return redirect()->route('psikolog.article.index')->with('gagal', 'Format tidak sesuai');
            }
        }

        $update = $article->update($input);

        // return response($update);

        if ($update) {
            return redirect()->route('psikolog.article.index')->with('success', 'Article berhasil diperbaharui.');
        }

        return redirect()->route('psikolog.article.index')->with('gagal', 'Article gagal diperbaharui.');
    }

    public function destroy($ArticleId)
    {
        $article = Article::findOrFail($ArticleId);
        $article->delete();

        return redirect()->route('psikolog.article.index')->with('success', 'Article berhasil dihapus');
    }
}
