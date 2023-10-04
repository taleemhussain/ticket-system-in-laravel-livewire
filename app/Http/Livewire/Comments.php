<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use App\Models\comment;

class Comments extends Component
{   
    use WithPagination;
 
    public $newComment = '';
    public $image;
    public $ticketid ;

    protected $listeners = ['fileUpload' =>'handleFileUpload'
    ,'ticketSelected' => 'ticketSelected'];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function ticketSelected($ticketid){
        $this->ticketid = $ticketid;
        
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);
        
        $image  = $this->storeImage();

        $createdComment = Comment::create([
            'body'              => $this->newComment, 
            'user_id'           =>  1,
            'image'             => $image,
            'support_ticket_id' => $this->ticketid,
        ]);

        $this->newComment = '';
        $this->image      = '';
        session()->flash('message', 'Comment added successfully 😁');
    }
    
    public function remove($commentId)
    {

        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function storeImage()
    {
        if (!$this->image) {
            return '';
        }

        $img   = ImageManagerStatic::make($this->image)->encode('jpg');
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }
    // public function mount(){
    //    // $this->comments = Comment::latest()->get();
    // }


    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::where('support_ticket_id',$this->ticketid)->latest()->paginate(2)]);
    }
}
