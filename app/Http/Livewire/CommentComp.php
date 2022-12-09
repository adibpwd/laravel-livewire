<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;

class CommentComp extends Component
{
    use WithPagination;
    public $content;
    public $updateMode = false;
    public $idComment;

    public function mount()
    {
        // $this->comments = ;
    }

    public function addComment()
    {
        Comment::create([
            'user_id' => 1,
            'content' => $this->content,
            'created_at' => now(),
        ]);
        $this->content = null;
        session()->flash('success', 'Comment successfully added.');
    }

    public function deleteComment($id)
    {
        Comment::destroy($id);
    }

    public function showEditComment($id)
    {
        $comment = Comment::find($id);

        $this->idComment = $comment->id;
        $this->content = $comment->content;
        $this->updateMode = true;
    }

    public function updateComment()
    {
        Comment::find($this->idComment)
                ->update([
                    'content' => $this->content,
                ]);
        $this->content = null;
        $this->updateMode = false;
        session()->flash('success', 'Comment successfully updated.');
    }

    public function render()
    {
        return view('livewire.comment-comp', [
            'comments' => Comment::with('user')->latest()->paginate(2),
        ]);
    }
}
