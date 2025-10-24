<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        return view('questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255|min:6',
            'content'     => 'required|string|min:10',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $question = Question::create([
            'title'       => $data['title'],
            'content'     => $data['content'],
            'category_id' => $data['category_id'],
            'user_id'     => Auth::id(),
        ]);

        return redirect()
            ->route('question.show', $question)
            ->with('success', 'Tu pregunta se publicó correctamente');
    }

        public function edit(Question $question)
    {
        $this->authorize('update', $question);

        $categories = Category::orderBy('name')->get(['id','name']);
        return view('questions.edit', compact('question','categories'));
    }

    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);

        $data = $request->validate([
            'title'       => 'required|string|max:255|min:6',
            'content'     => 'required|string|min:10',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $question->update($data);

        return redirect()
            ->route('question.show', $question)
            ->with('success', '¡Tu pregunta fue actualizada correctamente!');
    }
    public function show(Question $question)
    {
        $question->load('answers','category','user');
        return view('questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('home');
    }
}
