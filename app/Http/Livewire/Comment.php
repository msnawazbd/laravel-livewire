<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    public $n_comment;
    public $ticket_id;
    public $s_comment;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'ticket_selected' => 'ticket_selected' // or 'ticket_selected' if function name and event same
    ];

    public function render()
    {
        if ($this->s_comment) {
            $comments = \App\Models\Comment::with([
                'user_info',
                'ticket_info'
            ])
                ->where('ticket_id', $this->ticket_id)
                ->where('message', 'like', '%' . $this->s_comment . '%')
                ->paginate(2);
        } else {
            $comments = \App\Models\Comment::with([
                'user_info',
                'ticket_info'
            ])
                ->where('ticket_id', $this->ticket_id)
                ->latest()
                ->paginate(2);
        }

        return view('livewire.comment', [
            'comments' => $comments
        ]);
    }

    public function ticket_selected($ticket_id)
    {
        $this->ticket_id = $ticket_id;
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
            'user_id' => Auth::user()->id,
            'ticket_id' => $this->ticket_id,
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
