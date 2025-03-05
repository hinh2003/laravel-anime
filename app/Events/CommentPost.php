<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CommentPost implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('comment'),
        ];
    }

    public function broadcastWith(): array {
        Log::info('Broadcasting comment event:', [
            'id' => $this->comment->id,
            'content' => $this->comment->content,
            'user' => $this->comment->user->name,
            'created_at' => $this->comment->created_at->diffForHumans(),
        ]);

        return [
            'id' => $this->comment->id,
            'content' => $this->comment->content,
            'user' => $this->comment->user->name,
            'created_at' => $this->comment->created_at->diffForHumans(),
        ];
    }
}
