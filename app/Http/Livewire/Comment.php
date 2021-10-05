<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    public $n_comment;
    public $s_comment;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if ($this->s_comment) {
            $comments = \App\Models\Comment::where('message', 'like', '%' . $this->s_comment . '%')
                ->paginate(2);
        } else {
            $comments = \App\Models\Comment::latest()
                ->paginate(2);
        }

        return view('livewire.comment', [
            'comments' => $comments
        ]);
    }

    public function search_comment()
    {
        $this->resetPage();
    }

    public function add_comment()
    {
        $this->validate([
            'n_comment' => 'required|min:6'
        ], [
            'n_comment.required' => 'The comment field is required.'
        ]);

        $comment = \App\Models\Comment::create([
            'user_id' => 1,
            'message' => $this->n_comment
        ]);

        if ($comment->id) {
            $this->n_comment = '';
            session()->flash('message', 'Comment successfully added.');
        } else {
            session()->flash('error', 'Operation Failed !');
        }
    }

    public function remove_comment($id)
    {
        $comment = \App\Models\Comment::where('id', $id)->first();

        if ($comment) {
            if ($comment->delete()) {
                session()->flash('message', 'Comment successfully deleted.');
            }
            session()->flash('error', 'Operation Failed !');
        } else {
            session()->flash('error', 'Comment not found !');
        }
    }
}
