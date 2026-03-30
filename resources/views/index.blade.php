<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>English Vocabulary Notebook</title>
        <style>
            :root {
                --bg: #f7f8fb;
                --card: #ffffff;
                --border: #d9deea;
                --text: #1f2937;
                --muted: #6b7280;
                --primary: #2563eb;
                --danger: #dc2626;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: var(--bg);
                color: var(--text);
            }

            .container {
                max-width: 1100px;
                margin: 32px auto;
                padding: 0 16px;
            }

            .card {
                background: var(--card);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 16px;
            }

            h1 {
                margin: 0 0 8px;
                font-size: 26px;
            }

            .sub {
                margin: 0;
                color: var(--muted);
                font-size: 14px;
            }

            .grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1.4fr auto;
                gap: 10px;
                margin-top: 14px;
            }

            input {
                width: 100%;
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 10px 12px;
                font-size: 14px;
            }

            button {
                border: 0;
                border-radius: 8px;
                padding: 10px 14px;
                cursor: pointer;
                font-weight: 700;
            }

            .btn-primary {
                background: var(--primary);
                color: #fff;
            }

            .btn-secondary {
                display: inline-block;
                background: #64748b;
                color: #fff;
                padding: 8px 10px;
                font-size: 13px;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 700;
            }

            .btn-danger {
                background: var(--danger);
                color: #fff;
                padding: 8px 10px;
            }

            .cell-actions {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
                align-items: center;
            }

            .hint {
                margin-top: 8px;
                font-size: 13px;
                color: var(--muted);
            }

            .message {
                margin-top: 10px;
                min-height: 18px;
                font-size: 14px;
                color: var(--danger);
            }

            .table-wrap {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                min-width: 860px;
            }

            th,
            td {
                border: 1px solid var(--border);
                padding: 10px 12px;
                text-align: left;
                vertical-align: top;
            }

            th {
                background: #eef2ff;
                font-size: 14px;
            }

            td {
                font-size: 14px;
            }

            .empty {
                text-align: center;
                color: var(--muted);
                padding: 16px;
            }

            @media (max-width: 900px) {
                .grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <h1>English Vocabulary Notebook</h1>
                <p class="sub">No.をキーにして、単語・意味・文章をどんどん追加していく学習用ページです。</p>

                <form method="POST" action="{{ route('words.store') }}" class="grid">
                    @csrf
                    <input id="word" name="Word" type="text" placeholder="単語 (Word)" value="{{ old('Word') }}" required>
                    <input id="meaning" name="Meaning" type="text" placeholder="意味 (Meaning)" value="{{ old('Meaning') }}" required>
                    <input id="sentence" name="Sentence" type="text" placeholder="文章 (Sentence)" value="{{ old('Sentence') }}">
                    <button type="submit" class="btn-primary">追加</button>
                </form>

                <p class="hint">No.は自動採番です。追加時に入力する必要はありません。</p>
                <div class="message" style="color: #dc2626;">
                    @if ($errors->any())
                        {{ $errors->first() }}
                    @endif
                </div>
                @if (session('success'))
                    <div class="message" style="color: #059669;">{{ session('success') }}</div>
                @endif
            </div>

            <div class="card table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 90px;">No.</th>
                            <th style="width: 180px;">単語</th>
                            <th style="width: 220px;">意味</th>
                            <th>文章</th>
                            <th style="width: 160px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($words as $item)
                            <tr>
                                <td>{{ $item->No }}</td>
                                <td>{{ $item->Word }}</td>
                                <td>{{ $item->Meaning }}</td>
                                <td>{{ $item->Sentence }}</td>
                                <td>
                                    <div class="cell-actions">
                                        <a href="{{ route('words.edit', $item->No) }}" class="btn-secondary">修正</a>
                                        <form method="POST" action="{{ route('words.destroy', $item->No) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-danger" type="submit">削除</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty" colspan="5">まだ単語がありません。上のフォームから追加してください。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
