<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WordController extends Controller
{
    public function index(): View
    {
        $words = Word::query()
            ->orderBy('No')
            ->get();

        return view('index', compact('words'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'Word' => ['required', 'string', 'max:100'],
            'Meaning' => ['required', 'string', 'max:255'],
            'Sentence' => ['nullable', 'string', 'max:255'],
        ]);

        $word = Word::query()->create($validated);

        return redirect()
            ->route('words.index')
            ->with('success', 'No.' . $word->No . ' を追加しました。');
    }

    public function edit(int $no): View
    {
        $word = Word::query()->where('No', $no)->firstOrFail();

        return view('words.edit', compact('word'));
    }

    public function update(Request $request, int $no): RedirectResponse
    {
        $word = Word::query()->where('No', $no)->firstOrFail();

        $validated = $request->validate([
            'Word' => ['required', 'string', 'max:100'],
            'Meaning' => ['required', 'string', 'max:255'],
            'Sentence' => ['nullable', 'string', 'max:255'],
        ]);

        $word->update($validated);

        return redirect()
            ->route('words.index')
            ->with('success', 'No.' . $no . ' を更新しました。');
    }

    public function destroy(int $no): RedirectResponse
    {
        Word::query()->where('No', $no)->delete();

        return redirect()
            ->route('words.index')
            ->with('success', 'No.' . $no . ' を削除しました。');
    }
}
