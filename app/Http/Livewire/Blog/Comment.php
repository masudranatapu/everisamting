<?php

namespace App\Http\Livewire\Blog;

use App\Models\BlogComment;
use App\Notifications\BlogCommentNotification;
use Livewire\Component;

class Comment extends Component
{
    public $post_id, $name, $email, $body, $comments;
    public $loadbutton = true, $total, $count = 5;
    public $loading = false;

    //reset form
    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->body = '';
    }

    // Store comment
    public function storeComment()
    {
        // data validation
        if (auth('user')->check()) {
            $this->validate([
                'body' => "required",
            ]);
        } else {
            $this->validate([
                'name' => "required",
                'email' => "required",
                'body' => "required",
            ]);
        }

        $data = [
            'post_id' => $this->post_id,
            'name' => $this->name ? $this->name : auth('user')->user()->name,
            'email' => $this->email ? $this->email : auth('user')->user()->email,
            'body' => $this->body,
            'image' => auth('user')->check() ? 1 : 0,
        ];

        $comment = BlogComment::create($data);

        //Send blog post author to new comment notification
        if (checkSetup('mail')) {
            $comment->post->author->notify(new BlogCommentNotification($comment));
        }

        $this->resetForm();
    }

    // Load More Data
    public function load()
    {
        $this->loading = true;
        $this->count += 5;
    }

    public function render()
    {
        $this->comments = BlogComment::where('post_id', $this->post_id)
            ->latest()
            ->take($this->count)
            ->get();
        $this->total = BlogComment::where('post_id', $this->post_id)->count();
        $this->loading = false;
        return view('livewire.blog.comment');
    }
}
