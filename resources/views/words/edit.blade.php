<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>単語の修正 — No.{{ $word->No }}</title>
        <style>
            :root {
                --bg: #f7f8fb;
                --card: #ffffff;
                --border: #d9deea;
                --text: #1f2937;
                --muted: #6b7280;
                --primary: #2563eb;
            }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: var(--bg);
                color: var(--text);
            }
            .container {
                max-width: 640px;
                margin: 32px auto;
                padding: 0 16px;
            }
            .card {
                background: var(--card);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 20px;
            }
            h1 { margin: 0 0 8px; font-size: 22px; }
            .sub { margin: 0 0 16px; color: var(--muted); font-size: 14px; }
            label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 4px; }
            .field { margin-bottom: 14px; }
            input {
                width: 100%;
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 10px 12px;
                font-size: 14px;
            }
            .no-readonly {
                padding: 10px 12px;
                background: #f3f4f6;
                border-radius: 8px;
                font-size: 14px;
            }
            .actions { display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
            button, .btn-link {
                border: 0;
                border-radius: 8px;
                padding: 10px 16px;
                cursor: pointer;
                font-weight: 700;
                font-size: 14px;
                text-decoration: none;
                display: inline-block;
            }
            .btn-primary { background: var(--primary); color: #fff; }
            .btn-link { background: #e5e7eb; color: var(--text); }
            .message { margin-top: 10px; font-size: 14px; color: #dc2626; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <h1>単語の修正</h1>
                <p class="sub">No.{{ $word->No }} の内容を更新します。</p>

                <form method="POST" action="{{ route('words.update', $word->No) }}">
                    @csrf
                    @method('PUT')
                    <div class="field">
                        <label>No.</label>
                        <div class="no-readonly">{{ $word->No }}</div>
                    </div>
                    <div class="field">
                        <label for="Word">単語</label>
                        <input id="Word" name="Word" type="text" value="{{ old('Word', $word->Word) }}" required maxlength="100">
                    </div>
                    <div class="field">
                        <label for="Meaning">意味</label>
                        <input id="Meaning" name="Meaning" type="text" value="{{ old('Meaning', $word->Meaning) }}" required maxlength="255">
                    </div>
                    <div class="field">
                        <label for="Sentence">文章</label>
                        <input id="Sentence" name="Sentence" type="text" value="{{ old('Sentence', $word->Sentence) }}" maxlength="255">
                    </div>
                    @if ($errors->any())
                        <div class="message">{{ $errors->first() }}</div>
                    @endif
                    <div class="actions">
                        <button type="submit" class="btn-primary">更新する</button>
                        <a href="{{ route('words.index') }}" class="btn-link">一覧に戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
