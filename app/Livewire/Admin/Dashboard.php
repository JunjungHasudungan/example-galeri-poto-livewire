<?php

namespace App\Livewire\Admin;

use App\Models\Like;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Title, Layout};
use Livewire\Component;
use App\Models\Post;
class Dashboard extends Component
{
    public $posts;
    public $comments;
    public $likes;
    public $category;
    public $post_count;
    public $comments_count;
    public $likes_count;
    public $data;
    public $groupedPosts;

    public $amountlikeFood;

    public function mount()
    {
        $posts = Post::whereIn('category', ['kesehatan', 'pendidikan', 'makanan', 'traveling'])
        ->with(['comments', 'likes'])
        ->withCount(['comments', 'likes'])
        ->get();

// Mengelompokkan postingan berdasarkan kategori dan menghitung jumlahnya
        $groupedPosts = $posts->groupBy('category')->map(function ($group) {
            return [
                'posts_count' => $group->count(),
                'comments_count' => $group->sum('comments_count'),
                'likes_count' => $group->sum('likes_count'),
                'posts' => $group
            ];
        });

        

        // foreach ($groupedPosts  as $category  => $data) {
        //     $this->category = $category;
        //     $this->post_count = $data['posts_count'];
        //     $this->comments_count = $data['comments_count'];
        //     $this->likes_count = $data['likes_count'];
        //     $this->data = $data['posts'];

        //     foreach ($data as $key => $posts) {
        //         $this->posts = $posts;
        //     }
        // }

        $posts = Post::withCount(['comments', 'likes'])
        ->whereIn('category', ['kesehatan', 'pendidikan', 'makanan', 'traveling'])
        ->get();

// Mengelompokkan postingan berdasarkan kategori dan menghitung jumlahnya
$this->groupedPosts = $posts->groupBy('category')->map(function ($group) {
return [
   'posts_count' => $group->count(),
   'comments_count' => $group->sum('comments_count'),
   'likes_count' => $group->sum('likes_count'),
   'posts' => $group
];
});
        $allPost = Post::whereIn('category', ['kesehatan', 'pendidikan', 'makanan', 'traveling'])
        ->with(['comments', 'likes'])
        ->get();
        // dd($allPost);

        $this->posts = Post::with(['comments', 'likes'])->get();
    }

    #[Title('Dashboard')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'posts' => $this->groupedPosts
        ]);
    }

    public function getAmountLike()
    {

    }
}
